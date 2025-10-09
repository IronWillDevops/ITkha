<?php

namespace App\Http\Requests\Admin\FooterLink;

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
            'icon.required' => __('validation/footerlink.icon.required'),
            'icon.string' => __('validation/footerlink.icon.string'),
            'icon.min' => __('validation/footerlink.icon.min'),
            'icon.max' => __('validation/footerlink.icon.max'),

            // title
            'title.required' => __('validation/footerlink.title.required'),
            'title.string' => __('validation/footerlink.title.string'),
            'title.min' => __('validation/footerlink.title.min'),
            'title.max' => __('validation/footerlink.title.max'),

            // url
            'url.required' => __('validation/footerlink.url.required'),
            'url.string' => __('validation/footerlink.url.string'),
            'url.min' => __('validation/footerlink.url.min'),
            'url.max' => __('validation/footerlink.url.max'),
            'url.url' => __('validation/footerlink.url.url'),
        ];
    }
}
