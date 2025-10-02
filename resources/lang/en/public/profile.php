<?php

return [

    'submit' => 'Update',
    'actions' => [
        'my_posts' => [
            'title' => 'My Posts',
            'description' => 'Posts you have created',
        ],
        'liked_posts' => [
            'title' => 'Liked Posts',
            'description' => 'List of saved posts',
        ],
        'favorite_posts' => [
            'title' => 'Favorite Posts',
            'description' => 'List of favorite publications',
        ],
        'edit_profile' => [
            'title' => 'Profile Settings',
            'description' => 'Change name, surname etc.',
        ],
    ],


    'sections' => [
        'personal' => 'Personal Information',
        'job_title' => 'Professional Information',
        'social' => 'Social Networks',
        'security' => 'Security',
    ],

    'messages' => [
        'update_profile_success' => 'Your profile has been updated successfully.',
        'update_password_success' => 'Your password has been updated successfully.',
        'unexpected_error' => 'An unexpected error occurred. Please try again.',
    ],


];
