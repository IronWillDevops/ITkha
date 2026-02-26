<?php

namespace App\Http\Controllers\Admin\Setting\Telegram;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class EditController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $settings = Setting::allSettings();
        return view('admin.setting.telegram.edit', compact('settings'));

    }
}
