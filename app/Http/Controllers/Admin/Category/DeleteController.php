<?php

namespace App\Http\Controllers\Admin\Category;

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
            return redirect()->back()->with('toast', [
            'type' => 'success', // success | info | warning | danger
            'title' => 'Success',
            'message' => 'User successfully created.',
        ]);
        } catch (CannotDeleteLastCategoryException $ex) {
            return redirect()->back()->with('toast', [
            'type' => 'danger', // success | info | warning | danger
            'title' => 'Danger',
            'message' => $ex->getMessage(),
        ]);;
        }
    }
}
