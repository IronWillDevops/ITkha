<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\StoreRequest;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class StoreController extends Controller
{

    public function __invoke(StoreRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.index'));
        }
        return back()->withErrors([
            'error' => 'Невірний email або пароль.',
        ])->onlyInput('email');
    }
}
