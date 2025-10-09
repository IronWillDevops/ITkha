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
            'current_password.required' => __('validation/passwordupdate.current_password.required'),
            'current_password.current_password' => __('validation/passwordupdate.current_password.current_password'),


            'password.required' => __('validation/passwordupdate.password.required'),
            'password.string' => __('validation/passwordupdate.password.string'),
            'password.max' => __('validation/passwordupdate.password.max'),
            'password.confirmed' => __('validation/passwordupdate.password.confirmed'),

            // Повідомлення для правил Password::defaults()
            'password.min' => __('validation/passwordupdate.password.min'),
            'password.letters' => __('validation/passwordupdate.password.letters'),
            'password.mixed' => __('validation/passwordupdate.password.mixed'),
            'password.numbers' => __('validation/passwordupdate.password.numbers'),
            'password.symbols' => __('validation/passwordupdate.password.symbols'),
            'password.uncompromised' => __('validation/passwordupdate.password.uncompromised'),

        ];
    }
}
