<?php

namespace App\Http\Controllers\Admin\Posts\Tag;

use App\Http\Controllers\Controller;

use App\Models\Tag;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Tag $tag)
    {
        $posts = $tag->posts()
            ->orderBy('id', 'desc') // найновіші першими
            ->paginate(10);
        return view('admin.posts.tag.show', compact('tag','posts')); // Можно заменить на вашу главную страницу
    }
}
