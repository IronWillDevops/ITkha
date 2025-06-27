<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;

class EditController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category)
    {
             return view('admin.pages.category.edit', compact('category')); // Можно заменить на вашу главную страницу
    
    }
}
