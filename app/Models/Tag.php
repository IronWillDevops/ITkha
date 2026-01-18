<?php

namespace App\Models;

use App\Exceptions\Tag\CannotDeleteTagWithPostsException;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes, LogsActivity;
    protected $fillable = ['title'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags');
    }
    protected static function booted()
    {
        static::deleting(function ($tag) {
            // Проверяем, есть ли связанные посты
            if ($tag->posts()->exists()) {
                throw new CannotDeleteTagWithPostsException();
            }           
        });
    }
}
