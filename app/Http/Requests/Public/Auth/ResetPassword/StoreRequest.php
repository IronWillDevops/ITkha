<?php

namespace App\Http\Requests\Public\Auth\ResetPassword;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

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
            'email'    => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed', Password::defaults()],
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => __('validation.token.required'),

            'email.required' => __('validation.email.required'),
            'email.string' => __('validation.email.string'),
            'email.email' => __('validation.email.email'),
            'email.max' => __('validation.email.max'),

            'password.required' => __('validation.password.required'),
            'password.string' => __('validation.password.string'),
            'password.max' => __('validation.password.max'),
            'password.confirmed' => __('validation.password.confirmed'),
            'password.min' => __('validation.password.min'),
            'password.letters' => __('validation.password.letters'),
            'password.mixed' => __('validation.password.mixed'),
            'password.numbers' => __('validation.password.numbers'),
            'password.symbols' => __('validation.password.symbols'),
            'password.uncompromised' => __('validation.password.uncompromised'),
        ];
    }
}
