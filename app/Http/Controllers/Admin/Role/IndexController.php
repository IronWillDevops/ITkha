<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke()
    {

        $roles = Role::all();
        return view('admin.pages.role.index', compact('roles')); // Можно заменить на вашу главную страницу

    }
}
