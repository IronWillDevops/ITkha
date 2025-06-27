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
            return redirect()->route('admin.user.index')->with('toast', [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'User successfully deleted.',
            ]);;
        }
        
        catch (CannotDeleteSelfException | CannotDeleteAdminUserException $ex) {

            return redirect()->route('admin.user.index')->with('toast', [
                'type' => 'danger', // success | info | warning | danger
                'title' => 'Danger',
                'message' => $ex->getMessage(),
            ]);;
        }
    }
}
