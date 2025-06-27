<?php

namespace App\Http\Controllers\Admin\Role;

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
        return view('admin.pages.role.edit', compact('role','permissions')); // Можно заменить на вашу главную страницу

    }
}
