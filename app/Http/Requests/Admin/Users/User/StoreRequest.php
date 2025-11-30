<?php

namespace App\Http\Requests\Admin\Users\User;

use App\Enums\UserStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z]+$/'],
            'surname' => ['string', 'max:255', 'regex:/^[A-Za-z]+$/'],
            'login' => ['required', 'string', 'min:5', 'max:50', 'unique:users', 'regex:/^[A-Za-z0-9_]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
            'role_id' => ['required', 'exists:roles,id'],
            'email_verified_at' => ['required', 'boolean'],
            'status' => ['required', Rule::in(array_column(UserStatus::cases(), 'value'))],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.required'),
            'name.string' => __('validation.string'),
            'name.max' => __('validation.max.string'),
            'name.regex' => __('validation.regex'),

            'surname.string' => __('validation.string'),
            'surname.max' => __('validation.max.string'),
            'surname.regex' => __('validation.regex'),

            'login.required' => __('validation.required'),
            'login.string' =>  __('validation.string'),
            'login.min' =>  __('validation.min.string'),
            'login.max' =>  __('validation.max.string'),
            'login.unique' =>  __('validation.unique'),
            'login.regex' =>  __('validation.regex'),

            'email.required' =>  __('validation.required'),
            'email.string' =>  __('validation.string'),
            'email.email' => __('validation.email'),
            'email.max' =>  __('validation.max.string'),
            'email.unique' =>  __('validation.unique'),

            'password.required' =>  __('validation.required'),
            'password.string' =>  __('validation.string'),
            'password.min' =>  __('validation.min.string'),
            'password.max' =>  __('validation.max.string'),

            'role_id.required' => __('validation.required'),
            'role_id.exists' => __('validation.exists'),

            'email_verified_at.required' => __('validation.required'),
            'email_verified_at.boolean' => __('validation.boolean'),

            'status.required' => __('validation.required'),
            'status.in' => __('validation.in'),
        ];
    }
}
