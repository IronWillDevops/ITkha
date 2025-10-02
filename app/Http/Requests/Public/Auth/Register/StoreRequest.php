<?php

namespace App\Http\Requests\Public\Auth\Register;

use App\Rules\Public\CaptchaRule;
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
            'captcha' => ['required',  new CaptchaRule()],

        ];
    }

    public function messages(): array
    {
        return [

            'name.required' => __('public/validation.name.required'),
            'name.string' => __('public/validation.name.string'),
            'name.max' => __('public/validation.name.max'),

            'surname.string' => __('public/validation.surname.string'),
            'surname.max' => __('public/validation.surname.max'),

            'login.required' => __('public/validation.login.required'),
            'login.string' => __('public/validation.login.string'),
            'login.min' => __('public/validation.login.min'),
            'login.max' => __('public/validation.login.max'),
            'login.unique' => __('public/validation.login.unique'),

            'email.required' => __('public/validation.email.required'),
            'email.string' => __('public/validation.email.string'),
            'email.email' => __('public/validation.email.email'),
            'email.max' => __('public/validation.email.max'),
            'email.unique' => __('public/validation.email.unique'),
            
            'password.required' => __('public/validation.password.required'),
            'password.string' => __('public/validation.password.string'),
            'password.max' => __('public/validation.password.max'),
            'password.confirmed' => __('public/validation.password.confirmed'),

            // Повідомлення для правил Password::defaults()
            'password.min' => __('public/validation.password.min'),
            'password.letters' => __('public/validation.password.letters'),
            'password.mixed' => __('public/validation.password.mixed'),
            'password.numbers' => __('public/validation.password.numbers'),
            'password.symbols' => __('public/validation.password.symbols'),
            'password.uncompromised' => __('public/validation.password.uncompromised'),

            'captcha.required' => __('public/validation.captcha.required'),
        ];
    }
}
