<?php

namespace App\Http\Controllers\Public\Auth\ResetPassword;

use App\Http\Requests\Public\Auth\ResetPassword\StoreRequest;
use Illuminate\Support\Facades\Password;


class StoreController extends BaseController
{
    

    public function __invoke(StoreRequest $request)
    {
        $status = $this->service->store($request->validated());

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', __('message.success.reset'));
        } else {
            return redirect()->route('login')->with('error',  __('message.error.reset'));
        }
    }
}
