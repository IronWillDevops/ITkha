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
            'avatar.image' => __('public/validation.avatar.image'),
            'avatar.max' => __('public/validation.avatar.max'),

            'name.required' => __('public/validation.name.required'),
            'name.string' => __('public/validation.name.string'),
            'name.max' => __('public/validation.name.max'),

            'surname.string' => __('public/validation.surname.string'),
            'surname.max' => __('public/validation.surname.max'),

            'job_title.string' => __('public/validation.job_title.string'),
            'job_title.max' => __('public/validation.job_title.max'),

            'address.string' => __('public/validation.address.string'),
            'address.max' => __('public/validation.address.max'),

            'about_myself.string' => __('public/validation.about_myself.string'),
            'about_myself.max' => __('public/validation.about_myself.max'),

            'website.url' => __('public/validation.website.url'),
            'website.max' => __('public/validation.website.max'),

            'github.url' => __('public/validation.github.url'),
            'github.max' => __('public/validation.github.max'),

            'linkedin.url' => __('public/validation.linkedin.url'),
            'linkedin.max' => __('public/validation.linkedin.max'),
        ];
    }
}
