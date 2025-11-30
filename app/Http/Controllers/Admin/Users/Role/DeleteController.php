<?php

namespace App\Http\Controllers\Admin\Users\Role;

use App\Exceptions\Role\CannotDeleteProtectedRoleException;
use App\Models\Role;

class DeleteController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Role $role)
    {
        try {
            $role->delete();
            return redirect()->route('admin.role.index')->with('success', __('admin/role.messages.deleted', ['title' => $role->title]));
        } catch (CannotDeleteProtectedRoleException $ex) {
            return redirect()->route('admin.role.index')->with('error', $ex->getMessage());
        }
    }
}
