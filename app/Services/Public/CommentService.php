<?php

namespace App\Services\Public;

use App\Enums\CommentStatus;
use App\Models\Comment;

class CommentService
{
    
    public function latestComment(int $limit = 5)
    {
        return Comment::where('status', CommentStatus::APPROVED)
            ->latest()
            ->take($limit)
            ->get();
    }
}
