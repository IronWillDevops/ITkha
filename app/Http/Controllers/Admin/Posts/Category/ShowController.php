<?php

namespace App\Http\Controllers\Admin\Posts\Category;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category, Request $request)
    {
        $columns = [
            ['key' => 'id', 'label' => 'ID'],
            ['key' => 'title', 'label' => __('admin/common.fields.title')],
            ['key' => 'status', 'label' => __('admin/common.fields.status')],
            ['key' => 'created_at', 'label' => __('admin/common.fields.created_at')],
        ];

        $sortField = $request->get('sort_field', 'id');
        $sortDirection = $request->get('sort_direction', 'desc');
        $search = $request->get('search');

        $query = $category->posts();

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        $query->orderBy($sortField, $sortDirection);

        $posts = $query->paginate(10);

        return view('admin.posts.category.show', compact(
            'category',
            'posts',
            'columns',
            'sortField',
            'sortDirection'
        ));
    }
}
