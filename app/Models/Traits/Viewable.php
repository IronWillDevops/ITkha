<?php

namespace App\Models\Traits;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

trait Viewable
{ // Включаем Cacheable для доступа к isRedisAvailable()
    use Cacheable;

    /**
     * Ключ Redis Hash для хранения счетчиков просмотров.
     */
    protected static string $viewsCacheKey = 'post_views';

    /**
     * Префикс для Redis Set, используемого для отслеживания уникальных просмотров (24 часа).
     */
    protected static string $uniqueViewsKeyPrefix = 'post_unique_views:';

    /**
     * Время жизни ключа уникальности (24 часа).
     */
    protected static int $uniqueViewsTtl = 86400; // 24 часа в секундах

    /**
     * Записывает просмотр, обеспечивая уникальность по ID пользователя/сессии
     * и предоставляя фолбэк на БД в случае недоступности Redis.
     *
     * @param int $postId ID поста.
     */
    public static function recordView(int $postId): void
    {
        // Получаем уникальный идентификатор (ID пользователя или ID сессии)
        $viewerId = auth()->id() ?? session()->getId();

        // --- ЛОГИКА С КЕШИРОВАНИЕМ В REDIS ---
        if (self::isRedisAvailable()) {
            $uniqueKey = self::$uniqueViewsKeyPrefix . $postId;

            // SADD вернет 1, если элемент добавлен (просмотр уникален)
            if (Redis::sadd($uniqueKey, $viewerId)) {

                // 1. Увеличиваем счетчик в Hash
                Redis::hincrby(self::$viewsCacheKey, $postId, 1);

                // 2. Устанавливаем TTL для Set на 24 часа
                Redis::expire($uniqueKey, self::$uniqueViewsTtl);
            }
        } else {
            // --- ФОЛБЭК НА БАЗУ ДАННЫХ (если Redis недоступен) ---

            // В фолбэке используем сессию для проверки уникальности
            $sessionKey = 'viewed_post_' . $postId;
            if (!session()->has($sessionKey)) {
                try {
                    // Инкрементируем views напрямую в БД
                    DB::table('posts')->where('id', $postId)->increment('views', 1);

                    // Помечаем в сессии, что просмотр учтен
                    session()->put($sessionKey, true);
                    DB::commit();
                } catch (Exception $ex) {
                    DB::rollBack();
                }
            }
        }
    }

    /**
     * Получает текущее количество просмотров из кеша Redis для конкретного поста.
     *
     * @param int $postId
     * @return int
     */
    public static function getPostViewsFromCache(int $postId): int
    {
        if (!self::isRedisAvailable()) {
            return 0;
        }

        $views = Redis::hget(self::$viewsCacheKey, $postId);
        return is_numeric($views) ? (int) $views : 0;
    }

    /**
     * Аксессор для получения актуального количества просмотров (DB + Redis Cache).
     *
     * @return int
     */
    public function getActualViewsAttribute(): int
    {
        // $this->views - это значение из колонки 'views' в БД
        $dbViews = $this->views ?? 0;

        // Получаем кешированное значение
        $cachedViews = self::getPostViewsFromCache($this->id);

        return $dbViews + $cachedViews;
    }

    /**
     * Получает все просмотры из кеша Redis.
     *
     * @return array<int, int> Ассоциативный массив [post_id => view_count].
     */
    public static function getViewsFromCache(): array
    {
        if (!self::isRedisAvailable()) {
            return [];
        }

        try {
            $cachedViews = Redis::hgetall(self::$viewsCacheKey);

            $views = [];
            foreach ($cachedViews as $postId => $count) {
                if (is_numeric($postId) && is_numeric($count)) {
                    $views[(int) $postId] = (int) $count;
                }
            }
            return $views;
        } catch (\Exception $e) {
            Log::error('Redis View Fetch Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Очищает кеш просмотров в Redis после синхронизации с БД.
     */
    public static function clearViewsCache(): void
    {
        if (!self::isRedisAvailable()) {
            return;
        }

        try {
            Redis::del(self::$viewsCacheKey);
        } catch (\Exception $e) {
            Log::error('Redis View Clear Error: ' . $e->getMessage());
        }
    }
}
