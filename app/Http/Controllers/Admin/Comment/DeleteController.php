<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comment.index')->with('success', __('admin/comment.messages.delete', ['body' => $comment->body]));
    }
}
