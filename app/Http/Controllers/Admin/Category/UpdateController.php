<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        return view('admin.pages.category.show', compact('category')); // Можно заменить на вашу главную страницу

    }
}
