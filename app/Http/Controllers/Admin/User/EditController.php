<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\Role;
use App\Models\User;
use App\Enums\UserStatus;

class EditController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        $roles = Role::all();
        $status = UserStatus::cases();
        return view('admin.user.edit', compact('user', 'roles', 'status')); // Можно заменить на вашу главную страницу

    }
}
