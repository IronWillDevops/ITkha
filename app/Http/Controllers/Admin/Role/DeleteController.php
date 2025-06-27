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
            return redirect()->route('admin.role.index')->with('toast', [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'Role successfully deleted.',
            ]);
        } catch (CannotDeleteProtectedRoleException $ex) {
            return redirect()->route('admin.role.index')->with('toast', [
                'type' => 'danger', // success | info | warning | danger
                'title' => 'Danger',
                'message' => $ex->getMessage(),
            ]);;
        }
    }
}
