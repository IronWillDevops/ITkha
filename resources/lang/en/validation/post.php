<?php
return [
    // Title
    'title' => [
        'required' => 'The title field is required.',
        'string'   => 'The title must be a string.',
        'min'      => 'The title must be at least :min characters.',
        'max'      => 'The title may not exceed :max characters.',
    ],

    // Content
    'content' => [
        'required' => 'The content field is required.',
        'string'   => 'The content must be a string.',
    ],

    // Main image
    'main_image' => [
        'file'  => 'The main image must be a valid file.',
        'mimes' => 'The main image must be of type: :values.',
        'max'   => 'The main image may not be greater than :max kilobytes.',
    ],

    // Status
    'status' => [
        'required' => 'The status field is required.',
        'string'   => 'The status must be a string.',
        'in'       => 'The selected status is invalid.',
    ],

    // Comments enabled
    'comments_enabled' => [
        'required' => 'The comments enabled field is required.',
        'boolean'  => 'The comments enabled field must be true or false.',
    ],

    // Category
    'category_id' => [
        'required' => 'The category field is required.',
        'integer'  => 'The category ID must be an integer.',
        'exists'   => 'The selected category does not exist.',
    ],

    // Tags
    'tag_ids' => [
        'array'     => 'The tags field must be an array.',
        '*.integer' => 'Each tag ID must be an integer.',
        '*.exists'  => 'One or more selected tags do not exist.',
    ],

    // User
    'user_id' => [
        'required' => 'The user field is required.',
        'integer'  => 'The user ID must be an integer.',
        'exists'   => 'The specified user does not exist.',
    ],
    
];
