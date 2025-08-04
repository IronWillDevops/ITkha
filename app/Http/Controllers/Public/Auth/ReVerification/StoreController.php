<?php

namespace App\Http\Controllers\Public\Auth\ReVerification;


use App\Http\Requests\Public\Auth\ReVerification\StoreRequest;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Services\Public\Auth\ReVerificationService;
use Exception;

class StoreController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        try {

            $sent = $this->service->store($request->validated()['email']);

            if ($sent) {
                return redirect()->route('login')->with('success', __('message.success.link_sent'));
            } else {
                return redirect()->route('login')->with('success', __('message.success.link_generic'));
            }
        } catch (Exception $ex) {
            return redirect()->route('login')->with('error', __('message.error.unexpected_error'));
        }
    }
}
