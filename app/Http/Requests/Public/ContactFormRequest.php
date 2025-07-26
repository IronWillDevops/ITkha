<?php

namespace App\Http\Requests\Public;

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
            'captcha' => ['required', function ($attribute, $value, $fail) {
                if ($value !== session('captcha')) {
                    $fail(__('validation.captcha.incorrect'));
                }
            }],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.name.required'),
            'name.string' => __('validation.name.string'),
            'name.max' => __('validation.name.max'),

            'subject.required' => __('validation.subject.required'),
            'subject.string' => __('validation.subject.string'),
            'subject.max' => __('validation.subject.max'),

            'email.required' => __('validation.email.required'),
            'email.email' => __('validation.email.email'),

            'message.required' => __('validation.message.required'),
            'message.string' =>  __('validation.message.string'),
            'message.min' =>  __('validation.message.min'),
            'message.max' =>  __('validation.message.max'),

            'captcha.required' => __('validation.captcha.incorrect'),
        ];
    }
}
