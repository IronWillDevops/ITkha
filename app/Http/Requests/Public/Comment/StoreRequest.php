<?php

namespace App\Http\Requests\Public\Comment;

use App\Rules\Public\CaptchaRule;
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
            'post_id' => ['required', 'exists:posts,id'],
            'body' => ['required', 'string', 'min:20', 'max:1000'],
            'parent_id' => ['nullable', 'exists:comments,id'],
            'captcha' => ['required',  new CaptchaRule()],
        ];
    }
    public function messages(): array
    {
        return [
            'post_id.required' => __('common/validation.comment.post_id.required'),
            'post_id.exists'   => __('common/validation.comment.post_id.exists'),

            'body.required' => __('common/validation.comment.body.required'),
            'body.string'   => __('common/validation.comment.body.string'),
            'body.min'      => __('common/validation.comment.body.min'),
            'body.max'      => __('common/validation.comment.body.max'),

            'parent_id.exists' => __('common/validation.comment.parent_id.exists'),

            'captcha.required' => __('common/validation.captcha.required'),
            // повідомлення про неправильну капчу краще обробляти у самому правилі CaptchaRule
        ];
    }
}
