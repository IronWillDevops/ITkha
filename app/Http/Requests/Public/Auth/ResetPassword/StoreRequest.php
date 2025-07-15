<?php

namespace App\Http\Requests\Public\Auth\ResetPassword;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'token'    => ['required'],
            'email'    => ['required', 'string', 'email','max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => __('validation.token_required'),

            'email.required' => __('validation.email_required'),
            'email.string' => __('validation.email_string'),
            'email.email' => __('validation.email_email'),
            'email.max' => __('validation.email_max'),

            'password.required' => __('validation.password_required'),
            'password.string' => __('validation.password_string'),
            'password.min' => __('validation.password_min'),
            'password.max' => __('validation.password_max'),
            'password.confirmed' => __('validation.password_confirmed'),
        ];
    }
}
