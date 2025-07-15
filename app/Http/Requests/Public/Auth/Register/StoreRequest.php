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

            'name.required' => __('validation.name_required'),
            'name.string' => __('validation.name_string'),
            'name.max' => __('validation.name_max'),

            'surname.string' => __('validation.surname_string'),
            'surname.max' => __('validation.surname_max'),

            'login.required' => __('validation.login_required'),
            'login.string' => __('validation.login_string'),
            'login.min' => __('validation.login_min'),
            'login.max' => __('validation.login_max'),
            'login.unique' => __('validation.login_unique'),

            'email.required' => __('validation.email_required'),
            'email.string' => __('validation.email_string'),
            'email.email' => __('validation.email_email'),
            'email.max' => __('validation.email_max'),
            'email.unique' => __('validation.email_unique'),

            'password.required' => __('validation.password_required'),
            'password.string' => __('validation.password_string'),
            'password.min' => __('validation.password_min'),
            'password.max' => __('validation.password_max'),
            'password.confirmed' => __('validation.password_confirmed'),

            'captcha.required' => __('validation.captcha_required'),
        ];
    }
}
