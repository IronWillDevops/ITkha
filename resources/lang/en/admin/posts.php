<?php

return [
    'title' => 'Posts',

    'fields' => [
        'id' => 'ID',
        'title' => 'Title',
        'main_image' => 'Main image',
        'categories' => 'Categories',
        'content' => 'Content',
        'tags' => 'Tags',
        'status' => 'Status',
        'created_at' => 'Created at',
        'author' => 'Author',
        'comments_enabled' => 'Comments enabled',
    ],

    'placeholder' => [
        'title' => 'Enter title',
        'content' => 'Enter content',
    ],
    'messages' => [
        'create' => 'Post ":title" successfully created',
        'edit' => 'Post ":title" has been updated successfully',
        'delete' => 'Post ":title" has been successfully deleted',
        'no_posts'     => 'No posts',
    ],

    'actions' => [
        'create' => 'Add post',
        'edit' => 'Edit post',
        'delete' => 'Delete post',
    ],
];
