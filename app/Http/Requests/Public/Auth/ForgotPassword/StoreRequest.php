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
                    $fail(__('validation.captcha_incorrect'));
                }
            }],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('validation.email_required'),
            'email.string' => __('validation.email_string'),
            'email.email' => __('validation.email_email'),
            'email.max' => __('validation.email_max'),

            'captcha.required' => __('validation.captcha_required'),
        ];
    }
}
