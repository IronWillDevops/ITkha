<?php

namespace App\Http\Controllers\Admin\Posts\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $comments = Comment::paginate(10);
        return view('admin.posts.comment.index', compact('comments')); 
    }
}
