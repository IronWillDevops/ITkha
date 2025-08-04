<?php

namespace App\Services\Public\Post;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Enums\PostStatus;
use App\Http\Filters\PostFilter;

class PostService
{

    public function getFilteredPosts(array $data)
    {
        $data['sort_by'] = $data['sort_by'] ?? 'created_at';
        $data['sort_dir'] = $data['sort_dir'] ?? 'desc';

        $filter = app()->make(PostFilter::class, [
            'queryParams' => array_filter($data, fn($v) => $v !== null && $v !== '')
        ]);

        return Post::where('status', PostStatus::PUBLISHED)
            ->filter($filter)
            ->orderBy($data['sort_by'], $data['sort_dir'])
            ->paginate(30);
    }

    public function getAllCategories()
    {
        return Category::all();
    }

    public function getAllTags()
    {
        return Tag::all();
    }
    
    public function getPostForShow(Post $post)
    {
        return Post::with([
            'comments' => fn($query) =>
            $query->approved()
                ->whereNull('parent_id')
                ->with([
                    'children' => fn($q) => $q->approved()->with('user'),
                    'user'
                ])
        ])
            ->where('id', $post->id)
            ->where('status', PostStatus::PUBLISHED->value)
            ->firstOrFail();
    }

    public function incrementViewCount(Post $post)
    {
        $sessionKey = 'post_viewed_' . $post->id;

        if (!session()->has($sessionKey)) {
            $post->timestamps = false;
            $post->views += 1;
            $post->save();

            session()->put($sessionKey, true);
        }
    }

    public function popularPosts(int $limit = 6)
    {
        return Post::withCount('likedByUsers')
            ->where('status', PostStatus::PUBLISHED)
            ->orderByDesc('liked_by_users_count')
            ->take($limit)
            ->get();
    }

    public function popularPostsByUser(int $user_id)
    {
        return Post::withCount('likedByUsers')
            ->where('status', PostStatus::PUBLISHED)
            ->where('user_id', $user_id)
            ->orderByDesc('liked_by_users_count');
    }

    public function similarPosts(Post $post, int $limit = 6)
    {
        return Post::where('id', '!=', $post->id)
            ->where('status', PostStatus::PUBLISHED)
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
