<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use SoftDeletes,
        HasFactory,
        Filterable;
    protected $fillable = [
        'title',
        'content',
        'main_image',
        'preview_image',
        'status',
        'likes',
        'views',
        'category_id',
        'user_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

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
}
