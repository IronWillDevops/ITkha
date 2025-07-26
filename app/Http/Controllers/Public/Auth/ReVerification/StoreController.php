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
                return redirect()->route('login')->with('success', __('message.success.link_sent'));
            }


            return redirect()->route('login')->with('success', __('message.success.link_generic'));
        } catch (Exception $ex) {
            return redirect()->route('login')->with('error', __('message.error.unexpected_error'));
        }
    }
}
