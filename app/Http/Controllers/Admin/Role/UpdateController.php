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
            return  redirect()->route('admin.role.show', $role)->with('success', __('admin/roles.messages.edit', ['title' => $role->title])); 
        } catch (CannotUpdateProtectedRoleException $ex) {
            return redirect()->route('admin.role.index')->with('error',$ex->getMessage() );
        }
    }
}
