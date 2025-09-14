<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\Role;
use App\Enums\UserStatus;

class CreateController extends BaseController
{
  public function __invoke()
    {
      
      $roles = Role::all();
      $status = UserStatus::cases();
        return view('admin.user.create',compact('roles','status')); // Можно заменить на вашу главную страницу
    }
}
