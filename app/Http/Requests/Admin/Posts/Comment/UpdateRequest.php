<?php

namespace App\Http\Requests\Admin\Posts\Comment;

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

            'body.required' => __('validation/comment.body.required'),
            'body.string'   => __('validation/comment.body.string'),
            'body.min'      => __('validation/comment.body.min'),
            'body.max'      =>  __('validation/comment.body.max'),

            'status.required' =>  __('validation/comment.status.required'),
            'status.string' =>  __('validation/comment.status.string'),
            'status.in' => __('validation/comment.status.in'),


            'user_id.required' => __('validation/comment.user_id.required'),
            'user_id.integer' => __('validation/comment.user_id.integer'),
            'user_id.exists' => __('validation/comment.user_id.exists'),
            // повідомлення про неправильну капчу краще обробляти у самому правилі CaptchaRule
        ];
    }
}
