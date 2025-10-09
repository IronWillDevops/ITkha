<?php
return [
    'name' => [
        'required' => 'The name field is required.',
        'string'   => 'The name must be a valid string.',
        'max'      => 'The name may not be greater than :max characters.',
        'regex'    => 'The name format is invalid.',
    ],

    'surname' => [
        'string' => 'The surname must be a valid string.',
        'max'    => 'The surname may not be greater than :max characters.',
        'regex'  => 'The surname format is invalid.',
    ],

    'login' => [
        'required' => 'The login field is required.',
        'string'   => 'The login must be a valid string.',
        'min'      => 'The login must be at least :min characters.',
        'max'      => 'The login may not be greater than :max characters.',
        'unique'   => 'This login is already taken.',
        'regex'    => 'The login format is invalid.',
    ],

    'email' => [
        'required' => 'The email field is required.',
        'string'   => 'The email must be a valid string.',
        'email'    => 'Please enter a valid email address.',
        'max'      => 'The email may not be greater than :max characters.',
        'unique'   => 'This email is already registered.',
    ],

    'password' => [
        'required'       => 'The password field is required.',
        'string'         => 'The password must be a valid string.',
        'max'            => 'The password may not be greater than :max characters.',
        'confirmed'      => 'The password confirmation does not match.',
        'min'            => 'The password must be at least :min characters.',
        'letters'        => 'The password must contain at least one letter.',
        'mixed'          => 'The password must include both uppercase and lowercase letters.',
        'numbers'        => 'The password must contain at least one number.',
        'symbols'        => 'The password must contain at least one special character.',
        'uncompromised'  => 'The given password appears in a data leak. Please choose a different one.',
    ],

    'captcha' => [
        'required' => 'The captcha verification is required.',
    ],
];
