<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke()
    {

        $postCount = Post::count();
        $categoryCount = Category::count();
        $tagCount = Tag::count();
        $userCount = User::count();

        return view('admin.index', compact('postCount', 'categoryCount', 'tagCount', 'userCount'));
    }
}
