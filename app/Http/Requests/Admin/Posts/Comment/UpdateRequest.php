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

            'body.required' => __('validation.required'),
            'body.string'   => __('validation.string'),
            'body.min'      => __('validation.min.string'),
            'body.max'      =>  __('validation.max.string'),

            'status.required' =>  __('validation.required'),
            'status.string' =>  __('validation.string'),
            'status.in' => __('validation.in'),


            'user_id.required' => __('validation.required'),
            'user_id.integer' => __('validation.integer'),
            'user_id.exists' => __('validation.exists'),
            // повідомлення про неправильну капчу краще обробляти у самому правилі CaptchaRule
        ];
    }
}
