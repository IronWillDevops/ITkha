<?php

namespace App\Http\Controllers\Admin\Setting\User;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Setting;
use Illuminate\Http\Request;

class EditController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $roles = Role::all();
        $status = UserStatus::cases();

        $user_default_status = Setting::get('user_default_status');
        $user_default_role = Setting::get('user_default_role');
        $user_require_email_verification = (bool)Setting::get('user_require_email_verification');
        return view('admin.setting.user.edit', compact('status', 'roles', 'user_default_status', 'user_default_role', 'user_require_email_verification'));
    }
}
