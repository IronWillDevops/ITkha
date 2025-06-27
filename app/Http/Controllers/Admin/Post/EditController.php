<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;

class EditController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $users= User::all();
        return view('admin.pages.post.edit', compact('post','categories','tags','users')); // Можно заменить на вашу главную страницу

    }
}
