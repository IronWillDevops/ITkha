<?php

namespace App\Http\Controllers\Public\Cookie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $consent = $request->cookie('cookie_consent', false);
        return view('public.cookie.banner', compact('consent'));
    }
}
