<?php

return [
    'title' => 'Categories',

    'fields' => [
        'id'        => 'ID',
        'title'     => 'Title',
        'count'      => 'Post count',
        'created_at' => 'Created at',
        'posts' => "Posts",
    ],

    'placeholder' => [
        'title' => 'Enter title',
    ],

    'messages' => [
        'create' => 'Category ":title" successfully created',
        'edit' => 'Category ":title" has been updated successfully',
        'delete' => 'Category ":title" has been successfully deleted',
    ],

    'actions' => [
        'create' => 'Add category',
        'edit' => 'Edit category',
        'delete' => 'Delete category',
    ],
];
