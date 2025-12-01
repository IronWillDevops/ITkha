<?php
return [
    'title' => 'Користувач',

    'fields' => [
        'login'        => 'Логін',
        'password'     => 'Пароль',
        'verified'     => 'Підтверджено',
        'address'      => 'Адреса',
        'job_title'    => 'Посада',
        'website'      => 'Вебсайт',
        'about_myself' => 'Про мене',
        'github'       => 'GitHub',
        'linkedin'     => 'LinkedIn',
    ],

    'placeholder' => [
        'login'        => 'Введіть логін',
        'password'     => 'Введіть пароль',
        'address'      => 'Введіть адресу',
        'job_title'    => 'Введіть посаду',
        'website'      => 'Введіть вебсайт',
        'about_myself' => 'Введіть інформацію про себе',
        'github'       => 'Введіть посилання на GitHub',
        'linkedin'     => 'Введіть посилання на LinkedIn',
    ],

    'sections' => [
        'personal' => 'Особиста інформація',
        'job'      => 'Професійна інформація',
        'social'   => 'Соціальні мережі',
        'setting'  => 'Налаштування',
        'security' => 'Безпека',
    ],

    'messages' => [
        'created'      => 'Користувача ":login" успішно створено',
        'updated'      => 'Користувача ":login" успішно оновлено',
        'deleted'      => 'Користувача ":login" успішно видалено',
        'verified'     => 'Підтверджено',
        'not_verified' => 'Не підтверджено',
    ],
];
