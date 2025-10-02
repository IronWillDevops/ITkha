<?php

namespace App\Http\Requests\Public;

use App\Rules\Public\CaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50'],
            'subject' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string', 'min:10', 'max:1000'],
            'captcha' => ['required',  new CaptchaRule()],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('public/validation.name.required'),
            'name.string' => __('public/validation.name.string'),
            'name.max' => __('public/validation.name.max'),

            'subject.required' => __('public/validation.subject.required'),
            'subject.string' => __('public/validation.subject.string'),
            'subject.max' => __('public/validation.subject.max'),

            'email.required' => __('public/validation.email.required'),
            'email.email' => __('public/validation.email.email'),

            'message.required' => __('public/validation.message.required'),
            'message.string' =>  __('public/validation.message.string'),
            'message.min' =>  __('public/validation.message.min'),
            'message.max' =>  __('public/validation.message.max'),

            'captcha.required' => __('public/validation.captcha.incorrect'),
        ];
    }
}
