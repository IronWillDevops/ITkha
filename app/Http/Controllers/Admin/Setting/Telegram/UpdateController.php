<?php

namespace App\Http\Controllers\Admin\Setting\Telegram;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\Telegram\UpdateRequest;
use App\Models\Setting;
use Exception;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request)
    {
        try {
            $data = $request->validated();
            Setting::set('telegram_enabled', $data['telegram_enabled']);

            if ($data['telegram_token']) {
                Setting::set('telegram_token', $data['telegram_token']);
            }
            if ($data['telegram_chatid']) {
                Setting::set('telegram_chat_id', $data['telegram_chatid']);
            }

            if ($data['telegram_template']) {
                Setting::set('telegram_template', $data['telegram_template']);
            }

            if ($data['telegram_message_limit']) {
                Setting::set('telegram_message_limit', $data['telegram_message_limit']);
            }
            if ($data['telegram_button_text']) {
                Setting::set('telegram_button_text', $data['telegram_button_text']);
            }
            Setting::set(
                'telegram_send_without_sound',
                (int) ($data['telegram_send_without_sound'] ?? 0)
            );
            return redirect()->route('admin.setting.telegram.edit')->with('success', __('admin/common.messages.settings_saved'));
        } catch (Exception $ex) {
            
            logger()->error('Setting update failed', ['exception' => $ex]);
            return redirect()->back()->with('error', __('errors/setting.update.failed'));
        }
    }
}
