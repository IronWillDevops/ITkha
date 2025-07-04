<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\Role;
use App\Models\User;
use App\UserStatus;

class EditController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {

        $roles = Role::all();
        $statuses = UserStatus::cases();
        return view('admin.pages.user.edit', compact('user', 'roles', 'statuses')); // Можно заменить на вашу главную страницу

    }
}
