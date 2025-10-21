<?php

namespace App\Http\Controllers\Public\Auth\Register;


use App\Http\Requests\Public\Auth\Register\StoreRequest;
use Exception;

class StoreController extends BaseController
{

    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        try {

            $data = $request->validated();

            $this->service->store($data);

            
            return redirect()->route('login')->with('success',  __('public/register.messages.register'));
        } catch (Exception $ex) {
            return redirect()->route('login')->with('error', __('public/register.messages.register_failed'));
        }
    }
}
