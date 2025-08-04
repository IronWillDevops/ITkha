<?php

namespace App\Http\Controllers\Public\User;
use App\Models\User;

use App\Http\Controllers\Controller;
use App\Services\Public\Post\PostService;

class ShowController extends Controller
{
  public function __construct(
    protected PostService $service
  ) {}
  /**
   * Handle the incoming request.
   */
  public function __invoke(User $user)
  {
    $posts = $this->service->popularPostsByUser($user->id)->paginate(10);
    return view('public.user.show', compact('user', 'posts'));
  }
}
