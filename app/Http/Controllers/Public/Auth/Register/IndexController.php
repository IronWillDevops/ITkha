<?php

namespace App\Http\Controllers\Public\Auth\Register;

use Illuminate\Http\Request;

class IndexController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('public.auth.register.index');
    }
}
