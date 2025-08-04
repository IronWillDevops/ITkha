<?php

namespace  App\Services\Public\Auth;

use App\Enums\UserStatus;
use App\Models\User;

use Illuminate\Auth\Events\Verified;

class VerifyService
{
    public function store(int $userId, string $hash)
    {
        $user = User::findOrFail($userId);
        $isVerified = false;
        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, __('message.error.invalid_or_expired_link'));
        }
        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            if ($user->status !== UserStatus::ACTIVE->value) {
                $user->status = UserStatus::ACTIVE->value;
                $user->save();
            }

            event(new Verified($user));

            $isVerified = true; // тимчасова властивість для контролера
        }

        return $isVerified;
    }
}
