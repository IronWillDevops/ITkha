<?php

namespace App\Http\Requests\Public\Post;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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

            'search' => ['nullable', 'string', 'min:3'],
            'title' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'category' => ['nullable', 'string'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string'],
            'author' => ['nullable', 'string'],
            'sort_by' => ['nullable', 'string', 'in:id,title,created_at,updated_at'],
            'sort_dir' => ['nullable', 'string', 'in:asc,desc'],
        ];
    }

    public function messages(): array
    {
        return [
            'search.string' => 'Пошуковий запит має бути рядком.',
            'search.min' => 'Пошуковий запит має містити щонайменше :min символи.',

            'title.string' => 'Заголовок має бути рядком.',
            'content.string' => 'Контент має бути рядком.',
            'category.string' => 'Категорія має бути рядком.',

            'tags.array' => 'Теги мають бути передані у вигляді масиву.',
            'tags.*.string' => 'Кожен тег має бути рядком.',

            'author.string' => 'Ім’я автора має бути рядком.',

            'sort_by.string' => 'Поле сортування має бути рядком.',
            'sort_by.in' => 'Поле сортування може бути лише одним із: id, title, created_at, updated_at.',

            'sort_dir.string' => 'Напрям сортування має бути рядком.',
            'sort_dir.in' => 'Напрям сортування може бути тільки "asc" або "desc".',
        ];
    }
}
