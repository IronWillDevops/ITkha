<?php

namespace App\Http\Controllers\Admin\Posts\Post;

use App\Enums\PostStatus;
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
        $status=PostStatus::cases();
        return view('admin.post.edit', compact('post','categories','tags','users','status')); // Можно заменить на вашу главную страницу/

    }
}
