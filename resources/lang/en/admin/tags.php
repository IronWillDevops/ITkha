<?php

return [
    'title' => 'Tags',

    'fields' => [
        'id'        => 'ID',
        'title'     => 'Title',
        'count' => 'Tag count',
        'created_at' => 'Created at',
        'posts' => 'Posts',
    ],

    'placeholder' => [
        'title' => 'Enter title',
    ],

    'messages' => [
        'create' => 'Tag ":title" successfully created',
        'edit' => 'Tag ":title" has been updated successfully',
        'delete' => 'Tag ":title" has been successfully deleted',
    ],

    'actions' => [
        'create' => 'Add tag',
        'edit'   => 'Edit tag',
        'delete' => 'Delete tag',
    ],
];
