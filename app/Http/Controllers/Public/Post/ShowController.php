<?php

namespace App\Http\Controllers\Public\Post;


use App\Models\Post;

class ShowController extends BaseController
{
  /**
   * Handle the incoming request.
   */

  public function __invoke(Post $post)
  {
    $post = $this->service->getPostForShow($post);

    $this->service->incrementViewCount($post);

    $popularPosts = $this->service->popularPosts();
    $similarPosts = $this->service->similarPosts($post);

    return view('public.post.show', compact('post', 'popularPosts', 'similarPosts'));
  }
}
