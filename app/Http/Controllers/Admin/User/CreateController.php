<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\Role;

class CreateController extends BaseController
{
  public function __invoke()
    {
      
      $roles = Role::all();
        return view('admin.pages.user.create',compact('roles')); // Можно заменить на вашу главную страницу
    }
}
