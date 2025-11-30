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
            'current_password.required' => __('validation.required'),
            'current_password.current_password' => __('validation.current_password'),


            'password.required' => __('validation.required'),
            'password.string' => __('validation.string'),
            'password.max' => __('validation.max.string'),
            'password.confirmed' => __('validation.confirmed'),
            'password.min' => __('validation.min.string'),

            // Повідомлення для правил Password::defaults()
            'password.letters' => __('validation.custom.password.letters'),
            'password.mixed' => __('validation.custom.password.mixed'),
            'password.numbers' => __('validation.custom.password.numbers'),
            'password.symbols' => __('validation.custom.password.symbols'),
            'password.uncompromised' => __('validation.custom.password.uncompromised'),

        ];
    }
}
