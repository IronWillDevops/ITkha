<?php
return [
    'title' => 'User',

    'fields' => [
        'login' => 'Login',
        'password' => 'Password',
        'verified' => 'Verified',
        'address' => 'Address',
        'job_title' => 'Job title',
        'website' => 'Website',
        'about_myself' => 'About Me',
        'github' => 'GitHub',
        'linkedin' => 'LinkedIn',
    ],

    'placeholder' => [
        'login' => 'Enter your login',
        'password' => 'Enter your password',
        'address' => 'Enter your address',
        
        'job_title' => 'Enter your job title',
        'website' => 'Enter your website',
        'about_myself' => 'Enter information about yourself',
        'github' => 'Enter link to your GitHub profile',
        'linkedin' => 'Enter link to your LinkedIn profile',

    ],

    'sections' => [
        'personal' => 'Personal Information',
        'job' => 'Professional Information',
        'social' => 'Social Networks',
        'setting' => 'Settings',
        'security' => 'Security',
    ],

    'messages' => [
        'created' => 'User ":login" successfully created',
        'updated' => 'User ":login" has been updated successfully',
        'deleted' => 'User ":login" has been successfully deleted',

        'verified' => "Verified",
        'not_verified' => 'Not verified',
    ],
];
