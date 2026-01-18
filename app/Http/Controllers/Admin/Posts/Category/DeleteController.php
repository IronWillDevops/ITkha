<?php

namespace App\Http\Controllers\Admin\Posts\Category;

use App\Exceptions\Category\CannotDeleteCategoryWithPostsException;
use App\Exceptions\Category\CannotDeleteLastCategoryException;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('admin.category.index')->with('success', __('admin/category.messages.deleted', ['title' => $category->title]));
        } catch (CannotDeleteLastCategoryException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        } catch (CannotDeleteCategoryWithPostsException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        } catch (Exception $ex) {
            logger()->error('Category delete failed', ['exception' => $ex]);
            return redirect()->back()->with('error', __('errors/category.delete.failed'));
        }
    }
}
