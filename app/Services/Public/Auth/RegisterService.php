<?php

namespace  App\Services\Public\Auth;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterService 
{
    public function store($data)
    {
        $data['password'] = Hash::make($data['password']);

        $user = User::firstOrCreate(['email' => $data['email']], $data);

        // Знайти роль за назвою
        $role = Role::where('title', 'user')->first(); // або 'користувач'

        // Присвоїти роль користувачу
        if ($role) {
            $user->roles()->syncWithoutDetaching([$role->id]);
        }
        return $user;
    }
}
