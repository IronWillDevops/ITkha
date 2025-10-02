<?php

namespace App\Http\Controllers\Public\Auth\Login;

use App\Exceptions\User\EmailNotVerifiedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Auth\Login\StoreRequest;
use App\Enums\UserStatus;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{


    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        try {

          
            $credentials = $request->validated();

            if (Auth::attempt($credentials, $request->boolean('remember'))) {
                $request->session()->regenerate();

                $user = Auth::user();

                //  Перевірка верифікації email
                if ($user->status == UserStatus::PENDING->value) {
                    Auth::logout();
                    throw new EmailNotVerifiedException();
                }

                // Перевірка статусу користувача
                if (!$user->status == UserStatus::ACTIVE->value) {
                    Auth::logout();
                    return back()->withErrors([
                        'error' => __('public/login.messages.account_inactive'),
                    ])->onlyInput('email');
                }
                return redirect()->intended(route('public.post.index'));
            }

            return back()->withErrors([
                'error' => __('public/login.messages.auth_failed'),
            ])->onlyInput('email');
        } catch (EmailNotVerifiedException $ex) {
            return redirect()->route('public.auth.reverification.index')->with('error', $ex->getMessage());
        }
    }
}
