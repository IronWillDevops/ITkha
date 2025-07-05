<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\Role;
use App\UserStatus;

class CreateController extends BaseController
{
  public function __invoke()
    {
      
      $roles = Role::all();
      $statuses = UserStatus::cases();
        return view('admin.pages.user.create',compact('roles','statuses')); // Можно заменить на вашу главную страницу
    }
}
