<?php
return [
    'token' => [
        'required' => 'The password reset token is required.',
    ],

    'email' => [
        'required' => 'The email field is required.',
        'string'   => 'The email must be a valid string.',
        'email'    => 'Please enter a valid email address.',
        'max'      => 'The email may not be greater than :max characters.',
    ],

    'password' => [
        'required'   => 'The password field is required.',
        'string'     => 'The password must be a valid string.',
        'min'        => 'The password must be at least :min characters.',
        'max'        => 'The password may not be greater than :max characters.',
        'confirmed'  => 'The password confirmation does not match.',
    ],
];
