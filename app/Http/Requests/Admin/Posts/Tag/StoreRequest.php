<?php

namespace App\Http\Requests\Admin\Posts\Tag;

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
            'title' => ['required', 'string', 'min:2', 'max:50', 'unique:tags,title'],
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => __('validation/tag.title.required'),
            'title.string' => __('validation/tag.title.string'),
            'title.min' => __('validation/tag.title.min'),
            'title.max' => __('validation/tag.title.max'),
            'title.unique' => __('validation/tag.title.unique'),
        ];
    }
}
