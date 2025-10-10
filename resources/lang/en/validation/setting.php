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
];
