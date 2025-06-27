<?php

namespace App\Http\Requests\Admin\Tag;

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
            'title.required' => 'Вкажіть назву тегу.',
            'title.string' => 'Назва тегу повинна бути текстовою.',
            'title.min' => 'Назва тегу повинна містити щонайменше :min символи.',
            'title.max' => 'Назва тегу не повинна перевищувати :max символів.',
            'title.unique' => 'Така назва тегу вже існує.',
        ];
    }
}
