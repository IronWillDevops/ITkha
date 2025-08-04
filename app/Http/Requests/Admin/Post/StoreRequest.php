<?php

namespace App\Http\Requests\Admin\Post;

use App\Enums\PostStatus;
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
            'title' => ['required', 'string', 'min:2', 'max:100'],

            'content' => ['required', 'string'],

            'main_image' => ['file', 'mimes:jpg,png', 'max:2048'],

            'status' => ['required', 'string', 'in:' . implode(',', array_map(fn($s) => $s->value, PostStatus::cases()))],
            'comments_enabled' => ['required', 'boolean'],


            'category_id' => ['required', 'integer', 'exists:categories,id'],

            'tag_ids' => ['nullable', 'array'],
            'tag_ids.*' => ['nullable', 'integer', 'exists:tags,id'],

            'user_id' => ['required', 'integer', 'exists:users,id'],

        ];
    }
    public function messages(): array
    {
        return [
            // Повідомлення для title
            'title.required' => 'Вкажіть назву посту.',
            'title.string' => 'Назва посту повинна бути текстовою.',
            'title.min' => 'Назва посту повинна містити щонайменше :min символи.',
            'title.max' => 'Назва посту не повинна перевищувати :max символів.',

            // Повідомлення для content
            'content.required' => 'Вкажіть зміст посту.',
            'content.string' => 'Зміст посту повинен бути текстовим.',

            // Main image
            'main_image.file' => 'Основне зображення повинно бути коректним файлом.',
            'main_image.mimes' => 'Основне зображення повинно бути у форматі JPG, PNG.',
            'main_image.max' => 'Основне зображення не повинно перевищувати :max KB.',

            'status.required' => 'Вкажіть статус посту.',
            'status.string' => 'Статус посту повинен бути рядком.',
            'status.in' => 'Вказано некоректний статус посту. Доступні значення: draft, published, archived.',

            'comments_enabled.required' => 'Поле "Коментарі" є обов’язковим.',
            'comments_enabled.boolean' => 'Поле "Коментарі" повинно бути булевим значенням.',

            'category_id.required' => 'Поле "Категорія" є обов’язковим.',
            'category_id.integer' => 'Категорія повинна бути числом.',
            'category_id.exists' => 'Вибрана категорія не існує або була видалена.',

            'tag_ids.array' => 'Необхідно надіслати масив даних',
            'tag_ids.*.integer' => 'Ідентифікатор тега повинен бути числом.',
            'tag_ids.*.exists' => 'Один або декілька вибраних тегів не існують.',

            'user_id.required' => 'Поле "Автор" є обов’язковим.',
            'user_id.integer' => 'Вкажіть ID автора.',
            'user_id.exists' => 'Вказаний автор не існує або був видалений.',
        ];
    }
}
