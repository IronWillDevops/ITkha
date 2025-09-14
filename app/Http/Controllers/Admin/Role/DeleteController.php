<?php

namespace App\Http\Controllers\Admin\Role;

use App\Exceptions\Role\CannotDeleteProtectedRoleException;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class DeleteController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Role $role)
    {
        try {
            $role->delete();
            return redirect()->route('admin.role.index')->with('success', __('admin/roles.messages.delete', ['title' => $role->title]));
        } catch (CannotDeleteProtectedRoleException $ex) {
            return redirect()->route('admin.role.index')->with('error', $ex->getMessage());
        }
    }
}
