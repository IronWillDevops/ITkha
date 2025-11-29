<?php

namespace App\Http\Controllers\Admin\Posts\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;

class EditController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category)
    {
             return view('admin.posts.category.edit', compact('category')); 
    
    }
}
