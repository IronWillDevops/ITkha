<?php

namespace App\Http\Requests\Admin\Setting\User;

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
            'user_default_status' =>  ['nullable', 'string'],
            'user_default_role' => ['nullable', 'string'],
            'user_require_email_verification' => ['nullable', 'boolean'],
        ];
    }
}
