<?php

namespace App\Http\Controllers\Admin\Posts\Comment;

use App\Enums\CommentStatus;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;

class EditController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Comment $comment)
    {
        
        $users= User::all();
        $status=CommentStatus::cases();
        return view('admin.comment.edit', compact('comment','status','users'));
    }
}
