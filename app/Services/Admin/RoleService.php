<?php

namespace App\Services\Admin;

use App\Models\Role;
use App\Exceptions\Role\CannotUpdateProtectedRoleException;

class RoleService
{
    public function store($data)
    {
        $permissions = $data['permissions'] ?? [];
        unset($data['permissions']);

        // Создание роли
        $role = Role::create($data);

        // Привязка прав к роли
        $role->permissions()->sync($permissions);
    }

    public function update($data, $role)
    {
        if (in_array($role->id, [1, 2, 3])) {
            throw new CannotUpdateProtectedRoleException();
        }
        $permissions = $data['permissions'] ?? [];
        unset($data['permissions']);

        // Обновляем название роли
        $role->update($data);

        // Синхронизируем разрешения (старые будут удалены, новые добавлены)
        $role->permissions()->sync($permissions);

        return $role;
    }
}
