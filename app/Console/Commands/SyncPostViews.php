<?php

namespace App\Console\Commands;


use App\Models\Traits\Viewable;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Redis;

class SyncPostViews extends Command
{/**
     * Название и сигнатура консольной команды.
     */
    protected $signature = 'views:sync';

    /**
     * Описание консольной команды.
     */
    protected $description = 'Synchronizes post views from Redis cache to the database and resets the cache.';

    /**
     * Выполнить консольную команду.
     */
    public function handle()
    {
        $this->info('Starting post views synchronization...');

        $cachedViews = Viewable::getViewsFromCache();

        if (empty($cachedViews)) {
            $this->comment('No cached views found. Exiting.');
            return Command::SUCCESS;
        }

        $this->info(sprintf('Found %d posts with cached views.', count($cachedViews)));

        $startTime = microtime(true);
        $totalUpdates = 0;

        DB::transaction(function () use ($cachedViews, &$totalUpdates) {
            foreach ($cachedViews as $postId => $viewsToAdd) {
                // Используем DB::table для обновления, чтобы избежать загрузки моделей
                $updated = DB::table('posts')
                    ->where('id', $postId)
                    ->increment('views', $viewsToAdd);

                if ($updated) {
                    $totalUpdates++;
                } else {
                    Log::warning("Post ID {$postId} not found in DB during views sync.");
                }
            }
        });

        // После успешного обновления БД, очищаем кеш
        Viewable::clearViewsCache();

        $elapsedTime = round(microtime(true) - $startTime, 2);

        $this->info(sprintf(
            'Synchronization complete. Successfully updated %d posts in %s seconds. Redis cache cleared.',
            $totalUpdates,
            $elapsedTime
        ));

        return Command::SUCCESS;
    }
}
