<?php

namespace App\Http\Requests\Admin\Posts\Post;

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

            'main_image' => ['nullable', 'file', 'mimes:jpg,png', 'max:2048'],

            'status' => ['required', 'string', 'in:' . implode(',', array_map(fn($s) => $s->value, PostStatus::cases()))],
            'comments_enabled' => ['nullable', 'boolean'],


            'category_id' => ['required', 'integer', 'exists:categories,id'],

            'tag_ids' => ['nullable', 'array'],
            'tag_ids.*' => ['integer', 'exists:tags,id'],

            'user_id' => ['required', 'integer', 'exists:users,id'],
            // Добавляем published_at
            'published_at' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) {
                    if ($this->input('status') === PostStatus::SCHEDULED->value && !$value) {
                        $fail(__('validation.required', ['attribute' => $attribute]));
                    }
                },
            ],

        ];
    }
    public function messages(): array
    {
        return [

            // Повідомлення для title
            'title.required' => __('validation.required'),
            'title.string' => __('validation.string'),
            'title.min' => __('validation.min.string'),
            'title.max' => __('validation.max.string'),

            // Повідомлення для content
            'content.required' => __('validation.required'),
            'content.string' => __('validation.string'),

            // Main image
            'main_image.file' => __('validation.file'),
            'main_image.mimes' => __('validation.mimes'),
            'main_image.max' => __('validation.max.file'),

            'status.required' => __('validation.required'),
            'status.string' => __('validation.string'),
            'status.in' => __('validation.in'),

            'comments_enabled.nullable' => __('validation.nullable'),
            'comments_enabled.boolean' => __('validation.boolean'),

            'category_id.required' =>  __('validation.required'),
            'category_id.integer' =>  __('validation.integer'),
            'category_id.exists' =>  __('validation.exists'),

            'tag_ids.array' =>  __('validation.array'),
            'tag_ids.*.integer' =>  __('validation.integer'),
            'tag_ids.*.exists' =>  __('validation.exists'),

            'user_id.required' =>  __('validation.required'),
            'user_id.integer' =>  __('validation.integer'),
            'user_id.exists' =>  __('validation.exists'),

            'published_at.required' => __('validation.required'),
            'published_at.date' => __('validation.date'),
            'published_at.after_now' => __('validation.after', ['attribute' => 'published_at']),
        ];
    }
}
