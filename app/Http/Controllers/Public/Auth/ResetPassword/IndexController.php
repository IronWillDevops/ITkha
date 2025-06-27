<?php

namespace App\Http\Controllers\Public\Auth\ResetPassword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
         return view('public.auth.resetpassword.index');
    }
}
