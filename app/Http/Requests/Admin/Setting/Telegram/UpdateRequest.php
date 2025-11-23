<?php

namespace App\Http\Requests\Admin\Setting\Telegram;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'telegram_enabled' => ['nullable', 'boolean'],
            'telegram_token' => ['nullable', 'string'],
            'telegram_chatid' => ['nullable', 'string'],
            'telegram_send_without_sound' => ['nullable', 'boolean'],
            'telegram_template'=>['required','string'],
        ];
    }
    public function messages(): array
    {
        return [
            
            'telegram_enabled.boolean' => __('validation/setting.telegram.enabled.boolean'),
            'telegram_token.string' => __('validation/setting.telegram.token.string'),
            'telegram_chatid.string' => __('validation/setting.telegram.chatid.string'),
            'telegram_send_without_sound.boolean' => __('validation/setting.telegram.send_without_sound.boolean'),

            'telegram_template.reqired'=> __('validation/setting.telegram.telegram_template.reqired'),
            'telegram_template.string'=> __('validation/setting.telegram.telegram_template.string'),
        ];
    }
}
