<?php

namespace App\Http\Controllers\Admin\Role;

use App\Models\Role;

class ShowController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Role $role)
    {
          return view('admin.pages.role.show',compact('role')); // Можно заменить на вашу главную страницу

    }
}
