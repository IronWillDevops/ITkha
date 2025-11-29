<?php

namespace App\Http\Controllers\Admin\Users\User;

use App\Exceptions\User\CannotDeactivateLastActiveUserException;
use App\Http\Requests\Admin\Users\User\UpdateRequest;
use App\Models\User;


class UpdateController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, User $user)
    {


        try {
            $data = $request->validated();
            $user = $this->service->update($data, $user);

            return redirect()->route('admin.user.show', compact('user'))->with('success', __('admin/users.messages.edit', ['login' => $user->login]));
        } catch (CannotDeactivateLastActiveUserException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
