<?php

namespace App\Services\Admin;

use App\Enums\PostStatus;
use App\Events\PostPublished;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function store(array $data, $request): Post
    {
        DB::beginTransaction();

        try {
            // Сохраняем теги отдельно
            $tagIds = $data['tag_ids'] ?? null;
            unset($data['tag_ids']);

            // Обработка главного изображения
            if ($request->hasFile('main_image')) {
                $data['main_image'] = $request->file('main_image')->store('images/main', 'public');
            }

            // Обработка published_at (формат datetime-local -> MySQL)
            if (!empty($data['published_at'])) {
                $data['published_at'] = str_replace('T', ' ', $data['published_at']) . ':00';
            } else {
                $data['published_at'] = null;
            }

            // Создаём пост
            $post = Post::create($data);

            // Привязываем теги
            if ($tagIds) {
                $post->tags()->attach($tagIds);
            }

            // Устанавливаем комментарии
            $post->comments_enabled = $request->boolean('comments_enabled');
            $post->save();

            // Публикуем пост, если время уже наступило или статус PUBLISHED
            $this->publishIfNeeded($post);

            DB::commit();
            return $post;
        } catch (Exception $ex) {
            DB::rollback();
            abort(500, $ex->getMessage());
        }
    }

    /**
     * Обновление поста
     */
    public function update(array $data, $request, Post $post): Post
    {
        DB::beginTransaction();

        try {
            // Сохраняем теги отдельно
            $tagIds = $data['tag_ids'] ?? null;
            unset($data['tag_ids']);

            // Обработка главного изображения
            if ($request->hasFile('main_image')) {
                if ($post->main_image && Storage::disk('public')->exists($post->main_image)) {
                    Storage::disk('public')->delete($post->main_image);
                }
                $data['main_image'] = $request->file('main_image')->store('images/main', 'public');
            }

            // Обработка published_at (формат datetime-local -> MySQL)
            if (!empty($data['published_at'])) {
                $data['published_at'] = str_replace('T', ' ', $data['published_at']) . ':00';
            } else {
                $data['published_at'] = null;
            }

            $oldStatus = $post->status;

            // Обновляем пост
            $post->update($data);

            // Синхронизация тегов
            if ($tagIds) {
                $post->tags()->sync($tagIds);
            }

            // Обновляем комментарии
            $post->comments_enabled = $request->boolean('comments_enabled');
            $post->save();

            $newStatus = $post->status;

            // Публикуем пост, если нужно
            $this->publishIfNeeded($post);

            DB::commit();
            return $post;
        } catch (Exception $ex) {
            DB::rollback();
            abort(500, $ex->getMessage());
        }
    }

    /**
     * Проверяет, нужно ли публиковать пост, и публикует его
     */
    private function publishIfNeeded(Post $post): void
    {
        $shouldPublish = $post->status === PostStatus::PUBLISHED->value
            || ($post->status === PostStatus::SCHEDULED->value
                && $post->published_at
                && $post->published_at <= date('Y-m-d H:i:s'));

        if ($shouldPublish) {
            if ($post->status !== PostStatus::PUBLISHED->value) {
                $post->status = PostStatus::PUBLISHED->value;
                $post->save();
            }

            event(new PostPublished($post));
        }
    }
}
