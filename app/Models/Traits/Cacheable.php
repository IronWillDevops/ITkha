<?php

namespace App\Models\Traits;

use Exception;
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
        // Проверяем, установлено ли расширение php-redis
    if (class_exists(\Redis::class)) {
        try {
            $redis = new \Redis();
            $redis->connect(config('database.redis.default.host', '127.0.0.1'), 
                            config('database.redis.default.port', 6379));
            $redis->ping();
            return true;
        } catch (\Exception $e) {
            Log::warning('Redis unavailable: ' . $e->getMessage());
            return false;
        }
    }

    // Можно добавить поддержку predis, если он установлен через composer
    if (class_exists(\Predis\Client::class)) {
        try {
            $client = new \Predis\Client(config('database.redis.default'));
            $client->ping();
            return true;
        } catch (\Exception $e) {
            Log::warning('Predis unavailable: ' . $e->getMessage());
            return false;
        }
    }

    Log::warning('Redis extension or Predis not installed.');
    return false;
    }
}
