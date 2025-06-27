<?php

namespace App\Http\Controllers\Admin\Role;

use App\Exceptions\Role\CannotUpdateProtectedRoleException;
use App\Http\Requests\Admin\Role\UpdateRequest;
use App\Models\Role;

class UpdateController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, Role $role)
    {
        try {
            $data = $request->validated();
            $role = $this->service->update($data, $role);
            return view('admin.pages.role.show', compact('role')); // Можно заменить на вашу главную страницу
        } catch (CannotUpdateProtectedRoleException $ex) {
            return redirect()->route('admin.role.index')->with('toast', [
                'type' => 'danger', // success | info | warning | danger
                'title' => 'Danger',
                'message' => $ex->getMessage(),
            ]);
        }
    }
}
