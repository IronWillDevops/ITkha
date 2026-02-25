<?php

return [
    'title' => '',
    'fields' => [
        'current_session' => 'Current session',
        'last_activity'   => 'Last activity',
    ],
    'placeholder' => [],

    'sections' => [
        'personal' => 'Personal Information',
        'job_title' => 'Professional Information',
        'social' => 'Social Networks',
        'security' => 'Security',
        'sessions' => 'Sessions',
    ],

    'general' => [
        'no_information' => 'No information available',
    ],

    'buttons' => [
        'submit' => 'Update',
        'my_post' => [
            'title' => 'My Posts',
            'description' => 'Posts you have created',
        ],
        'liked_post' => [
            'title' => 'Liked Posts',
            'description' => 'List of saved posts',
        ],
        'favorite_post' => [
            'title' => 'Favorite Posts',
            'description' => 'List of favorite publications',
        ],
        'edit_profile' => [
            'title' => 'Profile Settings',
            'description' => 'Change first name, last name etc.',
        ],

        'logout'                => 'Logout',
    ],
    'messages' => [
        'update_profile_success' => 'Your profile has been updated successfully.',
        'update_password_success' => 'Your password has been updated successfully.',
        'unexpected_error' => 'An unexpected error occurred. Please try again.',
        'session_terminated'        => 'Session terminated.',
        'logged_out_session_deleted' => 'You have been logged out because your session was terminated.',

    ],
];
