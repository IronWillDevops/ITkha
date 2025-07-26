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
            'current_password.required' => __('validation.current_password.required'),
            'current_password.current_password' => __('validation.current_password.current_password'),


            'password.required' => __('validation.password.required'),
            'password.string' => __('validation.password.string'),
            'password.max' => __('validation.password.max'),
            'password.confirmed' => __('validation.password.confirmed'),

            // Повідомлення для правил Password::defaults()
            'password.min' => __('validation.password.min'),
            'password.letters' => __('validation.password.letters'),
            'password.mixed' => __('validation.password.mixed'),
            'password.numbers' => __('validation.password.numbers'),
            'password.symbols' => __('validation.password.symbols'),
            'password.uncompromised' => __('validation.password.uncompromised'),

        ];
    }
}
