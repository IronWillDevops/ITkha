<?php

namespace App\Http\Controllers\Admin\Tag;

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
        return view('admin.pages.tag.show', compact('tag')); // Можно заменить на вашу главную страницу
    }
}
