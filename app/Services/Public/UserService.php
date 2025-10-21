<?php

namespace App\Services\Public;

use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function store($data)
    {

        // $data['password'] = Hash::make($data['password']);

        // $user = User::firstOrCreate(['email' => $data['email']], $data);

        // // Знайти роль за назвою
        // $role = Role::where('title', 'user')->first(); // або 'користувач'

        // // Присвоїти роль користувачу
        // if ($role) {
        //     $user->roles()->syncWithoutDetaching([$role->id]);
        // } 

        // // Отправляем письмо для подтверждения email
        // $user->sendEmailVerificationNotification();

        $settings = Setting::whereIn('key', [
            'user_default_status',
            'user_default_role',
            'user_require_email_verification',
        ])->pluck('value', 'key');
        //  Застосовуємо значення за замовчуванням, якщо не передані у $data
        $data['status'] = $data['status'] ?? $settings['user_default_status'] ?? 'active';
        $data['role'] = $data['role'] ?? $settings['user_default_role'] ?? '3';

        //  Хешуємо пароль
        $data['password'] = Hash::make($data['password']);

        //  Створюємо або отримуємо користувача
        $user = User::firstOrCreate(['email' => $data['email']], $data);

        // //  Присвоюємо роль користувачу
        $user->roles()->syncWithoutDetaching([$data['role']]);

        //  Якщо активна вимога підтвердження email — відправляємо лист

        if ((bool)$settings['user_require_email_verification'] === true) {
            $user->sendEmailVerificationNotification();
        } else {
            $user->forceFill(['email_verified_at' => now()])->save();
        }
    }
}
