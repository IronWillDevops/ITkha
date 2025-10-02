<?php
return [
    'email' => [
        'required' => 'Email is required.',
        'string' => 'Email must be a string.',
        'email' => 'Email must be a valid email address.',
        'max' => 'Email must not exceed :max characters.',
        'unique' => 'A user with this email already exists.',
    ],

    'captcha' => [
        'required' => 'Please enter the captcha.',
        'incorrect' => 'Incorrect captcha.',
    ],

    'password' => [
        'required' => 'Password is required.',
        'string' => 'Password must be a string.',
        'min' => 'Password must be at least :min characters.',
        'max' => 'Password must not exceed :max characters.',
        'confirmed' => 'Passwords do not match.',
        'letters' => 'The password must contain at least one letter.',
        'mixed' => 'The password must contain both uppercase and lowercase letters.',
        'numbers' => 'The password must contain at least one number.',
        'symbols' => 'The password must contain at least one special character.',
        'uncompromised' => 'This password has appeared in a data leak. Please choose a different one.',

    ],

    'current_password' => [
        'required' => 'Please enter your current password.',
        'current_password' => 'The current password is incorrect.',
    ],

    'login' => [

        'required' => 'Login is required.',
        'string' => 'Login must be a string.',
        'min' => 'Login must be at least :min characters.',
        'max' => 'Login must not exceed :max characters.',
        'unique' => 'A user with this login already exists.',
        'regex' => 'Login may contain only English letters, numbers, and underscore (_).',
    ],

    'token' => [
        'required' => 'Password reset token is required.',
    ],

    'search' => [
        'string' => 'Search query must be a string.',
        'min' => 'Search query must be at least :min characters.',
    ],

    'title' => [
        'string' => 'Title must be a string.',
    ],

    'content' => [
        'string' => 'Content must be a string.',
    ],

    'category' => [
        'string' => 'Category must be a string.',
    ],

    'tags' => [
        'array' => 'Tags must be provided as an array.',
    ],

    'tags.*' => [
        'string' => 'Each tag must be a string.',
    ],

    'author' => [
        'string' => 'Author name must be a string.',
    ],

    'sort_by' => [
        'string' => 'Sort field must be a string.',
        'in' => 'Sort field must be one of the following: id, title, created_at, updated_at.',
    ],

    'sort_dir' => [
        'string' => 'Sort direction must be a string.',
        'in' => 'Sort direction must be either "asc" or "desc".',
    ],

    'subject' => [
        'required' => 'Please specify the subject.',
        'string' => 'Subject must be a string.',
        'max' => 'Subject must not exceed :max characters.',
    ],

    'message' => [
        'required' => 'Please enter a message.',
        'string' => 'Message must be a string.',
        'min' => 'Message must be at least :min characters.',
        'max' => 'Message must not exceed :max characters.',
    ],

    'avatar' => [
        'image' => 'The avatar must be an image (jpg, jpeg, png, webp).',
        'mimes' => 'The avatar must be a file of type: :values.',
        'max' => 'The avatar size must not exceed :max kilobytes.',
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

    'comment' => [
        'post_id' => [
            'required' => 'Post ID is required.',
            'exists'   => 'The specified post does not exist.',
        ],
        'body' => [
            'required' => 'Comment field cannot be empty.',
            'string'   => 'Comment must be a string.',
            'min'      => 'Comment must be at least :min characters.',
            'max'      => 'Comment cannot exceed :max characters.',
        ],
        'parent_id' => [
            'exists' => 'The specified parent comment does not exist.',
        ],
    ],
];
