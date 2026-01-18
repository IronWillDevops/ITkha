<?php

namespace App\Http\Controllers\Admin\Users\User;

use App\Exceptions\User\CannotDeleteAdminUserException;
use App\Exceptions\User\CannotDeleteSelfException;
use App\Models\User;
use Exception;

class DeleteController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('admin.user.index')->with('success', __('admin/user.messages.deleted', ['login' => $user->login]));
        } catch (CannotDeleteAdminUserException $ex) {
            return redirect()->route('admin.user.index')->with('error', $ex->getMessage());
        } catch (CannotDeleteSelfException $ex) {
            return redirect()->route('admin.user.index')->with('error', $ex->getMessage());
        } catch (Exception $ex) {
            logger()->error('User delete failed', ['exception' => $ex]);
            return redirect()->back()->with('error', __('errors/user.delete.failed'));
        }
    }
}
