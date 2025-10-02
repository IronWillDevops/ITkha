<?php

namespace App\Http\Controllers\Public\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\UserProfile\UpdatePasswordRequest;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdatePasswordRequest $request)
    {
        try {
            $data = $request->validated();
            $user = Auth::user();

            $user->update([
                'password' => Hash::make($data['password']),
            ]);

            return redirect()->back()->with('success', __('public/profile.messages.update_password_success'));
        } catch (Exception $ex) {
            return redirect()->back()->with('error', __('public/profile.messages.unexpected_error'));
        }
    }
}
