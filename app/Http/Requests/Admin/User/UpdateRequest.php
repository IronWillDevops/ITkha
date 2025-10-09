<?php

namespace App\Http\Requests\Admin\User;

use App\Enums\UserStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


use App\Rules\Public\GitHubUrl;
use App\Rules\Public\LinkedInUrl;
use App\Rules\Public\ValidPublicUrl;

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
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'], // 2MB
            'name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z]+$/'],
            'login' => [
                'required',
                'string',
                'min:5',
                'max:50',
                'regex:/^[A-Za-z0-9_]+$/',
                Rule::unique('users')->ignore($this->user->id)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user->id),
            ],
            'surname' => ['nullable', 'string', 'max:255', 'regex:/^[A-Za-z]+$/'],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => ['nullable', 'string', 'min:8', 'max:255'],

            'email_verified_at' => ['required', 'boolean'],
            'status' => ['required', Rule::in(array_column(UserStatus::cases(), 'value'))],

            // Profile
            "job_title" => ['nullable', 'string', 'max:255'],
            "address" => ['nullable', 'string', 'max:255'],
            "website" => ['nullable', 'url', 'max:255', new ValidPublicUrl()],
            "about_myself" => ['nullable', 'string', 'max:1000'],
            "github" => ['nullable',  'url', 'max:255', new GitHubUrl()],
            "linkedin" => ['nullable', 'url', 'max:255', new LinkedInUrl()],


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

            'status.required' =>__('validation/user.status.required'),
            'status.in' => __('validation/user.status.in'),

        ];
    }
}
