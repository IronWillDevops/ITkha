<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;



trait Cacheable
{
    /**
     * Получить данные из кеша или заново вычислить.
     *
     * @param string $key
     * @param \Closure $callback
     * @param int|null $ttl
     * @return mixed
     */
    public static function cacheGet(string $key, \Closure $callback, ?int $ttl = 3600)
    {
        if (!self::isRedisAvailable()) {
            return $callback();
        }

        return Cache::remember($key, $ttl, $callback);
    }

    /**
     * Сброс кеша по ключу.
     *
     * @param string $key
     */
    public static function cacheForget(string $key): void
    {
        if (!self::isRedisAvailable()) {
            return;
        }

        Cache::forget($key);
    }

    /**
     * Генерация дефолтного ключа кеша для модели.
     *
     * @param mixed $model
     * @return string
     */
    public static function defaultCacheKey($model): string
    {
        return sprintf("%s:%s", get_class($model), $model->id ?? spl_object_hash($model));
    }

    /**
     * Получить ключ кеша для объекта модели.
     *
     * @return string
     */
    public function cacheKey(): string
    {
        return static::defaultCacheKey($this);
    }

    /**
     * Автоочистка кеша при обновлении или удалении модели.
     * Laravel автоматически вызывает bootИмяТрейта.
     */
    protected static function bootCacheable()
    {
        static::updated(function ($model) {
            self::cacheForget($model->cacheKey());
            self::cacheForget($model->cacheKey() . ':similar'); // сброс similarPosts
        });

        static::deleted(function ($model) {
            self::cacheForget($model->cacheKey());
            self::cacheForget($model->cacheKey() . ':similar'); // сброс similarPosts
        });
    }

    /**
     * Проверка доступности Redis.
     *
     * @return bool
     */
    protected static function isRedisAvailable(): bool
    {
        try {
            Redis::ping();
            return true;
        } catch (\Exception $e) {
            Log::warning('Redis unavailable: ' . $e->getMessage());
            return false;
        }
    }
   

  
}
