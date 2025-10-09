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
            'search.string' => __('validation/filter.search.string'),
            'search.min' => __('validation/filter.search.min'),

            'title.string' => __('validation/filter.title.string'),
            'content.string' => __('validation/filter.content.string'),
            'category.string' => __('validation/filter.category.string'),

            'tags.array' => __('validation/filter.tags.array'),

            'tags.*.string' => __('validation/filter.tags.*.string'),

            'author.string' => __('validation/filter.author.string'),

            'sort_by.string' => __('validation/filter.sort_by.string'),
            'sort_by.in' =>  __('validation/filter.sort_by.in'),

            'sort_dir.string' => __('validation/filter.sort_dir.string'),
            'sort_dir.in' => __('validation/filter.sort_dir.in'),
        ];
    }
}
