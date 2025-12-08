<?php

namespace App\Http\Controllers\Admin\Users\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class IndexController extends BaseController
{
   public function __invoke(Request $request)
    {
        // Валидируем сортировку
        $validSortFields = ['id', 'login', 'email', 'status', 'posts_count', 'roles.0.title', 'created_at'];

        $validated = $request->validate([
            'sort_field' => ['nullable', Rule::in($validSortFields)],
            'sort_direction' => ['nullable', Rule::in(['asc', 'desc'])],
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $sortField = $validated['sort_field'] ?? 'id';
        $sortDirection = $validated['sort_direction'] ?? 'desc';
        $search = $validated['search'] ?? null;

        $query = User::query()->with('roles')->withCount('posts');

        // Поиск
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('login', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Сортировка
        if ($sortField === 'roles.0.title') {
            // сортируем по первой роли
            $query->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
                  ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
                  ->groupBy('users.id')
                  ->orderByRaw('MIN(roles.title) '.$sortDirection)
                  ->select('users.*');
        } elseif ($sortField === 'posts_count') {
            $query->orderBy('posts_count', $sortDirection);
        } else {
            $query->orderBy($sortField, $sortDirection);
        }

        $users = $query->paginate(10)->appends($request->query());

        $columns = [
            ['key' => 'id', 'label' => __('admin/common.fields.id')],
            ['key' => 'login', 'label' => __('admin/user.fields.login')],
            ['key' => 'email', 'label' => __('admin/common.fields.email')],
            ['key' => 'roles.0.title', 'label' => __('admin/common.fields.role')],
            ['key' => 'status', 'label' => __('admin/common.fields.status')],
            ['key' => 'posts_count', 'label' => __('admin/common.fields.count')],
            ['key' => 'created_at', 'label' => __('admin/common.fields.created_at')],
        ];

        return view('admin.users.user.index', compact('users', 'columns', 'sortField', 'sortDirection'));
    }

}
