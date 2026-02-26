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


        $settings=Setting::allSettings();
        return view('admin.setting.user.edit', compact('status', 'roles', 'settings'));
    }
}
