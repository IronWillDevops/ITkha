<?php

namespace App\Http\Controllers\Admin\Users\User;

use App\Http\Requests\Admin\Users\User\StoreRequest;
use Exception;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {

        $data = $request->validated();

        $this->service->store($data);
        // Логіка збереження або обробки...
        return redirect()->route('admin.user.index')->with('success', __('admin/user.messages.created', ['login' => $data['login']]));
    }
}
