<?php

namespace App\Http\Requests\Public\Auth\ReVerification;

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
            'email' => ['required', 'string', 'email', 'max:255'],

        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('validation/reverify.email.required'),
            'email.string' => __('validation/reverify.email.string'),
            'email.email' => __('validation/reverify.email.email'),
            'email.max' => __('validation/reverify.email.max'),

        ];
    }
}
