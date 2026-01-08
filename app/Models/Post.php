<?php

namespace App\Models;

use App\Enums\CommentStatus;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Traits\Filterable;
use App\Models\Traits\Cacheable;
use App\Models\Traits\HasMedia;
use App\Models\Traits\HasSlug;
use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use SoftDeletes,
        HasFactory,
        Filterable,
        Cacheable,
        HasSlug,
        HasMedia,
        LogsActivity;


    protected $slugSource = 'title';   // генерируем slug из title
    protected $slugColumn = 'slug';    // сохраняем в колонку slug
    protected $slugShouldUpdate = true; // если хочешь перегенерировать при изменении title
    protected $fillable = [
        'title',
        'content',
        // 'main_image',
        'status',
        'comments_enabled',
        'likes',
        'views',
        'category_id',
        'user_id',
        'published_at',
    ];

    protected $casts = [
        'comments_enabled' => 'boolean',
        'published_at' => 'datetime',
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


    // Comments
    public function comments()
    {
        return $this->hasMany(Comment::class)->with('children');
    }
    public function allApprovedComments()
    {
        return $this->hasMany(Comment::class)->with('children')->where('status', CommentStatus::APPROVED);
    }

    public function getActualViewsAttribute(): int
    {
        $key = "post:views:{$this->id}";
        $cached = self::getCacheCounter($key);

        return $this->views + $cached;
    }

    public function getRouteKeyName(): string
    {
        return $this->getSlugColumn();
    }
}
