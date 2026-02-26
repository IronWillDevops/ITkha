<?php

namespace App\Http\Controllers\Admin\Setting\Site;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use DateTimeZone;
use Illuminate\Http\Request;

class EditController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $setting = Setting::allSettings();
        return view('admin.setting.site.edit', compact('setting'));
        
    }
}
