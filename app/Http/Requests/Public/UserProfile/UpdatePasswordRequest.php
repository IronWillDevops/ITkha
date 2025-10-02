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
            'current_password.required' => __('common/validation.current_password.required'),
            'current_password.current_password' => __('common/validation.current_password.current_password'),


            'password.required' => __('common/validation.password.required'),
            'password.string' => __('common/validation.password.string'),
            'password.max' => __('common/validation.password.max'),
            'password.confirmed' => __('common/validation.password.confirmed'),

            // Повідомлення для правил Password::defaults()
            'password.min' => __('common/validation.password.min'),
            'password.letters' => __('common/validation.password.letters'),
            'password.mixed' => __('common/validation.password.mixed'),
            'password.numbers' => __('common/validation.password.numbers'),
            'password.symbols' => __('common/validation.password.symbols'),
            'password.uncompromised' => __('common/validation.password.uncompromised'),

        ];
    }
}
