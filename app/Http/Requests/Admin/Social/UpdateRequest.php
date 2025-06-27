<?php

namespace App\Http\Requests\Admin\Social;

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
            'icon' => ['required', 'string', 'min:2', 'max:50'],
            'title' => ['required', 'string', 'min:2', 'max:50'],
            'url' => ['required', 'string', 'min:2', 'max:100', 'url'],

        ];
    }
    public function messages(): array
    {
        return [
            // icon
            'icon.required' => 'Вкажіть іконку для соц. мережі.',
            'icon.string' => 'Іконка повинна бути у вигляді тексту.',
            'icon.min' => 'Іконка повинна містити щонайменше :min символи.',
            'icon.max' => 'Іконка не повинна перевищувати :max символів.',

            // title
            'title.required' => 'Вкажіть назву соц. мережі.',
            'title.string' => 'Назва соц. мережі повинна бути текстовою.',
            'title.min' => 'Назва соц. мережі повинна містити щонайменше :min символи.',
            'title.max' => 'Назва соц. мережі не повинна перевищувати :max символів.',

            // url
            'url.required' => 'Вкажіть URL соц. мережі.',
            'url.string' => 'URL повинен бути текстовим.',
            'url.min' => 'URL повинен містити щонайменше :min символи.',
            'url.max' => 'URL не повинен перевищувати :max символів.',
            'url.url' => 'URL повинен бути дійсною інтернет-адресою.',
        ];
    }
}
