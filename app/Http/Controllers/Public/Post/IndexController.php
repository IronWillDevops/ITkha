<?php

namespace App\Http\Controllers\Public\Post;

use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Public\Post\FilterRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Enums\PostStatus;
use App\Services\Public\CommentService;
use App\Services\Public\PostService;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FilterRequest $request, PostService $postService,CommentService $commentService)
    {


        $data = $request->validated();
        // Задаємо дефолтне сортування, якщо не передано
        if (empty($data['sort_by'])) {
            $data['sort_by'] = 'created_at';
        }
        if (empty($data['sort_dir'])) {
            $data['sort_dir'] = 'desc';
        }
        $filter = app()->make(PostFilter::class, [
            'queryParams' => array_filter($data, fn($v) => $v !== null && $v !== '')
        ]);
        $posts = Post::where('status', PostStatus::PUBLISHED) // 
            ->filter($filter)
            ->orderBy($data['sort_by'], $data['sort_dir'])
            ->paginate(30);

        $categories = Category::all();
        $tags = Tag::all();
        $popularPosts = $postService->popularPosts();
        $latestComment =$commentService->latestComment();

        return view('public.post.index', compact('posts', 'categories', 'tags', 'popularPosts', 'latestComment'));
    }
}
