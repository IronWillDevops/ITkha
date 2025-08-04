<?php

namespace  App\Services\Public\Auth;
use App\Models\User;

class ReVerificationService 
{
    public function store(string $email): bool
    {
        $user = User::where('email', $email)->first();

        if ($user && !$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            return true;
        }

        return false;
    }
}
