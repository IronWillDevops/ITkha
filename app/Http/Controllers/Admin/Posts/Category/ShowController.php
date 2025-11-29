<?php

namespace App\Http\Controllers\Admin\Posts\Category;

use App\Http\Controllers\Controller;

use App\Models\Category;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category)
    { $posts = $category->posts()
            ->orderBy('id', 'desc') // найновіші першими
            ->paginate(10);
        return view('admin.category.show', compact('category','posts')); // Можно заменить на вашу главную страницу
    }
}
