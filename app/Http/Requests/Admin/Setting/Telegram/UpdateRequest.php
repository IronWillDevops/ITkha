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
            'telegram_template' => ['required', 'string', 'max:1000'],
            'telegram_message_limit' =>['required','integer','max:750'],
            'telegram_button_text'=>['required', 'string','max:100'],
        ];
    }
    public function messages(): array
    {
        return [

            'telegram_enabled.boolean' => __('validation.boolean'),
            'telegram_token.string' => __('validation.string'),
            'telegram_chatid.string' => __('validation.string'),
            'telegram_send_without_sound.boolean' => __('validation.boolean'),

            'telegram_template.required' => __('validation.required'),
            'telegram_template.string' => __('validation.string'),
            'telegram_template.max' => __('validation.max.string'),

            
            'telegram_message_limit.required' => __('validation.required'),
            'telegram_message_limit.integer' => __('validation.integer'),
            'telegram_message_limit.max' => __('validation.max.string'),
            
            'telegram_button_text.required' => __('validation.required'),
            'telegram_button_text.string' => __('validation.string'),
            'telegram_button_text.max' => __('validation.max.string'),
        ];
    }
}
