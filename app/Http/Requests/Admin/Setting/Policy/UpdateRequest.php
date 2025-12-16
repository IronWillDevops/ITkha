<?php

namespace App\Http\Requests\Admin\Setting\Policy;

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
            'is_active' => 'nullable|boolean',
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.content' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'translations.*.title.required' => __('The title is required for all languages.'),
            'translations.*.content.required' => __('The content is required for all languages.'),
        ];
    }
}
