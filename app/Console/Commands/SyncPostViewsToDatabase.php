<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class SyncPostViewsToDatabase extends Command
{

    protected $signature = 'cache:sync-post-views';
    protected $description = 'Синхронізує перегляди постів з Redis у базу даних';

    public function handle()
    {
        if (!Post::isRedisAvailable()) {
            $this->warn('Redis недоступний. Синхронізацію пропущено.');
            return Command::FAILURE;
        }

        $redis = cache()->getRedis();
        $keys = $redis->keys('*post:views:*');

        $updated = 0;

        foreach ($keys as $key) {
            // Витягуємо ідентифікатор поста
            $cleanKey = preg_replace('/^.*post:views:/', 'post:views:', $key);
            $postId = (int) str_replace('post:views:', '', $cleanKey);

            if ($postId <= 0) {
                continue;
            }

            // Забираємо значення через Cacheable
            $views = Post::pullCacheCounter($cleanKey);

            if ($views > 0) {
                Post::where('id', $postId)->increment('views', $views);
                $updated++;
            }
        }

        $this->info("Оновлено перегляди для {$updated} постів.");
        Log::info("Синхронізація переглядів завершена: {$updated} постів оновлено.");

        return Command::SUCCESS;
    }
}
