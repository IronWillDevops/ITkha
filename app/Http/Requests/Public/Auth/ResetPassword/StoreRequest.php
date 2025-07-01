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
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => 'Токен скидання пароля є обов’язковим.',

            'email.required' => 'Email є обов’язковим.',
            'email.string' => 'Email повинен бути текстовим.',
            'email.email' => 'Email повинен бути дійсною адресою.',

            'password.required' => 'Пароль є обов’язковим.',
            'password.string' => 'Пароль повинен бути текстовим.',
            'password.min' => 'Пароль повинен містити щонайменше :min символів.',
            'password.max' => 'Пароль повинен містити щонайбільше :max символів.',
            'password.confirmed' => 'Паролі не співпадають.',
        ];
    }
}
