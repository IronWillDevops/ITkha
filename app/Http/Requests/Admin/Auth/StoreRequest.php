<?php

namespace App\Http\Requests\Admin\Auth;

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
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }
    public function messages(): array
    {
        return [

            'email.required' => __('validation/auth.email.required'),
            'email.string' => __('validation/auth.email.string'),
            'email.email' => __('validation/auth.email.email'),

            'password.required' =>  __('validation/auth.password.required'),
            'password.string' =>  __('validation/auth.password.string'),
        ];
    }
}
