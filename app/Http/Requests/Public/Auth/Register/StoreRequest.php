<?php

namespace App\Http\Requests\Public\Auth\Register;

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
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['string', 'max:255'],
            'login' => ['required', 'string', 'min:5', 'max:50', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'max:255', 'confirmed', Password::defaults()],
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

            'name.required' => __('validation.name.required'),
            'name.string' => __('validation.name.string'),
            'name.max' => __('validation.name.max'),

            'surname.string' => __('validation.surname.string'),
            'surname.max' => __('validation.surname.max'),

            'login.required' => __('validation.login.required'),
            'login.string' => __('validation.login.string'),
            'login.min' => __('validation.login.min'),
            'login.max' => __('validation.login.max'),
            'login.unique' => __('validation.login.unique'),

            'email.required' => __('validation.email.required'),
            'email.string' => __('validation.email.string'),
            'email.email' => __('validation.email.email'),
            'email.max' => __('validation.email.max'),
            'email.unique' => __('validation.email.unique'),
            
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

            'captcha.required' => __('validation.captcha.required'),
        ];
    }
}
