<?php

namespace App\Http\Requests\Admin\Comment;

use App\Enums\CommentStatus;
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
    protected function prepareForValidation(): void
    {
        if ($this->has('body')) {
            $this->merge([
                'body' => str_replace(["\r\n", "\r"], "\n", $this->input('body')),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'body' => ['required', 'string', 'min:20', 'max:1000'],
            'status' => ['required', 'string', 'in:' . implode(',', array_map(fn($s) => $s->value, CommentStatus::cases()))],

            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [

            'body.required' => 'Поле обов`язкове для заповнення',
            'body.string'   => 'Коментар повинен бути рядком.',
            'body.min'      => 'Коментар повинен містити щонайменше :min символи.',
            'body.max'      =>  'Коментар повинен містити щонайбільше :min символи.',

            'status.required' => 'Вкажіть статус посту.',
            'status.string' => 'Статус посту повинен бути рядком.',
            'status.in' => 'Вказано некоректний статус посту. Доступні значення: draft, published, archived.',


            'user_id.required' => 'Поле "Автор" є обов’язковим.',
            'user_id.integer' => 'Вкажіть ID автора.',
            'user_id.exists' => 'Вказаний автор не існує або був видалений.',
            // повідомлення про неправильну капчу краще обробляти у самому правилі CaptchaRule
        ];
    }
}
