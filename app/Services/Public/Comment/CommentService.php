<?php

namespace  App\Services\Public\Comment;

use App\Enums\CommentStatus;
use App\Models\Comment;
use App\Models\Post;

class CommentService
{
    public function store($data)
    {
       
        $post = Post::findOrFail($data['post_id']);

        if (! $post->comments_enabled) {
            abort(403, __('post.comment.comments_disabled'));
        }

        Comment::create([
            'post_id' => $data['post_id'],
            'user_id' => auth()->id(),
            'body' => $data['body'],
            'parent_id' => $data['parent_id'] ?? null,
            'status' => CommentStatus::APPROVED,
        ]);
    }
}
