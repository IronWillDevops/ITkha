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
            'title.required' => __('validation/post.title.required'),
            'title.string' => __('validation/post.title.string'),
            'title.min' => __('validation/post.title.min'),
            'title.max' => __('validation/post.title.max'),

            // Повідомлення для content
            'content.required' => __('validation/post.content.required'),
            'content.string' => __('validation/post.content.string'),

            // Main image
            'main_image.file' => __('validation/post.main_image.file'),
            'main_image.mimes' => __('validation/post.main_image.mimes'),
            'main_image.max' => __('validation/post.main_image.max'),

            'status.required' => __('validation/post.status.required'),
            'status.string' => __('validation/post.status.string'),
            'status.in' => __('validation/post.status.in'),

            'comments_enabled.required' => __('validation/post.comments_enabled.required'),
            'comments_enabled.boolean' => __('validation/post.comments_enabled.boolean'),

            'category_id.required' =>  __('validation/post.category_id.required'),
            'category_id.integer' =>  __('validation/post.category_id.integer'),
            'category_id.exists' =>  __('validation/post.category_id.exists'),

            'tag_ids.array' =>  __('validation/post.tag_ids.array'),
            'tag_ids.*.integer' =>  __('validation/post.tag_ids.*.integer'),
            'tag_ids.*.exists' =>  __('validation/post.tag_ids.*.exists'),

            'user_id.required' =>  __('validation/post.user_id.required'),
            'user_id.integer' =>  __('validation/post.user_id.integer'),
            'user_id.exists' =>  __('validation/post.user_id.exists'),
        ];
    }
}
