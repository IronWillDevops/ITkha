<?php

namespace App\Http\Requests\Admin\Profile;

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
            'name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z]+$/'],
            'surname' => ['string', 'max:255', 'regex:/^[A-Za-z]+$/'],

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
            'avatar.image' => __('validation/profile.avatar.image'),
            'avatar.max' => __('validation/profile.avatar.max'),

            'name.required' => __('validation/profile.name.required'),
            'name.string' => __('validation/profile.name.string'),
            'name.max' => __('validation/profile.name.max'),
            'name.regex' => __('validation/profile.name.regex'),

            'surname.string' => __('validation/profile.surname.string'),
            'surname.max' => __('validation/profile.surname.max'),
            'surname.regex' => __('validation/profile.surname.regex'),

            'job_title.string' => __('validation/profile.job_title.string'),
            'job_title.max' => __('validation/profile.job_title.max'),

            'address.string' => __('validation/profile.address.string'),
            'address.max' => __('validation/profile.address.max'),

            'about_myself.string' => __('validation/profile.about_myself.string'),
            'about_myself.max' => __('validation/profile.about_myself.max'),

            'website.url' => __('validation/profile.website.url'),
            'website.max' => __('validation/profile.website.max'),

            'github.url' => __('validation/profile.github.url'),
            'github.max' => __('validation/profile.github.max'),

            'linkedin.url' => __('validation/profile.linkedin.url'),
            'linkedin.max' => __('validation/profile.linkedin.max'),
        ];
    }
}
