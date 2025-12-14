<?php

namespace App\Http\Controllers\Admin\Setting\Policy;

use App\Http\Controllers\Controller;
use App\Models\Policy;

class EditController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function __invoke(Policy $policy)
    {
        return view('admin.setting.policy.edit', [
            'policy' => $policy,
            'locales' => config('app.available_locales'),
        ]);
    }
}
