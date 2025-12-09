<?php

namespace App\Http\Controllers\Admin\Users\Role;

use App\Models\Role;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke(Request $request)
    {
        $sortField = $request->get('sort_field', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        $search = $request->get('search', null);

        $query = Role::withCount('users'); // <-- Добавляем withCount, чтобы MySQL знал о поле users_count

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        // Разрешаем сортировку только по допустимым полям
        $allowedSorts = ['id', 'title', 'users_count', 'created_at'];
        if (!in_array($sortField, $allowedSorts)) {
            $sortField = 'id';
        }

        $roles = $query->orderBy($sortField, $sortDirection)
                       ->paginate(10)
                       ->appends($request->query());

        $columns = [
            ['key' => 'id', 'label' => __('admin/common.fields.id')],
            ['key' => 'title', 'label' => __('admin/common.fields.title')],
            ['key' => 'users_count', 'label' => __('admin/common.fields.count')],
            ['key' => 'created_at', 'label' => __('admin/common.fields.created_at')],
        ];

        return view('admin.users.role.index', compact('roles', 'columns', 'sortField', 'sortDirection'));
    }
}
