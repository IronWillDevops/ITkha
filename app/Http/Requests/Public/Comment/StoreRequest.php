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
            'post_id' => ['required', 'exists:posts,id'],
            'body' => ['required', 'string', 'min:20', 'max:1000'],
            'parent_id' => ['nullable', 'exists:comments,id'],
            'captcha' => ['required',  new CaptchaRule()],
        ];
    }
    public function messages(): array
    {
        return [
            'post_id.required' => __('validation.required'),
            'post_id.exists'   => __('validation.exists'),

            'body.required' => __('validation.required'),
            'body.string'   => __('validation.string'),
            'body.min'      => __('validation.min.string'),
            'body.max'      => __('validation.max.string'),

            'parent_id.exists' => __('validation.exists'),

            'captcha.required' => __('validation.required'),
       ];
    }
}
