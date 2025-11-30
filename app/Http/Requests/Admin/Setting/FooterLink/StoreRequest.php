<?php

namespace App\Http\Requests\Admin\Setting\FooterLink;

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
            'icon' => ['required', 'string', 'min:2', 'max:50'],
            'title' => ['required', 'string', 'min:2', 'max:50'],
            'url' => ['required', 'string', 'min:2', 'max:100', 'url'],

        ];
    }
    public function messages(): array
    {
        return [
            // icon
            'icon.required' => __('validation.required'),
            'icon.string' => __('validation.string'),
            'icon.min' => __('validation.min.string'),
            'icon.max' => __('validation.max.string'),

            // title
            'title.required' => __('validation.required'),
            'title.string' => __('validation.string'),
            'title.min' => __('validation.min.string'),
            'title.max' => __('validation.max.string'),

            // url
            'url.required' => __('validation.required'),
            'url.string' => __('validation.string'),
            'url.min' => __('validation.min.string'),
            'url.max' => __('validation.max.string'),
            'url.url' => __('validation.url'),
        ];
    }
}
