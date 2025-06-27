<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $tags = Tag::All();
        return view('admin.pages.tag.index', compact('tags')); // Можно заменить на вашу главную страницу
    }
}
