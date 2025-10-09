<?php

namespace App\Http\Requests\Admin\Setting\Comment;

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
            'comments_auto_approve' => ['nullable', 'boolean'],
            'comments_filter_words' => ['nullable', 'string'],
            'comments_links_policy' => ['required', 'in:allow,remove,reject'],
        ];
    }

      public function messages(): array
    {
        return [
            'comments_auto_approve.boolean' => __('validation/setting.comments.auto_approve.boolean'),
            'comments_filter_words.string' => __('validation/setting.comments.filter_words.string'),
            'comments_links_policy.required' => __('validation/setting.comments.links_policy.required'),
            'comments_links_policy.in' => __('validation/setting.comments.links_policy.in'),
        ];
    }
}
