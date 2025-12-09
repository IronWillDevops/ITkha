<?php

namespace App\Http\Controllers\Admin\Users\User;

use App\Models\User;
use Illuminate\Http\Request;

class ShowController extends BaseController
{
 
    public function __invoke(Request $request, User $user)
    {
        $sortField = $request->get('sort_field', 'id');
        $sortDirection = $request->get('sort_direction', 'desc');
        $search = $request->get('search', null);

        $query = $user->posts()->with('category', 'tags');

        // Поиск по названию
        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        $posts = $query->orderBy($sortField, $sortDirection)->paginate(10)->appends($request->query());

        $columns = [
            ['key' => 'id', 'label' => __('admin/common.fields.id')],
            ['key' => 'title', 'label' => __('admin/common.fields.title')],
            ['key' => 'category.title', 'label' => __('admin/common.fields.category')],
            ['key' => 'tags', 'label' => __('admin/common.fields.tag')],
            ['key' => 'status', 'label' => __('admin/common.fields.status')],
            ['key' => 'created_at', 'label' => __('admin/common.fields.created_at')],
        ];

        return view('admin.users.user.show', compact('user', 'posts', 'columns', 'sortField', 'sortDirection'));
    }
}
