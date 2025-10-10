<?php
return [
    'title' => [
        'required' => 'The role title field is required.',
        'string'   => 'The role title must be a string.',
        'min'      => 'The role title must be at least :min characters.',
        'max'      => 'The role title may not exceed :max characters.',
        'unique'   => 'A role with this title already exists.',
    ],

    'permissions' => [
        'array'     => 'The permissions field must be an array.',
        '*.integer' => 'Each permission ID must be an integer.',
        '*.exists'  => 'One or more selected permissions do not exist.',
    ],
];
