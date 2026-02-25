<?php

namespace App\Http\Controllers\Public\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LikedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        $posts = $user->likedPosts()->latest()->paginate(10);
        return view('public.user.posts.liked', compact('user', 'posts'));
    }
}
