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
          $this->service->store($data); // Повертає створеного користувача




            return redirect()->route('public.auth.login.index')->with('success', 'User created successfully');
        } catch (Exception $ex) {
            return redirect()->route('public.auth.login.index')->with('error', 'An error occurred while creating the user. Please try again later.');
        }
    }
}
