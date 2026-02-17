<?php

namespace App\Http\Requests\Admin\Setting\Backup;

use Illuminate\Foundation\Http\FormRequest;

class RestoreRequest extends FormRequest
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
            'filename' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'filename.required' => __('validation.required'),
            'filename.string' => __('validation.string'),
        ];
    }
}
