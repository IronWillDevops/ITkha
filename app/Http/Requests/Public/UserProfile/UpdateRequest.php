<?php

namespace App\Http\Requests\Public\UserProfile;

use App\Rules\Public\GitHubUrl;
use App\Rules\Public\LinkedInUrl;
use App\Rules\Public\ValidPublicUrl;
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
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'], // 2MB
            'name' => ['required', 'string', 'max:100'],
            'surname' => ['required', 'string', 'max:100'],

            'job_title' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'about_myself' => ['nullable', 'string', 'max:1000'],
            'website' => ['nullable', 'url', 'max:255', new ValidPublicUrl()],
            'github' => ['nullable', 'url', 'max:255', new GitHubUrl()],
            'linkedin' => ['nullable', 'url', 'max:255', new LinkedInUrl()],

        ];
    }
    public function messages(): array
    {
        return [
            'avatar.image' => __('validation.avatar.image'),
            'avatar.max' => __('validation.avatar.max'),

            'name.required' => __('validation.name.required'),
            'name.string' => __('validation.name.string'),
            'name.max' => __('validation.name.max'),

            'surname.string' => __('validation.surname.string'),
            'surname.max' => __('validation.surname.max'),

            'job_title.string' => __('validation.job_title.string'),
            'job_title.max' => __('validation.job_title.max'),

            'address.string' => __('validation.address.string'),
            'address.max' => __('validation.address.max'),

            'about_myself.string' => __('validation.about_myself.string'),
            'about_myself.max' => __('validation.about_myself.max'),

            'website.url' => __('validation.website.url'),
            'website.max' => __('validation.website.max'),

            'github.url' => __('validation.github.url'),
            'github.max' => __('validation.github.max'),

            'linkedin.url' => __('validation.linkedin.url'),
            'linkedin.max' => __('validation.linkedin.max'),
        ];
    }
}
