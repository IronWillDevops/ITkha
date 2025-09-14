<?php

namespace App\Models;

use App\Exceptions\Category\CannotDeleteCategoryWithPostsException;
use App\Exceptions\Category\CannotDeleteLastCategoryException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['title'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    protected static function booted()
    {

        static::deleting(function ($category) {
            // Проверяем, есть ли связанные посты
            if ($category->posts()->exists()) {
                throw new CannotDeleteCategoryWithPostsException();
            }

            $total = static::whereNull('deleted_at')->count();
            if ($total <= 1) {
                throw new CannotDeleteLastCategoryException();
            }
        });
    }
}
