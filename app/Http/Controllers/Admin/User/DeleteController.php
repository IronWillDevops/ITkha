<?php

namespace App\Http\Controllers\Admin\User;

use App\Exceptions\User\CannotDeleteAdminUserException;
use App\Exceptions\User\CannotDeleteSelfException;
use App\Models\User;

class DeleteController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('admin.user.index')->with('success', __('admin/users.messages.delete', ['login' => $user->login]));
        }
        
        catch (CannotDeleteSelfException | CannotDeleteAdminUserException $ex) {

            return redirect()->route('admin.user.index')->with('error', $ex->getMessage());
        }
    }
}
