<?php
return [

    'name' => [
        'required' => 'The name field is required.',
        'string'   => 'The name must be a string.',
        'max'      => 'The name may not exceed :max characters.',
    ],

    'subject' => [
        'required' => 'The subject field is required.',
        'string'   => 'The subject must be a string.',
        'max'      => 'The subject may not exceed :max characters.',
    ],

    'email' => [
        'required' => 'The email field is required.',
        'email'    => 'Please enter a valid email address.',
    ],

    'message' => [
        'required' => 'The message field is required.',
        'string'   => 'The message must be a string.',
        'min'      => 'The message must be at least :min characters.',
        'max'      => 'The message may not exceed :max characters.',
    ],

    'captcha' => [
        'required' => 'Please complete the captcha verification.',
    ],
];
