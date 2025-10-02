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
            'avatar.image' => __('common/validation.avatar.image'),
            'avatar.max' => __('common/validation.avatar.max'),

            'name.required' => __('common/validation.name.required'),
            'name.string' => __('common/validation.name.string'),
            'name.max' => __('common/validation.name.max'),
            'name.regex' => __('common/validation.name.regex'),

            'surname.string' => __('common/validation.surname.string'),
            'surname.max' => __('common/validation.surname.max'),
            'surname.regex' => __('common/validation.surname.regex'),

            'job_title.string' => __('common/validation.job_title.string'),
            'job_title.max' => __('common/validation.job_title.max'),

            'address.string' => __('common/validation.address.string'),
            'address.max' => __('common/validation.address.max'),

            'about_myself.string' => __('common/validation.about_myself.string'),
            'about_myself.max' => __('common/validation.about_myself.max'),

            'website.url' => __('common/validation.website.url'),
            'website.max' => __('common/validation.website.max'),

            'github.url' => __('common/validation.github.url'),
            'github.max' => __('common/validation.github.max'),

            'linkedin.url' => __('common/validation.linkedin.url'),
            'linkedin.max' => __('common/validation.linkedin.max'),
        ];
    }
}
