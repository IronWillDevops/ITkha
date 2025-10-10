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

            'name.required' => __('validation/register.name.required'),
            'name.string' => __('validation/register.name.string'),
            'name.max' => __('validation/register.name.max'),
            'name.regex' => __('validation/register.name.regex'),

            'surname.string' => __('validation/register.surname.string'),
            'surname.max' => __('validation/register.surname.max'),
            'surname.regex' => __('validation/register.surname.regex'),

            'login.required' => __('validation/register.login.required'),
            'login.string' => __('validation/register.login.string'),
            'login.min' => __('validation/register.login.min'),
            'login.max' => __('validation/register.login.max'),
            'login.unique' => __('validation/register.login.unique'),
            'login.regex' =>  __('validation/register.login.regex'),

            'email.required' => __('validation/register.email.required'),
            'email.string' => __('validation/register.email.string'),
            'email.email' => __('validation/register.email.email'),
            'email.max' => __('validation/register.email.max'),
            'email.unique' => __('validation/register.email.unique'),

            'password.required' => __('validation/register.password.required'),
            'password.string' => __('validation/register.password.string'),
            'password.max' => __('validation/register.password.max'),
            'password.confirmed' => __('validation/register.password.confirmed'),

            // Повідомлення для правил Password::defaults()
            'password.min' => __('validation/register.password.min'),
            'password.letters' => __('validation/register.password.letters'),
            'password.mixed' => __('validation/register.password.mixed'),
            'password.numbers' => __('validation/register.password.numbers'),
            'password.symbols' => __('validation/register.password.symbols'),
            'password.uncompromised' => __('validation/register.password.uncompromised'),

            'captcha.required' => __('validation/register.captcha.required'),
        ];
    }
}
