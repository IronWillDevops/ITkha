<?php

namespace App\Http\Controllers\Admin\Users\User;

use App\Http\Requests\Admin\User\StoreRequest;


class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);
        // Логіка збереження або обробки...
        return redirect()->route('admin.user.index')->with('success', __('admin/users.messages.create', ['login' => $data['login']]));
    }
}
