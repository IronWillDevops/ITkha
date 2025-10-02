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
            'name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z]+$/'],
            'surname' => ['string', 'max:255', 'regex:/^[A-Za-z]+$/'],
            'login' => ['required', 'string', 'min:5', 'max:50', 'unique:users', 'regex:/^[A-Za-z0-9_]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'max:255', 'confirmed', Password::defaults()],
            'captcha' => ['required',  new CaptchaRule()],

        ];
    }

    public function messages(): array
    {
        return [

            'name.required' => __('common/validation.name.required'),
            'name.string' => __('common/validation.name.string'),
            'name.max' => __('common/validation.name.max'),
            'name.regex' => __('common/validation.name.regex'),

            'surname.string' => __('common/validation.surname.string'),
            'surname.max' => __('common/validation.surname.max'),
            'surname.regex' => __('common/validation.surname.regex'),

            'login.required' => __('common/validation.login.required'),
            'login.string' => __('common/validation.login.string'),
            'login.min' => __('common/validation.login.min'),
            'login.max' => __('common/validation.login.max'),
            'login.unique' => __('common/validation.login.unique'),
            'login.regex' =>  __('common/validation.login.regex'),

            'email.required' => __('common/validation.email.required'),
            'email.string' => __('common/validation.email.string'),
            'email.email' => __('common/validation.email.email'),
            'email.max' => __('common/validation.email.max'),
            'email.unique' => __('common/validation.email.unique'),

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

            'captcha.required' => __('common/validation.captcha.required'),
        ];
    }
}
