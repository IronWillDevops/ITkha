<?php

namespace App\Http\Requests\Admin\Setting\Backup;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
            'filename' => ['required', 'file', 'mimes:zip', 'max:512000'],
        ];
    }

    public function messages(): array
    {
        return [
            'filename.required' => __('validation.required'),
            'filename.file' => __('validation.file'),
            'filename.mimes' => __('validation.mimes'),
            'filename.max' => __('validation.max.file'),
        ];
    }
}
