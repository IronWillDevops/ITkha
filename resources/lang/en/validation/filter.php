<?php
return [
    'search' => [
        'string' => 'The search query must be a string.',
        'min'    => 'The search query must be at least :min characters.',
    ],

    'title' => [
        'string' => 'The title must be a valid string.',
    ],

    'content' => [
        'string' => 'The content must be a valid string.',
    ],

    'category' => [
        'string' => 'The category must be a valid string.',
    ],

    'tag' => [
        'array'      => 'Tags must be provided as an array.',
        '*.string'   => 'Each tag must be a valid string.',
    ],

    'author' => [
        'string' => 'The author field must be a valid string.',
    ],

    'sort_by' => [
        'string' => 'The sort field must be a valid string.',
        'in'     => 'The selected sorting option is invalid.',
    ],

    'sort_dir' => [
        'string' => 'The sorting direction must be a valid string.',
        'in'     => 'The selected sorting direction is invalid.',
    ],
];
