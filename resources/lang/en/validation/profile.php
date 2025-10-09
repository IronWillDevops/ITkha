<?php 
return [
    'avatar' => [
        'image' => 'The avatar must be an image (jpg, jpeg, png, webp).',
        'max'   => 'The avatar size must not exceed :max kilobytes.',
    ],

    'name' => [
        'required' => 'The name field is required.',
        'string'   => 'The name must be a string.',
        'max'      => 'The name may not be greater than :max characters.',
        'regex'    => 'The name may contain only English letters.',
    ],

    'surname' => [
        'string' => 'The surname must be a string.',
        'max'    => 'The surname may not be greater than :max characters.',
        'regex'  => 'The surname may contain only English letters.',
    ],

    'job_title' => [
        'string' => 'The job title must be a string.',
        'max'    => 'The job title may not be greater than :max characters.',
    ],

    'address' => [
        'string' => 'The address must be a string.',
        'max'    => 'The address may not be greater than :max characters.',
    ],

    'about_myself' => [
        'string' => 'The about myself section must be a string.',
        'max'    => 'The about myself section may not be greater than :max characters.',
    ],

    'website' => [
        'url' => 'The website format is invalid.',
        'max' => 'The website may not be greater than :max characters.',
    ],

    'github' => [
        'url' => 'The GitHub URL format is invalid.',
        'max' => 'The GitHub URL may not be greater than :max characters.',
    ],

    'linkedin' => [
        'url' => 'The LinkedIn URL format is invalid.',
        'max' => 'The LinkedIn URL may not be greater than :max characters.',
    ],
];
