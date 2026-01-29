<?php

namespace App\Models;

use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Setting extends Model
{
  
    use LogsActivity;

    protected $fillable = ['key', 'value', 'is_encrypted'];

    protected $casts = [
        'is_encrypted' => 'boolean',
    ];

    /**
     * Получить значение настройки
     */
    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();

        if (!$setting) {
            return $default;
        }

        return $setting->is_encrypted 
            ? Crypt::decryptString($setting->value)
            : $setting->value;
    }

    /**
     * Установить значение настройки
     */
    public static function set(string $key, $value, ?bool $encrypted = null): void
    {
        // Автоматически определяем, нужно ли шифровать
        if ($encrypted === null) {
            $encrypted = static::shouldBeEncrypted($key);
        }

        $valueToStore = $encrypted ? Crypt::encryptString($value) : $value;

        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $valueToStore,
                'is_encrypted' => $encrypted,
            ]
        );
    }

    /**
     * Проверить, должна ли настройка быть зашифрована
     */
    protected static function shouldBeEncrypted(string $key): bool
    {
        $encryptedKeys = config('settings.encrypted_keys', []);
        
        // Проверяем точное совпадение или паттерн
        foreach ($encryptedKeys as $pattern) {
            if ($key === $pattern || str_contains($key, $pattern)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Получить все настройки
     */
    public static function all($columns = ['*'])
    {
        return static::query()->get($columns)->mapWithKeys(function ($setting) {
            return [$setting->key => $setting->is_encrypted 
                ? Crypt::decryptString($setting->value)
                : $setting->value
            ];
        });
    }
}