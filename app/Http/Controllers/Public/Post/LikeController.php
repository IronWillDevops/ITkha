<?php

namespace App\Http\Controllers\Public\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function __invoke(Post $post)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($user->likedPosts->contains($post->id)) {
            $user->likedPosts()->detach($post->id);
            $liked = false;
        } else {
            $user->likedPosts()->attach($post->id);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likes_count' => $post->likedByUsers()->count(),
        ]);
    }
}
