<?php

namespace App\Http\Controllers\Admin\Users\Role;

use App\Models\Permission;
use App\Models\Role;

class ShowController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Role $role)
    {
        $users = $role->users()->paginate(10);
        
         $permissions = Permission::all()->groupBy('header');
        return view('admin.users.role.show', compact('role', 'users','permissions')); // Можно заменить на вашу главную страницу

    }
}
