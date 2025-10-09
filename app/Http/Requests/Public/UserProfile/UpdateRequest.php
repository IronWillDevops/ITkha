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
            'avatar.image' => __('validation/userupdate.avatar.image'),
            'avatar.max' => __('validation/userupdate.avatar.max'),

            'name.required' => __('validation/userupdate.name.required'),
            'name.string' => __('validation/userupdate.name.string'),
            'name.max' => __('validation/userupdate.name.max'),
            'name.regex' => __('validation/userupdate.name.regex'),

            'surname.string' => __('validation/userupdate.surname.string'),
            'surname.max' => __('validation/userupdate.surname.max'),
            'surname.regex' => __('validation/userupdate.surname.regex'),


            'job_title.string' => __('validation/userupdate.job_title.string'),
            'job_title.max' => __('validation/userupdate.job_title.max'),

            'address.string' => __('validation/userupdate.address.string'),
            'address.max' => __('validation/userupdate.address.max'),

            'about_myself.string' => __('validation/userupdate.about_myself.string'),
            'about_myself.max' => __('validation/userupdate.about_myself.max'),

            'website.url' => __('validation/userupdate.website.url'),
            'website.max' => __('validation/userupdate.website.max'),

            'github.url' => __('validation/userupdate.github.url'),
            'github.max' => __('validation/userupdate.github.max'),

            'linkedin.url' => __('validation/userupdate.linkedin.url'),
            'linkedin.max' => __('validation/userupdate.linkedin.max'),
        ];
    }
}
