<?php

return [
    'title' => '',
    'fields' => [],
    'placeholder' => [],

    'sections' => [
        'personal'   => 'Особиста інформація',
        'job_title'  => 'Професійна інформація',
        'social'     => 'Соціальні мережі',
        'security'   => 'Безпека',
    ],

    'buttons' => [
        'submit' => 'Оновити',

        'my_post' => [
            'title'       => 'Мої пости',
            'description' => 'Пости, які ви створили',
        ],

        'liked_post' => [
            'title'       => 'Сподобані пости',
            'description' => 'Список збережених постів',
        ],

        'favorite_post' => [
            'title'       => 'Улюблені пости',
            'description' => 'Список улюблених публікацій',
        ],

        'edit_profile' => [
            'title'       => 'Налаштування профілю',
            'description' => 'Змініть ім’я, прізвище тощо',
        ],
    ],

    'messages' => [
        'update_profile_success'  => 'Ваш профіль успішно оновлено.',
        'update_password_success' => 'Ваш пароль успішно оновлено.',
        'unexpected_error'        => 'Сталася непередбачена помилка. Будь ласка, спробуйте ще раз.',
    ],
];
