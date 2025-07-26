<?php

namespace App\Http\Controllers\Public\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Public\PostService;
use Illuminate\Http\Request;

class ShowController extends Controller
{
 
  /**
   * Handle the incoming request.
   */
  public function __invoke(User $user, PostService $postService)
  {
    $posts = $postService->popularPostsByUser($user->id)->paginate(10);
    return view('public.user.show', compact('user', 'posts'));
  }
}
