<?php

namespace App\Http\Controllers\Admin\Users\User;

use App\Models\Role;
use App\Enums\UserStatus;
use App\Models\Setting;

class CreateController extends BaseController
{
  public function __invoke()
  {

    $roles = Role::all();
    $status = UserStatus::cases();
    $settings = Setting::allSettings();


    return view('admin.users.user.create', compact('roles', 'status', 'settings'));
  }
}
