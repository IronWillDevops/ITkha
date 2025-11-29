<?php

namespace App\Http\Controllers\Admin\Users\Role;

use App\Models\Permission;
use App\Models\Role;

class EditController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Role $role)
    {
        $permissions = Permission::all()->groupBy('header');
        return view('admin.users.role.edit', compact('role','permissions')); // Можно заменить на вашу главную страницу

    }
}
