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
            'name.required' => __('common/validation.name.required'),
            'name.string' => __('common/validation.name.string'),
            'name.max' => __('common/validation.name.max'),

            'subject.required' => __('common/validation.subject.required'),
            'subject.string' => __('common/validation.subject.string'),
            'subject.max' => __('common/validation.subject.max'),

            'email.required' => __('common/validation.email.required'),
            'email.email' => __('common/validation.email.email'),

            'message.required' => __('common/validation.message.required'),
            'message.string' =>  __('common/validation.message.string'),
            'message.min' =>  __('common/validation.message.min'),
            'message.max' =>  __('common/validation.message.max'),

            'captcha.required' => __('common/validation.captcha.incorrect'),
        ];
    }
}
