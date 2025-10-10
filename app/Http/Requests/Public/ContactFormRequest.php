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
            'name.required' => __('validation/contact.name.required'),
            'name.string' => __('validation/contact.name.string'),
            'name.max' => __('validation/contact.name.max'),

            'subject.required' => __('validation/contact.subject.required'),
            'subject.string' => __('validation/contact.subject.string'),
            'subject.max' => __('validation/contact.subject.max'),

            'email.required' => __('validation/contact.email.required'),
            'email.email' => __('validation/contact.email.email'),

            'message.required' => __('validation/contact.message.required'),
            'message.string' =>  __('validation/contact.message.string'),
            'message.min' =>  __('validation/contact.message.min'),
            'message.max' =>  __('validation/contact.message.max'),

            'captcha.required' => __('validation/contact.captcha.incorrect'),
        ];
    }
}
