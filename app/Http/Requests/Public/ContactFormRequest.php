<?php

namespace App\Http\Requests\Public;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50'],
            'subject' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string', 'min:10', 'max:1000'],
            'captcha' => ['required', function ($attribute, $value, $fail) {
                if ($value !== session('captcha')) {
                    $fail('Невірна капча.');
                }
            }],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Вкажіть ім’я.',
            'name.string' => 'Ім’я повинно бути у форматі тексту',
            'name.max' => 'Ім’я не повинно перевищувати :max символів',

            'subject.required' => 'Вкажіть тему повідомлення.',
            'subject.string' => 'Тема повинна бути у форматі тексту',
            'subject.max' => 'Тема не повинна перевищувати :max символів',

            'email.required' => 'Вкажіть email.',
            'email.email' => 'Email має бути коректним.',

            'message.required' => 'Введіть повідомлення.',
            'message.string' => 'Повідомлення повинно бути у форматі тексту',
            'message.min' => 'Повідомлення має містити щонайменше :min символів.',
            'message.max' => 'Повідомлення не повинно перевищувати :max символів.', // Переконайтеся, що повідомлення відповідає

            'captcha.required' => 'Введіть капчу.',
        ];
    }
}
