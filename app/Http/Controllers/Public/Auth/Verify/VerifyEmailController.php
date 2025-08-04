<?php

namespace App\Http\Controllers\Public\Auth\Verify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\Models\User;
use App\Enums\UserStatus;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        // Проверка подписи email
        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, __('message.error.invalid_or_expired_link'));
        }

        if ($user->hasVerifiedEmail()) {

            return redirect()->route('login')->with('success', __('message.success.email_already_verified'));
        }
        if ($user->status !== UserStatus::ACTIVE->value) {
            $user->status = UserStatus::ACTIVE->value;
            $user->save();
        }
        $user->markEmailAsVerified();
        event(new Verified($user));

        return redirect()->route('login')->with('success', __('message.success.email_verified_success'));
    }
}
