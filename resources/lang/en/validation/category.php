<?php
return [
    'title' => [
        'required' => 'The category title field is required.',
        'string'   => 'The category title must be a string.',
        'min'      => 'The category title must be at least :min characters.',
        'max'      => 'The category title may not exceed :max characters.',
        'unique'   => 'A category with this title already exists.',
    ],
];
