<?php

namespace App\Models;

use App\Models\Traits\Cacheable;
use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Setting extends Model
{
    use Cacheable, LogsActivity;

    protected $fillable = [
        'key',
        'value',
        'default',
        'is_encrypted'
    ];

    protected $casts = [
        'is_encrypted' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Cache Keys
    |--------------------------------------------------------------------------
    */

    public static function allSettingsCacheKey(): string
    {
        return 'settings:all';
    }

    public static function settingCacheKey(string $key): string
    {
        return "settings:{$key}";
    }

    /*
    |--------------------------------------------------------------------------
    | Model Events
    |--------------------------------------------------------------------------
    */

    protected static function booted(): void
    {
        static::saved(function (self $model) {
            static::cacheForget(static::settingCacheKey($model->key));
            static::cacheForget(static::allSettingsCacheKey());
        });

        static::deleted(function (self $model) {
            static::cacheForget(static::settingCacheKey($model->key));
            static::cacheForget(static::allSettingsCacheKey());
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Public API
    |--------------------------------------------------------------------------
    */

    public static function get(string $key, mixed $fallback = null): mixed
    {
        $setting = static::cacheGet(
            static::settingCacheKey($key),
            fn() => static::query()->where('key', $key)->first()
        );

        if (!$setting) {
            return $fallback;
        }

        return static::resolveValue($setting, $fallback);
    }

    public static function set(string $key, mixed $value, ?bool $encrypted = null): void
    {
        if ($encrypted === null) {
            $encrypted = static::shouldBeEncrypted($key);
        }

        $valueToStore = $encrypted && !is_null($value)
            ? Crypt::encryptString($value)
            : $value;

        static::updateOrCreate(
            ['key' => $key],
            [
                'value'        => $valueToStore,
                'is_encrypted' => $encrypted
            ]
        );
    }

    public static function setMany(array $settings, ?bool $encrypted = null): void
    {
        $rows = [];

        foreach ($settings as $key => $value) {
            $isEncrypted = $encrypted ?? static::shouldBeEncrypted($key);

            $rows[] = [
                'key'          => $key,
                'value'        => $isEncrypted && !is_null($value) ? Crypt::encryptString($value) : $value,
                'is_encrypted' => $isEncrypted,
            ];
        }

        static::upsert($rows, uniqueBy: ['key'], update: ['value', 'is_encrypted']);

        foreach ($settings as $key => $_) {
            static::cacheForget(static::settingCacheKey($key));
        }

        static::cacheForget(static::allSettingsCacheKey());
    }

    public static function setDefault(string $key, mixed $value, ?bool $encrypted = null): void
    {
        if ($encrypted === null) {
            $encrypted = static::shouldBeEncrypted($key);
        }

        $valueToStore = $encrypted && !is_null($value)
            ? Crypt::encryptString($value)
            : $value;

        static::updateOrCreate(
            ['key' => $key],
            [
                'default'      => $valueToStore,
                'is_encrypted' => $encrypted
            ]
        );
    }

    public static function allSettings(): array
    {
        return static::cacheGet(
            static::allSettingsCacheKey(),
            function () {
                return static::query()
                    ->get()
                    ->mapWithKeys(function (self $setting) {
                        return [
                            $setting->key => static::resolveValue($setting)
                        ];
                    })
                    ->all();
            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Internal Logic
    |--------------------------------------------------------------------------
    */

    protected static function resolveValue(self $setting, mixed $fallback = null): mixed
    {
        $rawValue = $setting->value ?? $setting->default ?? $fallback;

        if (is_null($rawValue)) {
            return null;
        }

        if (!$setting->is_encrypted) {
            return $rawValue;
        }

        try {
            return Crypt::decryptString($rawValue);
        } catch (\Illuminate\Contracts\Encryption\DecryptException) {
            return $rawValue;
        }
    }

    protected static function shouldBeEncrypted(string $key): bool
    {
        $encryptedKeys = config('settings.encrypted_keys', []);

        foreach ($encryptedKeys as $pattern) {
            if ($key === $pattern || str_contains($key, $pattern)) {
                return true;
            }
        }

        return false;
    }
}
