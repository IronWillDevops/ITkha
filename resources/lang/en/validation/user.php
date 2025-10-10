<?php
return [
    'avatar' => [
        'image' => 'The avatar must be an image (jpg, jpeg, png, webp).',
        'mimes' => 'The avatar must be a file of type: :values.',
        'max' => 'The avatar size must not exceed :max kilobytes.',
    ],

    'email' => [
        'required' => 'Email is required.',
        'string' => 'Email must be a string.',
        'email' => 'Email must be a valid email address.',
        'max' => 'Email must not exceed :max characters.',
        'unique' => 'A user with this email already exists.',
    ],
    'email_verified_at' => [
        'required' => 'Email verification status is required.',
        'boolean'  => 'Email verification status must be true or false.',
    ],

    'password' => [
        'required' => 'Password is required.',
        'string' => 'Password must be a string.',
        'min' => 'Password must be at least :min characters.',
        'max' => 'Password must not exceed :max characters.',
        'confirmed' => 'Passwords do not match.',
        'current' => 'The current password is incorrect.',
        'letters' => 'The password must contain at least one letter.',
        'mixed' => 'The password must contain both uppercase and lowercase letters.',
        'numbers' => 'The password must contain at least one number.',
        'symbols' => 'The password must contain at least one special character.',
        'uncompromised' => 'This password has appeared in a data leak. Please choose a different one.',
    ],

    'user_id' => [
        'required' => 'The user field is required.',
        'integer'  => 'The user ID must be an integer.',
        'exists'   => 'The specified user does not exist.',
    ],
    'name' => [
        'required' => 'The name field is required.',
        'string' => 'The name must be a string.',
        'max' => 'The name may not be greater than :max characters.',
        'regex' => 'Name may contain only English letters.',
    ],

    'surname' => [
        'string' => 'The surname must be a string.',
        'max' => 'The surname may not be greater than :max characters.',
        'regex' => 'Surname may contain only English letters.',
    ],
    'login' => [
        'required' => 'Login is required.',
        'string' => 'Login must be a string.',
        'min' => 'Login must be at least :min characters.',
        'max' => 'Login must not exceed :max characters.',
        'unique' => 'A user with this login already exists.',
        'regex' => 'Login may contain only English letters, numbers, and underscore (_).',
    ],

    'job_title' => [
        'string' => 'The job title must be a string.',
        'max' => 'The job title may not be greater than :max characters.',
    ],

    'address' => [
        'string' => 'The address must be a string.',
        'max' => 'The address may not be greater than :max characters.',
    ],

    'about_myself' => [
        'string' => 'The about myself section must be a string.',
        'max' => 'The about myself section may not be greater than :max characters.',
    ],

    'website' => [
        'url' => 'The website format is invalid.',
        'max' => 'The website may not be greater than :max characters.',
        'public_url' => 'Please enter valid public data.',
    ],

    'github' => [
        'url' => 'The GitHub URL format is invalid.',
        'max' => 'The GitHub URL may not be greater than :max characters.',
        'github_url' => 'The field must be a valid GitHub profile URL.',
    ],

    'linkedin' => [
        'url' => 'The LinkedIn URL format is invalid.',
        'max' => 'The LinkedIn URL may not be greater than :max characters.',
        'linkedin_url' => 'The field must contain a valid LinkedIn profile link.',
    ],
    
    'role_id' => [
        'required' => 'The role field is required.',
        'exists'   => 'The selected role does not exist.',
    ],

    'status' => [
        'required' => 'The status field is required.',
        'in'       => 'The selected status is invalid.',
    ],
];
