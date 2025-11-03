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

        $site_name = Setting::get('site_name');
        $site_description = Setting::get('site_description');
        $site_keywords = Setting::get('site_keywords');
        $site_favicon = Setting::get('site_favicon');
        $site_timezone = Setting::get('site_timezone');
        


        return view('admin.setting.site.edit', compact('site_name', 'site_description', 'site_keywords', 'site_favicon', 'site_timezone'));
    }
}
