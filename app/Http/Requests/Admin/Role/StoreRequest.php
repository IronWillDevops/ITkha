<?php

namespace App\Http\Requests\Admin\Role;

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
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer', 'exists:permissions,id'],
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => __('validation/role.title.required'),
            'title.string' => __('validation/role.title.string'),
            'title.min' => __('validation/role.title.min'),
            'title.max' => __('validation/role.title.max'),
            'title.unique' => __('validation/role.title.unique'),

            'permissions.array'        => __('validation/role.permissions.array'),
            'permissions.*.integer'    => __('validation/role.permissions.*.integer'),
            'permissions.*.exists'     => __('validation/role.permissions.*.exists'),
        ];
    }
}
