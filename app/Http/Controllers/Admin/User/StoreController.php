<?php

namespace App\Http\Controllers\Admin\User;



use App\Http\Requests\Admin\User\StoreRequest;


class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);
        // Логіка збереження або обробки...
        return redirect()->route('admin.user.index')->with('toast', [
            'type' => 'success', // success | info | warning | danger
            'title' => 'Success',
            'message' => 'User successfully created.',
        ]);
    }
}
