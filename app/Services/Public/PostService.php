<?php

namespace App\Services\Public;

use App\Models\Post;
use App\Enums\PostStatus;

class PostService
{
    public function popularPosts(int $limit = 6)
    {
        return Post::withCount('likedByUsers')
            ->where('status', PostStatus::PUBLISHED)
            ->orderByDesc('liked_by_users_count')
            ->take($limit)
            ->get();
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
         $similarKey = $post->cacheKey() . ":similar:$limit";

        return Post::cacheGet($similarKey, function () use ($post, $limit) {
            return Post::where('id', '!=', $post->id)
                ->where('status', PostStatus::PUBLISHED->value)
                ->where(function ($query) use ($post) {
                    // Та же категория
                    $query->where('category_id', $post->category_id);

                    // АБО те же теги
                    $query->orWhereHas('tags', function ($q) use ($post) {
                        $q->whereIn('tags.id', $post->tags->pluck('id'));
                    });
                })
                ->with(['category', 'tags'])
                ->latest()
                ->take($limit)
                ->get();
        }, 3600); // TTL 1 час
    }
}
