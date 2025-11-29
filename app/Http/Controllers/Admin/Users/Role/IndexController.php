<?php

namespace App\Http\Controllers\Admin\Users\Role;

use App\Models\Role;

class IndexController extends BaseController
{
    public function __invoke()
    {

        $roles = Role::paginate(10);
        return view('admin.users.role.index', compact('roles')); // Можно заменить на вашу главную страницу

    }
}
