<?php

namespace App\Services\Public;

use App\Models\Post;
use App\Enums\PostStatus;

class PostService
{
    public function popularPosts(int $limit = 6)
    {
        return  Post::cacheGet('posts:popular', function () use($limit) {
           return Post::withCount('likedByUsers')
                ->where('status', PostStatus::PUBLISHED)
                ->orderByDesc('liked_by_users_count')
                ->take($limit)
                ->get();
        });
    }

    public function postsByUser(int $user_id)
    {
        return Post::withCount('likedByUsers')
            ->where('status', PostStatus::PUBLISHED)
            ->where('user_id', $user_id)
            ->orderByDesc('liked_by_users_count');
    }


    public function similarPosts(Post $post, int $limit = 6)
    {
        // Получаем ID похожих постов
        $similarIds = Post::where('id', '!=', $post->id)
            ->where('status', PostStatus::PUBLISHED->value)
            ->where(function ($query) use ($post) {
                $query->where('category_id', $post->category_id)
                    ->orWhereHas('tags', function ($q) use ($post) {
                        $q->whereIn('tags.id', $post->tags->pluck('id'));
                    });
            })
            ->latest()
            ->limit($limit)
            ->pluck('id')
            ->toArray();

        // Берем каждый пост через кеш, используя $post->cacheKey()
        return collect($similarIds)->map(function ($id) {
            $post = Post::find($id);
            if (!$post) return null;

            $key = $post->cacheKey();

            return Post::cacheGet($key, function () use ($post) {
                return Post::where('id', $post->id)
                    ->where('status', PostStatus::PUBLISHED->value)
                    ->with(['category', 'tags'])
                    ->first();
            });
        })->filter();
    }
}
