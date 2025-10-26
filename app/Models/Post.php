<?php

namespace App\Models;

use App\Enums\CommentStatus;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Traits\Filterable;
use App\Models\Traits\Cacheable;
use App\Models\Traits\Viewable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Redis;

class Post extends Model
{
    use SoftDeletes,
        HasFactory,
        Filterable,
        Cacheable,
        Viewable;
    protected $fillable = [
        'title',
        'content',
        'main_image',
        'status',
        'comments_enabled',
        'likes',
        'views',
        'category_id',
        'user_id'
    ];

    protected $casts = [
        'comments_enabled' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
   protected $appends = ['actual_views'];
    // Post
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Like
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    public function isLikedBy(User $user): bool
    {
        return $this->likedByUsers()->where('user_id', $user->id)->exists();
    }
    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    // Comments
    public function comments()
    {
        return $this->hasMany(Comment::class)->with('children');
    }
    public function allApprovedComments()
    {
        return $this->hasMany(Comment::class)->with('children')->where('status', CommentStatus::APPROVED);
    }
}
