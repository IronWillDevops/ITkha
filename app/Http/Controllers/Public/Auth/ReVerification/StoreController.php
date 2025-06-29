<?php

namespace App\Http\Controllers\Public\Auth\ReVerification;


use App\Http\Requests\Public\Auth\ReVerification\StoreRequest;

use App\Http\Controllers\Controller;

use App\Models\User;
use Exception;

class StoreController extends Controller
{

    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        try {
            $data = $request->validated();

            $user = User::where('email', $data['email'])->first();

            if ($user && !$user->hasVerifiedEmail()) {
                $user->sendEmailVerificationNotification();
                return redirect()->route('login')->with('success', 'If the account exists, we have sent you a verification link. Please check your email to confirm your account.');
            }


            return redirect()->route('login')->with('success', 'If the email exists, a verification link has been sent. Please check your inbox. If you do not receive it, ensure your email is correct.');
        } catch (Exception $ex) {
            return redirect()->route('login')->with('error', 'An error occurred while creating the user. Please try again later.');
        }
    }
}
