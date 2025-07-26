<?php

return [
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
        'job' => 'Professional Information',
        'social' => 'Social Networks',
        'security' => 'Security',
    ],

    'common' => [
        'name' => 'First Name',
        'surname' => 'Last Name',
        'avatar' => 'Profile Photo',
        'address' => 'Address',
        'submit' => 'Update',
    ],

    'job' => [
        'title' => 'Job Title',
        'about' => 'About Me',
        'website' => 'Website',
    ],

    'security' => [
        'current_password' => 'Current password',
        'password_new' => 'New password',
        'password_confirmation' => 'Password confirmation',

    ],

    'placeholder' => [
        'name' => 'Enter your first name',
        'surname' => 'Enter your last name',
        'job_title' => 'Your job title',
        'address' => 'Your location',
        'about_myself' => 'Write a few words about yourself...',
        'current_password' => 'Enter your current password',
        'password_new' => 'Enter your new password',
        'password_confirmation' => 'Repeat your new password',
    ],
    'message' => [
        'success' => [
            'update_password' => 'Password changed successfully.',
            'update_profile' => 'Profile successfully updated',
        ],
    ],
];
