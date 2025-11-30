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

            'name.required' => __('validation.required'),
            'name.string' => __('validation.string'),
            'name.max' => __('validation.max.string'),
            'name.regex' => __('validation.regex'),

            'surname.string' => __('validation.string'),
            'surname.max' => __('validation.max.string'),
            'surname.regex' => __('validation.regex'),

            'login.required' => __('validation.required'),
            'login.string' => __('validation.string'),
            'login.min' => __('validation.min.string'),
            'login.max' => __('validation.max.string'),
            'login.unique' => __('validation.unique'),
            'login.regex' =>  __('validation.regex'),

            'email.required' => __('validation.required'),
            'email.string' => __('validation.string'),
            'email.email' => __('validation.email'),
            'email.max' => __('validation.max.string'),
            'email.unique' => __('validation.unique'),

            'password.required' => __('validation.required'),
            'password.string' => __('validation.string'),
            'password.max' => __('validation.max.string'),
            'password.min' => __('validation.min.string'),
            'password.confirmed' => __('validation.confirmed'),

            // Повідомлення для правил Password::defaults()
            'password.letters' => __('validation.custom.password.letters'),
            'password.mixed' => __('validation.custom.password.mixed'),
            'password.numbers' => __('validation.custom.password.numbers'),
            'password.symbols' => __('validation.custom.password.symbols'),
            'password.uncompromised' => __('validation.custom.password.uncompromised'),

            'captcha.required' => __('validation.required'),
        ];
    }
}
