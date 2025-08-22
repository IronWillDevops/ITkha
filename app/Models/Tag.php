<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{   
    use SoftDeletes;
    protected $fillable = ['title'];

    public function posts()
    {
        return $this->belongsToMany(Post::class,'post_tags');
    }
}

