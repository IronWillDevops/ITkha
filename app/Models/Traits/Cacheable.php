<?php

namespace App\Models\Traits;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

trait Cacheable
{
    protected static function isRedisAvailable(): bool
    {
        // Проверяем, установлено ли расширение php-redis
        if (class_exists(\Redis::class)) {
            try {
                $redis = new \Redis();
                $redis->connect(
                    config('database.redis.default.host', '127.0.0.1'),
                    config('database.redis.default.port', 6379)
                );
                $password = config('database.redis.default.password');
                if (!empty($password)) {
                    $redis->auth($password);
                }
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

    /**
     * Генерация дефолтного ключа кеша для модели.
     *
     * @param mixed $model
     * @return string
     */
    public static function defaultCacheKey($model): string
    {
        return sprintf("%s:%s", class_basename($model), $model->id ?? spl_object_hash($model));
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
     * Увеличивает счётчик просмотров поста в Redis.
     *
     * @param string $key
     */
    public static function incrementCacheCounter(string $key, int $ttl = 86400): void
    {
        if (!self::isRedisAvailable()) {
            return;
        }

        try {
            $redis = Cache::getRedis();
            $redis->incr($key);
            $redis->expire($key, $ttl);
        } catch (\Exception $e) {
            Log::error("Failed to increment Redis counter for {$key}: " . $e->getMessage());
        }
    }

    /**
     * Возвращает значение счётчика.
     *
     * @param string $key
     * @return int
     */
    public static function getCacheCounter(string $key): int
    {
        if (!self::isRedisAvailable()) {
            return 0;
        }

        try {
            $redis = Cache::getRedis();
            return (int)$redis->get($key);
        } catch (\Exception $e) {
            Log::error("Failed to get Redis counter for {$key}: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Забирает и обнуляет счётчик просмотров (для суточного сброса).
     *
     * @param string $key
     * @return int
     */
    public static function pullCacheCounter(string $key): int
    {
        if (!self::isRedisAvailable()) {
            return 0;
        }

        try {
            $redis = Cache::getRedis();
            $count = (int)$redis->get($key);
            $redis->del($key);
            return $count;
        } catch (\Exception $e) {
            Log::error("Failed to pull Redis counter for {$key}: " . $e->getMessage());
            return 0;
        }
    }


    protected static function bootCacheable()
    {
        static::updated(function ($model) {
            self::cacheForget($model->cacheKey());
        });

        static::deleted(function ($model) {
            self::cacheForget($model->cacheKey());
        });
    }
}
