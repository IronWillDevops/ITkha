<?php

namespace App\Http\Controllers\Public\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Enums\PostStatus;
use App\Services\Public\CommentService;
use App\Services\Public\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

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
        ->firstOrFail();
    });

    $post->load([
      'comments' => fn($query) => $query->approved()->whereNull('parent_id')->with([
        'children' => fn($q) => $q->approved()->with('user'),
        'user'
      ])
    ]);

    $sessionKey = 'post_viewed_' . $post->id;

    // if (!session()->has($sessionKey)) {
    //   $post->timestamps = false;
    //   $post->views += 1;
    //   $post->save();
    //   session()->put($sessionKey, true);
    // }
    $post->recordView($post->id);


    $popularPosts = $postService->popularPosts();

    $similarPosts =  $postService->similarPosts($post);

    $latestComment = $commentService->latestComment();

    return view('public.post.show', compact('post', 'popularPosts', 'similarPosts', 'latestComment'));
  }
}
