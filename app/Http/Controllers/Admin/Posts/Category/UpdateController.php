<?php

namespace App\Http\Controllers\Admin\Posts\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Posts\Category\UpdateRequest;
use App\Models\Category;
use Exception;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, Category $category)
    {
    
        try {
            $data = $request->validated();
            $category->update($data);
            return redirect()->route('admin.category.show', $category->id)->with('success', __('admin/category.messages.updated', ['title' => $category->title]));
        } catch (Exception $ex) {
            
            logger()->error('Category update failed', ['exception' => $ex]);
            return back()
                ->withInput()
                ->with('error', __('errors/category.update.failed'));
        }
    }
}
