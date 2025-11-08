<?php

namespace App\Http\Controllers\Public\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Enums\PostStatus;
use App\Services\Public\CommentService;
use App\Services\Public\PostService;

class ShowController extends Controller
{
  /**
   * Handle the incoming request.
   */

  public function __invoke(Post $post, PostService $postService, CommentService $commentService)
  {

    $postId = $post->id;
    // Используем объектный метод
    $postKey = $post->cacheKey();

    $post = Post::cacheGet($postKey, function () use ($postId) {
      return Post::where('id', $postId)
        ->where('status', PostStatus::PUBLISHED->value)
        ->with([
          'comments' => fn($query) => $query->approved()->whereNull('parent_id')->with([
            'children' => fn($q) => $q->approved()->with('user'),
            'user'
          ])
        ])
        ->first();
    });

    if (!$post) {
      // Обработка случая, когда пост не найден, например, редирект на 404 или на страницу с ошибкой
      abort(404);
    }

    $post->load([
      'comments' => fn($query) => $query->approved()->whereNull('parent_id')->with([
        'children' => fn($q) => $q->approved()->with('user'),
        'user'
      ])
    ]);



    $viewKey = "post:views:{$post->id}";
    if (!session()->has($viewKey)) {

      if (\App\Models\Post::isRedisAvailable()) {
        try {
          Post::incrementCacheCounter($viewKey);
        } catch (\Throwable $e) {
          \Log::warning('Redis error, incrementing DB view counter for post ' . $post->id);
          $post->increment('views');
        }
      } else {
        // Redis недоступен — сразу инкрементируем БД
        $post->increment('views');
      }

      session()->put($viewKey, true);
    }

    $popularPosts = $postService->popularPosts();
    $similarPosts = $postService->similarPosts($post);
    $latestComment = $commentService->latestComment();

    return view('public.post.show', compact('post', 'popularPosts', 'similarPosts', 'latestComment'));
  }
}
