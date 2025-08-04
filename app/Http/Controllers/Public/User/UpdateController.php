<?php

namespace App\Http\Controllers\Public\User;

use App\Http\Requests\Public\UserProfile\UpdateRequest;
use App\Models\User;

class UpdateController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, User $user)
    {
        $this->service->update($user, $request->validated());

        return redirect()->back()->with('success', __('profile.message.success.update_profile'));
    }
}
