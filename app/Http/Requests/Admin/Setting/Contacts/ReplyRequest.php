<?php

namespace App\Http\Requests\Admin\Setting\Contacts;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
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
            'message'=>['required', 'string', 'min:20'],
        ];
    }
    
    public function messages(): array
    {
        return [
            'message.required' => __('validation/setting.contacts.message.required'),
            'message.string' => __('validation/setting.contacts.message.string'),
            'message.min' => __('validation/setting.contacts.message.min'),
        ];
    }
}
