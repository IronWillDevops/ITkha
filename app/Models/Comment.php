<?php

namespace App\Models;

use App\Enums\CommentStatus;
use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,
        SoftDeletes,
        LogsActivity;

    protected $fillable = ['post_id', 'user_id', 'parent_id', 'body',  'status',];


    protected $casts = [
        'status' => CommentStatus::class,

    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('children');
    }
    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', CommentStatus::APPROVED);
    }
}
