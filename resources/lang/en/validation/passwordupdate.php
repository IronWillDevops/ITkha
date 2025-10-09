<?php
return [
    'current_password' => [
        'required'          => 'Please enter your current password.',
        'current_password'  => 'The current password you entered is incorrect.',
    ],

    'password' => [
        'required'      => 'The new password field is required.',
        'string'        => 'The password must be a valid string.',
        'max'           => 'The password may not exceed :max characters.',
        'confirmed'     => 'The password confirmation does not match.',
        'min'           => 'The password must be at least :min characters.',
        'letters'       => 'The password must contain at least one letter.',
        'mixed'         => 'The password must contain both uppercase and lowercase letters.',
        'numbers'       => 'The password must include at least one number.',
        'symbols'       => 'The password must contain at least one special character.',
        'uncompromised' => 'This password has appeared in a data leak. Please choose a different one.',
    ],
];
