<?php

return [

    'required'  => 'The :attribute field is required.',
    'string'    => 'The :attribute must be a valid string.',
    'email'     => 'The :attribute must be a valid email address.',
    'url'       => 'The :attribute format is invalid.',
    'regex'     => 'The :attribute format is invalid.',
    'boolean'   => 'The :attribute field must be true or false.',
    'array'     => 'The :attribute must be an array.',
    'integer'   => 'The :attribute must be an integer.',
    'exists'    => 'The selected :attribute does not exist.',
    'unique'    => 'The :attribute has already been taken.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'in'        => 'The selected :attribute is invalid.',
    'file'      => 'The :attribute must be a valid file.',
    'mimes'     => 'The :attribute must be a file of type: :values.',
    'incorrect' => 'The entered :attribute is incorrect.',

    'max' => [
        'string' => 'The :attribute may not be greater than :max characters.',
        'file'   => 'The :attribute may not be greater than :max kilobytes.',
    ],

    'min' => [
        'string' => 'The :attribute must be at least :min characters.',
    ],

    'custom' => [

        'name' => [
            'regex' => 'The :attribute may contain only English letters.',
        ],

        'surname' => [
            'regex' => 'The :attribute may contain only English letters.',
        ],

        'login' => [
            'regex' => 'The :attribute may contain only English letters, numbers, and underscores.',
        ],

        'password' => [
            'letters'           => 'The :attribute must contain at least one letter.',
            'mixed'             => 'The :attribute must include both uppercase and lowercase letters.',
            'numbers'           => 'The :attribute must contain at least one number.',
            'symbols'           => 'The :attribute must contain at least one special character.',
            'uncompromised'     => 'The provided :attribute appears in a data leak. Please choose a different one.',
            'current_password'  => 'The current password you entered is incorrect.',
        ],

        'captcha' => [
            'incorrect' => 'The entered :attribute is incorrect.',
        ],

        'avatar' => [
            'image' => 'The :attribute must be an image (jpg, jpeg, png, webp).',
        ],

        'github' => [
            'incorrect' => 'The entered :attribute is not a valid GitHub profile URL.',
        ],

        'linkedin' => [
            'incorrect' => 'The entered :attribute is not a valid LinkedIn profile URL.',
        ],

        'website' => [
            'incorrect' => 'The entered :attribute is not a valid public URL.',
        ],

    ],

    'attributes' => [
        'name'          => 'name',
        'surname'       => 'surname',
        'login'         => 'login',
        'email'         => 'email',
        'password'      => 'password',
        'avatar'        => 'avatar',

        'title'         => 'title',
        'content'       => 'content',
        'main_image'    => 'main image',
        'status'        => 'status',

        'user_id'       => 'user',
        'category_id'   => 'category',
        'tag_ids'       => 'tags',
        'permissions'   => 'permissions',

        'website'       => 'website',
        'github'        => 'GitHub profile',
        'linkedin'      => 'LinkedIn profile',

        'telegram_template' => 'Telegram template',
        'telegram_button_text' => 'Telegram button text',
        'telegram_message_limit' => 'Telegram message limit',
    ],
];
