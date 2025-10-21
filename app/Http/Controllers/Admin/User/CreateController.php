<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\Role;
use App\Enums\UserStatus;
use App\Models\Setting;

class CreateController extends BaseController
{
  public function __invoke()
  {

    $roles = Role::all();
    $status = UserStatus::cases();
    $user_default_status = Setting::get('user_default_status');
    $user_default_role = Setting::get('user_default_role');
    $user_require_email_verification = (bool)Setting::get('user_require_email_verification');


    return view('admin.user.create', compact('roles', 'status','user_default_status','user_default_role', 'user_require_email_verification'));
  }
}
