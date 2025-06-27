<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function store($data)
    {
        if (isset($data['role_id'])) {
            $role_id = $data['role_id'];
            unset($data['role_id']);
        }

        if (!empty($data['email_verified_at'])) {
            $data['email_verified_at'] = now();
        } else {
            $data['email_verified_at'] = null;
        }
        unset($data['is_verify']);

        $data['password'] = Hash::make($data['password']);

        $user = User::firstOrCreate(['email' => $data['email']], $data);

        if (isset($role_id)) {

            $user->roles()->attach($role_id);
        }
    }

    public function update($data, $user)
    {
        if (!empty($data['email_verified_at'])) {
            $data['email_verified_at'] = now();
        } else {
            $data['email_verified_at'] = null;
        }
        unset($data['is_verify']);

        
        $user->update($data);

        // Предположим, в форме ты передаёшь роль как role_id
        if (isset($data['role_id'])) {
            $user->roles()->sync([$data['role_id']]); // удалит старые роли и привяжет новую
        }



        return $user;
    }
}
