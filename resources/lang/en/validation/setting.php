<?php
return [
    'comment' => [
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

];
