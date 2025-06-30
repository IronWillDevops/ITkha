<?php

namespace App\Http\Controllers\Public\Auth\ForgotPassword;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Auth\ForgotPassword\StoreRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        try {
            $data = $request->validated();

            Password::sendResetLink(
                $request->only('email')
            );

            return redirect()->route('login')->with(
                'success','If the account exists, we have sent you a password reset link. Please check your email.');
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }
}
