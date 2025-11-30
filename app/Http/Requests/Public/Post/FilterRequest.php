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
            'search.string' => __('validation.string'),
            'search.min' => __('validation.min.string'),

            'title.string' => __('validation.string'),
            'content.string' => __('validation.string'),
            'category.string' => __('validation.string'),

            'tags.array' => __('validation.array'),

            'tags.*.string' => __('validation.string'),

            'author.string' => __('validation.string'),

            'sort_by.string' => __('validation.string'),
            'sort_by.in' =>  __('validation.in'),

            'sort_dir.string' => __('validation.string'),
            'sort_dir.in' => __('validation.in'),
        ];
    }
}
