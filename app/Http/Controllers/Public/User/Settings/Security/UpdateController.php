<?php

namespace App\Http\Controllers\Public\User\Settings\Security;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\User\Settings\Security\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request,User $user)
    {
        try {
            $data = $request->validated();

            $user = Auth::user();

            $user->update([
                'password' => Hash::make($data['password']),
            ]);

            $request->session()->flash('success', __('public/user.messages.update_password_success'));
            Auth::logout();

            return redirect()->route('login');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', __('public/user.messages.unexpected_error'));
        }
    }
}
