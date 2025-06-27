<?php

namespace App\Http\Controllers\Public\Auth\Register;


use App\Http\Requests\Public\Auth\Register\StoreRequest;
use App\Services\MailService;
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
            $user = $this->service->store($data);



            return redirect()->route('login')->with('success', 'User created successfully');
        } catch (Exception $ex) {
            return redirect()->route('login')->with('error', 'An error occurred while creating the user. Please try again later.');
        }
    }
}
