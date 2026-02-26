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

            Setting::setMany([
                'telegram_enabled' => (bool) ($data['telegram_enabled'] ?? false),

                'telegram_token' => $data['telegram_token'] ?? null,
                'telegram_chat_id' => $data['telegram_chatid'] ?? null,
                'telegram_template' => $data['telegram_template'] ?? null,

                // ВАЖНО: сохраняем даже если 0
                'telegram_message_limit' => $data['telegram_message_limit'] ?? 0,

                'telegram_button_text' => $data['telegram_button_text'] ?? null,

                'telegram_send_without_sound' =>
                (int) ($data['telegram_send_without_sound'] ?? 0),
            ]);
            return redirect()->route('admin.setting.telegram.edit')->with('success', __('admin/common.messages.settings_saved'));
        } catch (Exception $ex) {

            logger()->error('Setting update failed', ['exception' => $ex]);
            return redirect()->back()->with('error', __('errors/setting.update.failed'));
        }
    }
}
