<?php

namespace App\Http\Controllers\Public\Cookie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        return response()->noContent()
            ->withoutCookie('cookie_consent');
    }
}
