<?php

namespace App\Http\Controllers\Public\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\PostStatus;
use App\Services\Public\PostService;
use Illuminate\Http\Request;

class ShowController extends Controller
{
  /**
   * Handle the incoming request.
   */
  // public function __invoke(Post $post, PostService $postService)
  // {
  //   $post = Post::where('id', $post->id)
  //     ->where('status', PostStatus::PUBLISHED->value)
  //     ->firstOrFail();


  //   $sessionKey = 'post_viewed_' . $post->id;

  //   if (!session()->has($sessionKey)) {
  //     $post->timestamps = false; // Вимикаємо оновлення updated_at
  //     $post->views += 1;
  //     $post->save();
  //     session()->put($sessionKey, true);
  //   }

  //   $popularPosts = $postService->popularPosts();
  //   $similarPosts = $postService->similarPosts($post);
  //   return view('public.post.show', compact('post', 'popularPosts', 'similarPosts'));
  // }
  public function __invoke(Post $post, PostService $postService)
  {
    $post = Post::with([
      'comments' => fn($query) =>
      $query->approved()->whereNull('parent_id')->with([
        'children' => fn($q) => $q->approved()->with('user'),
        'user'
      ])
    ])
      ->where('id', $post->id)
      ->where('status', PostStatus::PUBLISHED->value)
      ->firstOrFail();

    $sessionKey = 'post_viewed_' . $post->id;

    if (!session()->has($sessionKey)) {
      $post->timestamps = false;
      $post->views += 1;
      $post->save();
      session()->put($sessionKey, true);
    }

    $popularPosts = $postService->popularPosts();
    $similarPosts = $postService->similarPosts($post);

    return view('public.post.show', compact('post', 'popularPosts', 'similarPosts'));
  }
}
