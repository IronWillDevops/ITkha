<?php

namespace App\Http\Requests\Admin\Category;

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
            'title' => ['required', 'string', 'min:2', 'max:50', 'unique:categories,title'],
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' =>__('validation/category.title.required'),
            'title.string' => __('validation/category.title.string'),
            'title.min' => __('validation/category.title.min'),
            'title.max' => __('validation/category.title.max'),
            'title.unique' => __('validation/category.title.unique'),
        ];
    }
}
