<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'title' => [
                'required',
                'string',
                'min:2',
                'max:50',
                Rule::unique('roles', 'title')->ignore($this->role)
            ],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer', 'exists:permissions,id'],
        ];
    }
    public function messages(): array
    {
        return [

            'title.required' => 'Вкажіть назву ролі.',
            'title.string' => 'Назва ролі повинна бути текстовою.',
            'title.min' => 'Назва ролі повинна містити щонайменше :min символи.',
            'title.max' => 'Назва ролі не повинна перевищувати :max символів.',
            'title.unique' => 'Така назва ролі вже існує.',

            
            'permissions.array' => 'Список дозволів повинен бути у форматі масиву.',
            'permissions.*.integer' => 'Кожен дозвіл повинен бути числовим ідентифікатором.',
            'permissions.*.exists' => 'Обраний дозвіл не знайдено в базі даних.',
        ];
    }
}
