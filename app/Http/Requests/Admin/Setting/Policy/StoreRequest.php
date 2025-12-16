<?php

namespace App\Http\Requests\Admin\Setting\Policy;

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
            'key' => ['required', 'string', 'unique:policies,key'],
            'is_active' => ['nullable', 'boolean'],
            'translations' => ['required', 'array'],
            'translations.*.locale' => ['required', 'string'],
            'translations.*.title' => ['required', 'string', 'max:255'],
            'translations.*.content' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'key.required' => __('validation.required'),
            'key.unique' => __('validation.unique'),

            'is_active.boolean' => __('validation.boolean'),

            'translations.required' => __('validation.required'),
            'translations.array' => __('validation.array'),

            'translations.*.locale.required' => __('validation.required'),
            'translations.*.locale.string' => __('validation.string'),


            'translations.*.title.required' => __('validation.required'),
            'translations.*.title.string' => __('validation.string'),
            'translations.*.title.max' => __('validation.max.string'),

            'translations.*.content.required' => __('validation.required'),
            'translations.*.content.string' => __('validation.string'),
        ];
    }
}
