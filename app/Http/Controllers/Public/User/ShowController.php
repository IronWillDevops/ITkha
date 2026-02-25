<?php

namespace App\Http\Controllers\Public\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Public\PostService;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user,PostService $postService)
    {
        $posts = $postService->postsByUser($user->id)->paginate(10);
        return view('public.user.posts.index', compact('user', 'posts'));
    }
}
