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
            'name.required' => __('validation.required'),
            'name.string' => __('validation.string'),
            'name.max' => __('validation.max.string'),

            'subject.required' => __('validation.required'),
            'subject.string' => __('validation.string'),
            'subject.max' => __('validation.max.string'),

            'email.required' => __('validation.required'),
            'email.email' => __('validation.email'),

            'message.required' => __('validation.required'),
            'message.string' =>  __('validation.string'),
            'message.min' =>  __('validation.min.string'),
            'message.max' =>  __('validation.max.string'),

            'captcha.required' => __('validation.required'),
        ];
    }
}
