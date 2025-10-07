<?php

return [
    'title' => 'Comments',

    'fields' => [
        'id'        => 'ID',
        'body'     => 'Body',
        'author' => 'Author',
        'post' => 'Post',

        'status' => 'Status',
        'created_at' => 'Created at',
    ],

    'messages' => [
        'edit' => 'Comment ":body" has been updated successfully',
        'delete' => 'Comment ":body" has been successfully deleted',
    ],

    'actions' => [
        
        'edit'   => 'Edit comment',
        'delete' => 'Delete comment',
    ],
];
