<?php

namespace App\Http\Controllers\Public\Comment;

use App\Enums\CommentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Comment\StoreRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        
        $post = Post::findOrFail($data['post_id']);

        if (! $post->comments_enabled) {
            abort(403, __('public/comment.comments_disabled'));
        }

        Comment::create([
            'post_id' => $data['post_id'],
            'user_id' => auth()->id(),
            'body' => $data['body'],
            'parent_id' => $data['parent_id'] ?? null,
            'status' => CommentStatus::APPROVED,
        ]);

        return redirect()->back()->with('success', __('public/comment.messages.comment_added'));
    }
}
