<?php

namespace App\Services\Admin;

use App\Models\Role;
use Illuminate\Support\Collection;
use App\Exceptions\Role\CannotUpdateProtectedRoleException;
use Exception;
use Illuminate\Support\Facades\DB;

class RoleService
{
    public function store(array $data): Role
    {
        return DB::transaction(function () use ($data) {
            $permissions = $data['permissions'] ?? [];
            unset($data['permissions']);

            $role = Role::create($data);
            $role->permissions()->sync($permissions);

            return $role;
        });
    }

    public function update(array $data, Role $role): Role
     {
        if ($role->isProtected()) {
            throw new CannotUpdateProtectedRoleException();
        }

        return DB::transaction(function () use ($data, $role) {
            $permissions = $data['permissions'] ?? [];
            unset($data['permissions']);

            $role->update($data);
            $role->permissions()->sync($permissions);

            return $role;
        });
    }
}
