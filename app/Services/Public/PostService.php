<?php

namespace App\Services\Public;

use App\Models\Post;
use App\PostStatus;

class PostService
{
    public function popularPosts(int $limit = 6)
    {
        return Post::withCount('likedByUsers')
            ->where('status', PostStatus::Published)
            ->orderByDesc('liked_by_users_count')
            ->take($limit)
            ->get();
    }

    public function popularPostsByUser(int $user_id, int $limit = 5)
    {
        return Post::withCount('likedByUsers')
            ->where('status', PostStatus::Published)
            ->where('user_id', $user_id)
            ->orderByDesc('liked_by_users_count')
            ->take($limit)
            ->get();
    }


    public function similarPosts(Post $post, int $limit = 6)
    {

        return Post::where('id', '!=', $post->id)
        ->where('status', PostStatus::Published)
            ->where(function ($query) use ($post) {
                // Та ж категорія
                $query->where('category_id', $post->category_id);

                // АБО ті ж теги
                $query->orWhereHas('tags', function ($q) use ($post) {
                    $q->whereIn('tags.id', $post->tags->pluck('id'));
                });
            })
            ->with(['category', 'tags'])
            ->latest()
            ->take($limit)
            ->get();
    }
}
