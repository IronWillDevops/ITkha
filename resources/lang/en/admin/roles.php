<?php

return [
    'title' => 'Roles',

    'fields' => [
        'id'        => 'ID',
        'title'     => 'Title',
        'users' => 'Users',
        'count' => 'User count',
        'created_at' => 'Created at',
    ],

    'messages' => [
        'create' => 'Role ":title" successfully created',
        'edit' => 'Role ":title" has been updated successfully',
        'delete' => 'Role ":title" has been successfully deleted',
    ],

    'actions' => [
        'create' => 'Add role',
        'edit' => 'Edit role',
        'delete' => 'Delete role',
    ],
];
