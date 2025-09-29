<?php

return [
    'title' => 'Users',

    'fields' => [
        'id'        => 'ID',
        'avatar' => 'Avatar',
        'name'     => 'Name',
        'surname'     => 'Surname',
        'login'     => 'Login',
        'email'     => 'Email',
        'password' => 'Password',
        'role'     => 'Role',
        'status'     => 'Status',
        'verified' => 'Verified',
        'count'      => 'Post count',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
    ],

    'placeholder' => [
        'name' => 'Enter your first name',
        'surname' => 'Enter your last name',
        'login' => 'Enter your login',
        'email' => 'Enter your email address',
        'password' => 'Enter your password',

        'job_title' => 'Enter your job title',
        'address' => 'Enter your address',
        'website' => 'Enter a link to your social media profile',

        'about_myself' => 'About myself',

        'github' => 'Enter your GitHub link',
        'linkedin' => 'Enter your LinkedIn link',
    ],

    'messages' => [
        'create' => 'User ":login" successfully created',
        'edit' => 'User ":login" has been updated successfully',
        'delete' => 'User ":login" has been successfully deleted',

        'verified' => "Verified",
        'not_verified' => 'Not verified',
    ],

    'actions' => [
        'create' => 'Add user',
        'edit' => 'Edit user',
        'delete' => 'Delete user',
    ],


];
