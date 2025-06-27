<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $posts = Post::with(['category', 'tags'])->paginate(10); // 10 постів на сторінку
        $tags = Tag::all();

        return view('admin.pages.post.index', compact('posts', 'tags'));
    }
}
