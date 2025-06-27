<?php

namespace App\Http\Controllers\Public\Auth\Login;

use App\Exceptions\User\EmailNotVerifiedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Auth\Login\StoreRequest;
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

                if (!$user->hasVerifiedEmail()) {
                    Auth::logout();
                    throw new EmailNotVerifiedException();
                }
                return redirect()->intended(route('public.post.index'));
            }


            return back()->withErrors([
                'error' => 'Невірний email або пароль.',
            ])->onlyInput('email');
        } catch (EmailNotVerifiedException $ex) {


            return redirect()->route('login')->with('error', $ex->getMessage());
        }
    }
}
