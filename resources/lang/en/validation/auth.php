<?php
return [
    'email' => [
        'required' => 'The email field is required.',
        'string'   => 'The email must be a string.',
        'email'    => 'Please enter a valid email address.',
        'max'      => 'The email may not exceed :max characters.',
    ],
    
    'password' => [
        'required' => 'The password field is required.',
        'string'   => 'The password must be a string.',
    ],
    
    'captcha' => [
        'required' => 'Please enter the captcha.',
    ],
];
