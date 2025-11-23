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
        $telegramEnabled = (bool) Setting::get('telegram_enabled');
        $telegramSendWithoutSound =(bool)Setting::get('telegram_send_without_sound');
        $telegramTemplate = Setting::get('telegram_template');
        $telegramMessageLimit= Setting::get('telegram_message_limit');
        $telegramButtonText = Setting::get('telegram_button_text');
        return view('admin.setting.telegram.edit', compact('telegramEnabled','telegramSendWithoutSound','telegramTemplate','telegramMessageLimit','telegramButtonText'));
    }
}
