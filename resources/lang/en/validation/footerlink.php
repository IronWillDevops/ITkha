<?php
return [
    // Icon
    'icon' => [
        'required' => 'The icon field is required.',
        'string'   => 'The icon must be a string.',
        'min'      => 'The icon must be at least :min characters.',
        'max'      => 'The icon may not exceed :max characters.',
    ],

    // Title
    'title' => [
        'required' => 'The title field is required.',
        'string'   => 'The title must be a string.',
        'min'      => 'The title must be at least :min characters.',
        'max'      => 'The title may not exceed :max characters.',
    ],

    // URL
    'url' => [
        'required' => 'The URL field is required.',
        'string'   => 'The URL must be a string.',
        'min'      => 'The URL must be at least :min characters.',
        'max'      => 'The URL may not exceed :max characters.',
        'url'      => 'The URL format is invalid.',
    ],
];
