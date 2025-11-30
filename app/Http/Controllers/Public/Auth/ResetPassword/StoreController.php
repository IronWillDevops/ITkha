<?php

namespace App\Http\Controllers\Public\Auth\ResetPassword;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Auth\ResetPassword\StoreRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $status = Password::reset(
            $data,
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', __('public/auth/reset.messages.reset'));
        } else {
            return redirect()->route('login')->with('error',   __('public/auth/reset.messages.reset_failed'));
        }
    }
}
