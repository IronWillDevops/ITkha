<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'login' => [
                'required',
                'string',
                'min:5',
                'max:50',
                Rule::unique('users')->ignore($this->user->id)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user->id),
            ],
            'surname' => ['string', 'max:255'],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => ['string', 'min:8', 'max:255'],

            'email_verified_at' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Ім’я є обов’язковим.',
            'name.string' => 'Ім’я повинно бути текстовим.',
            'name.max' => 'Ім’я не повинно перевищувати :max символів.',

            'surname.string' => 'Прізвище повинно бути текстовим.',
            'surname.max' => 'Прізвище не повинно перевищувати :max символів.',

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


            'password.string' => 'Пароль повинен бути текстовим.',
            'password.min' => 'Пароль повинен містити щонайменше :min символів.',
            'password.max' => 'Пароль повинен містити щонайбільше :max символів.',

            'role_id.required' => 'Роль є обов’язковим.',
            'role_id.exists' => 'Вибрана роль не існує або була видалена.',

            'email_verified_at.required' => 'Поле "Підтвердження" є обов’язковим.',
            'email_verified_at.boolean' => 'Поле "Підтвердження" повинно мати значення true або false.',

            'is_active.required' => 'Поле "Активність" є обов’язковим.',
            'is_active.boolean' => 'Поле "Активність" повинно мати значення true або false.',

        ];
    }
}
