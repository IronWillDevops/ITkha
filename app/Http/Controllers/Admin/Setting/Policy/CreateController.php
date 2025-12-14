<?php

namespace App\Http\Controllers\Admin\Setting\Policy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('admin.setting.policy.create', [
            'locales' => config('app.available_locales')
        ]);
    }
}
