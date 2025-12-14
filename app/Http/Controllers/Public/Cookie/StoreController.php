<?php

namespace App\Http\Controllers\Public\Cookie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return response()->noContent()
            ->cookie('cookie_consent', true, 525600); // 1 Year
    }
}
