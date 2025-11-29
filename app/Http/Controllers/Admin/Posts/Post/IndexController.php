<?php

namespace App\Http\Controllers\Admin\Posts\Post;

use App\Models\Post;
use App\Models\Tag;

class IndexController extends BaseController
{
    public function __invoke()
    {
          $posts = Post::with(['category', 'tags'])
        ->orderBy('id', 'desc') // найновіші першими
        ->paginate(10);
        $tags = Tag::all();

        return view('admin.posts.post.index', compact('posts', 'tags'));
    }
}
