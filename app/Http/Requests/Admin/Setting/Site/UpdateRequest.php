<?php

namespace App\Http\Requests\Admin\Setting\Site;

use DateTimeZone;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'site_name' => ['required', 'string', 'max:255'],
            'site_description' => ['nullable', 'string', 'max:1000'],
            'site_keywords' => ['nullable', 'string', 'max:500'],
            'site_favicon' => ['nullable',  'mimes:ico', 'max:2048'],
            'site_email' => ['nullable', 'email', 'max:255'],
            'site_phone' => ['nullable', 'string', 'max:50'],
            'site_address' => ['nullable', 'string', 'max:255'],
        ];
    }
    public function messages(): array
    {
        return [
            'site_name.required' => __('validation.required'),
            'site_name.string' => __('validation.string'),
            'site_name.max' => __('validation.max.string'),

            'site_description.string' => __('validation.string'),
            'site_description.max' => __('validation.max.string'),

            'site_keywords.string' => __('validation.string'),
            'site_keywords.max' => __('validation.max.string'),

            'site_favicon.mimes' => __('validation.mimes'),
            'site_favicon.max' => __('validation.max.string'),

            'site_email.email' => __('validation.email'),
            'site_email.max' => __('validation.max.string'),

            'site_phone.string' => __('validation.string'),
            'site_phone.max' => __('validation.max.string'),

            'site_address.string' => __('validation.string'),
            'site_address.max' => __('validation.max.string'),


        ];
    }
}
