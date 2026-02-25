<?php

namespace App\Http\Controllers\Public\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        $posts = $user->favoritePosts()->latest()->paginate(10);
        return view('public.user.posts.favorites', compact('user', 'posts'));
    }
}
