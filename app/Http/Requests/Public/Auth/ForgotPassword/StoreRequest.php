<?php

namespace App\Http\Requests\Public\Auth\ForgotPassword;

use App\Rules\Public\CaptchaRule;
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
            'captcha' => ['required', new CaptchaRule()],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('public/validation.email.required'),
            'email.string' => __('public/validation.email.string'),
            'email.email' => __('public/validation.email.email'),
            'email.max' => __('public/validation.email.max'),

            'captcha.required' => __('public/validation.captcha.required'),
        ];
    }
}
