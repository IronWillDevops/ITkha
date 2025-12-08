<?php

namespace App\Http\Controllers\Admin\Users\Role;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class ShowController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Role $role, Request $request)
    {
        $columns=[
                ['key' => 'id', 'label' => __('admin/common.fields.id')],
                ['key' => 'login', 'label' => __('admin/user.fields.login')],
                ['key' => 'email', 'label' => __('admin/common.fields.email')],
                ['key' => 'roles.0.title', 'label' => __('admin/common.fields.role')],
                ['key' => 'status', 'label' => __('admin/common.fields.status')],
                ['key' => 'posts_count', 'label' => __('admin/common.fields.count')],
                ['key' => 'created_at', 'label' => __('admin/common.fields.created_at')],
            ];
        // Сортировка
        $sortField = $request->get('sort_field', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');

        // Поиск
        $search = $request->get('search', null);

        $query = $role->users();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('login', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $allowedSorts = ['id', 'login', 'email', 'status', 'created_at'];
        if (!in_array($sortField, $allowedSorts)) {
            $sortField = 'id';
        }

        $users = $query->orderBy($sortField, $sortDirection)
                       ->paginate(10)
                       ->appends($request->query());

        $permissions = Permission::all()->groupBy('header');

        return view('admin.users.role.show', compact('role','columns', 'users', 'permissions', 'sortField', 'sortDirection', 'search'));
    }
}
