<?php

namespace App\Http\Requests\Admin\Users\Role;

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

            'title' => ['required', 'string', 'min:2', 'max:50', 'unique:roles,title'],
            
            'description' => ['nullable', 'string', 'max:255'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer', 'exists:permissions,id'],
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => __('validation.required'),
            'title.string' => __('validation.string'),
            'title.min' => __('validation.min.string'),
            'title.max' => __('validation.max.string'),
            'title.unique' => __('validation.unique'),

            'description.string' => __('validation.string'),
            'description.max' => __('validation.max.string'),

            'permissions.array'        => __('validation.array'),
            'permissions.*.integer'    => __('validation.integer'),
            'permissions.*.exists'     => __('validation.exists'),
        ];
    }
}
