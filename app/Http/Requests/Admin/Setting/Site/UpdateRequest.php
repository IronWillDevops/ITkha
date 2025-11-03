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
            'site_favicon' => ['nullable', 'image', 'mimes:png,ico,jpg', 'max:2048'],
        ];
    }
    public function messages(): array
    {
        return [
            'site_name.required' => __('validation/setting.site.name.required'),
            'site_name.string' => __('validation/setting.site.name.string'),
            'site_name.max' => __('validation/setting.site.name.max'),

            'site_description.string' => __('validation/setting.site.description.string'),
            'site_description.max' => __('validation/setting.site.description.max'),

            'site_keywords.string' => __('validation/setting.site.keywords.string'),
            'site_keywords.max' => __('validation/setting.site.keywords.max'),

            'site_favicon.image' => __('validation/setting.site.favicon.image'),
            'site_favicon.mimes' => __('validation/setting.site.favicon.mimes'),
            'site_favicon.max' => __('validation/setting.site.favicon.max'),

         
        ];
    }
}
