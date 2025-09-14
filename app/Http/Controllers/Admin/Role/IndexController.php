<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke()
    {

        $roles = Role::paginate(10);
        return view('admin.role.index', compact('roles')); // Можно заменить на вашу главную страницу

    }
}
