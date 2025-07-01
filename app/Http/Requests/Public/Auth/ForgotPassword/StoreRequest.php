<?php

namespace App\Http\Requests\Public\Auth\ForgotPassword;

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
            'email' => ['required', 'string', 'email', 'max:255'],
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
            'email.required' => 'Email є обов’язковим.',
            'email.string' => 'Email повинен бути текстовим.',
            'email.email' => 'Email повинен бути дійсною адресою.',
            'email.max' => 'Email не повинен перевищувати :max символів.',

            'captcha.required' => 'Введіть капчу.',
        ];
    }
}
