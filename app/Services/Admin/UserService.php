<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

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
        // Обработка аватара (необязательное поле)
        if (isset($data['avatar']) && $data['avatar'] instanceof \Illuminate\Http\UploadedFile) {
            // Удаление предыдущего аватара, если он есть
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Сохранение нового аватара в правильное место
            $avatarPath = $data['avatar']->store("avatars/{$user->id}", 'public');
            $data['avatar'] = $avatarPath;
        }


        if (!empty($data['email_verified_at'])) {
            $data['email_verified_at'] = now();
        } else {
            $data['email_verified_at'] = null;
        }

        unset($data['is_verify']);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // Удаляем, чтобы не затереть текущий
        }

        $user->update($data);

        // Предположим, в форме ты передаёшь роль как role_id
        if (isset($data['role_id'])) {
            $user->roles()->sync([$data['role_id']]); // удалит старые роли и привяжет новую
        }

        // Оновлення або створення профілю користувача
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'job_title' => $data['job_title'] ?? null,
                'address' => $data['address'] ?? null,
                'about_myself' => $data['about_myself'] ?? null,
                'github' => $data['github'] ?? null,
                'linkedin' => $data['linkedin'] ?? null,
                'website' => $data['website'] ?? null,
            ]
        );



        return $user;
    }
}
