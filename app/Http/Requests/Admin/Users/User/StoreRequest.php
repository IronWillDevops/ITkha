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
            'name.required' => __('validation/user.name.required'),
            'name.string' => __('validation/user.name.string'),
            'name.max' => __('validation/user.name.max'),
            'name.regex' => __('validation/user.name.regex'),

            'surname.string' => __('validation/user.surname.string'),
            'surname.max' => __('validation/user.surname.max'),
            'surname.regex' => __('validation/user.surname.regex'),

            'login.required' => __('validation/user.login.required'),
            'login.string' =>  __('validation/user.login.string'),
            'login.min' =>  __('validation/user.login.min'),
            'login.max' =>  __('validation/user.login.max'),
            'login.unique' =>  __('validation/user.login.unique'),
            'login.regex' =>  __('validation/user.login.regex'),

            'email.required' =>  __('validation/user.email.required'),
            'email.string' =>  __('validation/user.email.string'),
            'email.email' => __('validation/user.email.email'),
            'email.max' =>  __('validation/user.email.max'),
            'email.unique' =>  __('validation/user.email.unique'),

            'password.required' =>  __('validation/user.password.required'),
            'password.string' =>  __('validation/user.password.string'),
            'password.min' =>  __('validation/user.password.min'),
            'password.max' =>  __('validation/user.password.max'),

            'role_id.required' => __('validation/user.role_id.required'),
            'role_id.exists' => __('validation/user.role_id.exists'),

            'email_verified_at.required' => __('validation/user.email_verified_at.required'),
            'email_verified_at.boolean' => __('validation/user.email_verified_at.boolean'),

            'status.required' => __('validation/user.status.required'),
            'status.in' => __('validation/user.status.in'),
        ];
    }
}
