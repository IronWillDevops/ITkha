<?php

namespace App\Http\Requests\Public\UserProfile;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
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
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'max:255', 'confirmed', Password::defaults()],
        ];
    }
    public function messages(): array
    {
        return [
            'current_password.required' => __('public/validation.current_password.required'),
            'current_password.current_password' => __('public/validation.current_password.current_password'),


            'password.required' => __('public/validation.password.required'),
            'password.string' => __('public/validation.password.string'),
            'password.max' => __('public/validation.password.max'),
            'password.confirmed' => __('public/validation.password.confirmed'),

            // Повідомлення для правил Password::defaults()
            'password.min' => __('public/validation.password.min'),
            'password.letters' => __('public/validation.password.letters'),
            'password.mixed' => __('public/validation.password.mixed'),
            'password.numbers' => __('public/validation.password.numbers'),
            'password.symbols' => __('public/validation.password.symbols'),
            'password.uncompromised' => __('public/validation.password.uncompromised'),

        ];
    }
}
