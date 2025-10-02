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
            'token.required' => __('common/validation.token.required'),

            'email.required' => __('common/validation.email.required'),
            'email.string' => __('common/validation.email.string'),
            'email.email' => __('common/validation.email.email'),
            'email.max' => __('common/validation.email.max'),

            'password.required' => __('common/validation.password.required'),
            'password.string' => __('common/validation.password.string'),
            'password.min' => __('common/validation.password.min'),
            'password.max' => __('common/validation.password.max'),
            'password.confirmed' => __('common/validation.password.confirmed'),
        ];
    }
}
