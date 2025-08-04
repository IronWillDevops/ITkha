<?php

namespace App\Http\Controllers\Public\User;

use App\Http\Requests\Public\UserProfile\UpdatePasswordRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdatePasswordRequest $request)
    {

        $user = Auth::user();

        $this->service->updatePassword($user, $request->validated('password'));

        return redirect()->back()->with('success', __('profile.message.success.update_password'));
    }
}
