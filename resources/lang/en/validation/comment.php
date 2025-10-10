<?php
return [
    // Comment text
    'body' => [
        'required' => 'The comment field cannot be empty.',
        'string'   => 'The comment must be a string.',
        'min'      => 'The comment must be at least :min characters.',
        'max'      => 'The comment may not exceed :max characters.',
    ],

    // Comment status
    'status' => [
        'required' => 'The status field is required.',
        'string'   => 'The status must be a string.',
        'in'       => 'The selected comment status is invalid.',
    ],

    // User reference
    'user_id' => [
        'required' => 'The user ID field is required.',
        'integer'  => 'The user ID must be an integer.',
        'exists'   => 'The specified user does not exist.',
    ],

    // Post reference
    'post_id' => [
        'required' => 'The post ID field is required.',
        'exists'   => 'The specified post does not exist.',
    ],

    // Parent comment (for replies)
    'parent_id' => [
        'exists' => 'The specified parent comment does not exist.',
    ],

    // Captcha verification
    'captcha' => [
        'required' => 'Captcha verification is required.',
    ],
];
