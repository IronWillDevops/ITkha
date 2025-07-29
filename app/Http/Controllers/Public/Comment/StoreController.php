<?php

namespace App\Http\Controllers\Public\Comment;

use App\CommentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Comment\StoreRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        Comment::create([
            'post_id' => $data['post_id'],
            'user_id' => auth()->id(),
            'body' => $data['body'],
            'parent_id' => $data['parent_id'] ?? null,
            'status' => CommentStatus::PENDING,
        ]);

        return redirect()->back()->with('success', __('post.comment.comment_added'));
    }
}
