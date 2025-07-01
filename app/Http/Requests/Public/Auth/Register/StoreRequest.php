<?php

namespace App\Http\Requests\Public\Auth\Register;

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
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['string', 'max:255'],
            'login' => ['required', 'string', 'min:5', 'max:50', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            'captcha' => ['required', function ($attribute, $value, $fail) {
                if ($value !== session('captcha')) {
                    $fail('Невірна капча.');
                }
            }],

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ім’я є обов’язковим.',
            'name.string' => 'Ім’я повинно бути текстовим.',
            'name.max' => 'Ім’я не повинно перевищувати :max символів.',

            'surname.string' => 'Ім’я повинно бути текстовим.',
            'surname.max' => 'Ім’я не повинно перевищувати :max символів.',

            'login.required' => 'Login є обов’язковим.',
            'login.string' => 'Login повинен бути текстовим.',
            'login.min' => 'Login повинен містити щонайменше :min символів.',
            'login.max' => 'Login повинен містити щонайбільше :max символів.',
            'login.unique' => 'Користувач з таким login вже існує.',

            'email.required' => 'Email є обов’язковим.',
            'email.string' => 'Email повинен бути текстовим.',
            'email.email' => 'Email повинен бути дійсною адресою.',
            'email.max' => 'Email не повинен перевищувати :max символів.',
            'email.unique' => 'Користувач з таким email вже існує.',

            'password.required' => 'Пароль є обов’язковим.',
            'password.string' => 'Пароль повинен бути текстовим.',
            'password.min' => 'Пароль повинен містити щонайменше :min символів.',
            'password.max' => 'Пароль повинен містити щонайбільше :max символів.',
            'password.confirmed' => 'Паролі не співпадають.',

            'captcha.required' => 'Введіть капчу.',
        ];
    }
}
