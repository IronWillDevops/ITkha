<?php

namespace App\Http\Controllers\Admin\Posts\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Comment $comment)
    {
        try {
            $comment->delete();
            return redirect()->route('admin.comment.index')->with('success', __('admin/comment.messages.deleted', ['body' => $comment->body]));
        } catch (Exception $ex) {
            return redirect()->back()->with('error', __('errors/comment.delete.failed'));
        }
    }
}
