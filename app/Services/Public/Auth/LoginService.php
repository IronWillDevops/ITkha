<?php

namespace  App\Services\Public\Auth;

use Illuminate\Support\Facades\Auth;
use App\Enums\UserStatus;
use App\Exceptions\User\AccountInactiveException;
use App\Exceptions\User\AuthFailedException;
use App\Exceptions\User\EmailNotVerifiedException;

class LoginService 
{
    public function login(array $credentials, bool $remember): void
    {
        if (!Auth::attempt($credentials, $remember)) {

            throw new AuthFailedException(__('message.error.auth_failed'));
        }

        request()->session()->regenerate();

        $user = Auth::user();

        $this->checkEmailVerification($user);
        $this->checkUserStatus($user);
    }

    public function logout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    /**
     * Перевірка чи підтверджено email
     */
    protected function checkEmailVerification($user): void
    {
        if ($user->status === UserStatus::PENDING->value) {
            $this->logout();
            throw new EmailNotVerifiedException();
        }
    }

    /**
     * Перевірка активності користувача
     */
    protected function checkUserStatus($user): void
    {
        if ($user->status !== UserStatus::ACTIVE->value) {
            $this->logout();
            throw new AccountInactiveException();
        }
    }
}
