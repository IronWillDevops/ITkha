<?php

namespace App\Http\Controllers\Public\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\UserProfile\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdatePasswordRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
       
        $user->update([
            'password' => Hash::make($data['password']),
        ]);
        
        return redirect()->back()->with('success',__('profile.message.success.update_password'));
    }
}
