<?php

namespace App\Http\Controllers\Admin\Category;

use App\Exceptions\Category\CannotDeleteCategoryWithPostsException;
use App\Exceptions\Category\CannotDeleteLastCategoryException;
use App\Http\Controllers\Controller;
use App\Models\Category;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category)
    {
        try {
            $category->delete();
             return redirect()->route('admin.category.index')->with('success', __('admin/categories.messages.delete',['title' => $category->title])); 
        } 
        catch (CannotDeleteLastCategoryException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        } 
        catch (CannotDeleteCategoryWithPostsException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
