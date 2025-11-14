<?php
return [
    'comments' => [
        'enabled' => [
            'boolean' => 'The comments enabled setting must be true or false.',
        ],

        'auto_approve' => [
            'boolean' => 'The auto-approve setting must be true or false.',
        ],

        'filter_words' => [
            'string' => 'The list of filter words must be a valid string.',
        ],

        'links_policy' => [
            'required' => 'The links policy field is required.',
            'in' => 'The selected links policy is invalid.',
        ],
    ],

    'user' => [
        'user_default_status' => [
            'string' => 'The user default status must be a string value.',
        ],
        'user_default_role' => [
            'string' => 'The user default role must be a string value.',
        ],
        'user_require_email_verification' => [
            'boolean' => 'The email verification field must be a boolean (true or false).',
        ],
    ],

    'site' => [
        'name' => [
            'required' => 'The site name is required.',
            'string' => 'The site name must be a string.',
            'max' => 'The site name may not be greater than :max characters.',
        ],
        'description' => [
            'string' => 'The site description must be a string.',
            'max' => 'The site description may not be greater than :max characters.',
        ],
        'keywords' => [
            'string' => 'The site keywords must be a string.',
            'max' => 'The site keywords may not be greater than :max characters.',
        ],
        'favicon' => [
            'image' => 'The favicon must be an image file.',
            'mimes' => 'The favicon must be a file of type: png, ico, jpg, jpeg, or svg.',
            'max' => 'The favicon may not be greater than :max kilobytes.',
        ],
    ],

    'contacts' => [
        'message' => [
            'required' => 'The message field is required.',
            'string'   => 'The message must be a string.',
            'min'      => 'The message must be at least :min characters.',
        ],
    ],

];
