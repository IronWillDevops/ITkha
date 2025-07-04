<?php

namespace App\Http\Controllers\Admin\User;

use App\Exceptions\User\CannotDeactivateLastActiveUserException;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;

class UpdateController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, User $user)
    {
      #  try {
            $data = $request->validated();
            
            $user = $this->service->update($data, $user);
            
            return redirect()->route('admin.user.show', compact('user'))->with('toast', [
                'type' => 'success', // success | info | warning | danger
                'title' => 'Success',
                'message' => 'User successfully updated.',
            ]);; // Можно заменить на вашу главную страницу
        // } catch (CannotDeactivateLastActiveUserException $ex) {
        //     return redirect()->back()->with('toast', [
        //         'type' => 'danger', // success | info | warning | danger
        //         'title' => 'Danger',
        //         'message' => $ex->getMessage(),
        //     ]);
        // }
    }
}
