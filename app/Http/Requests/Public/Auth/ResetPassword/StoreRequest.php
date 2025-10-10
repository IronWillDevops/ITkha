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
            'token.required' => __('validation/reset.token.required'),

            'email.required' => __('validation/reset.email.required'),
            'email.string' => __('validation/reset.email.string'),
            'email.email' => __('validation/reset.email.email'),
            'email.max' => __('validation/reset.email.max'),

            'password.required' => __('validation/reset.password.required'),
            'password.string' => __('validation/reset.password.string'),
            'password.min' => __('validation/reset.password.min'),
            'password.max' => __('validation/reset.password.max'),
            'password.confirmed' => __('validation/reset.password.confirmed'),
        ];
    }
}
