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
            'avatar.image' => __('validation.image'),
            'avatar.max' => __('validation.max.string'),

            'name.required' => __('validation.required'),
            'name.string' => __('validation.string'),
            'name.max' => __('validation.max.string'),
            'name.regex' => __('validation.regex'),

            'surname.string' => __('validation.string'),
            'surname.max' => __('validation.max.string'),
            'surname.regex' => __('validation.regex'),


            'job_title.string' => __('validation.string'),
            'job_title.max' => __('validation.max.string'),

            'address.string' => __('validation.string'),
            'address.max' => __('validation.max.string'),

            'about_myself.string' => __('validation.string'),
            'about_myself.max' => __('validation.max.string'),

            'website.url' => __('validation.url'),
            'website.max' => __('validation.max.string'),

            'github.url' => __('validation.url'),
            'github.max' => __('validation.max.string'),

            'linkedin.url' => __('validation.url'),
            'linkedin.max' => __('validation.max.string'),
        ];
    }
}
