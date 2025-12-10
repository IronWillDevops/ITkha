<?php

return [

    'required'  => 'Поле :attribute обов’язкове для заповнення.',
    'string'    => 'Поле :attribute повинно бути рядком.',
    'email'     => 'Поле :attribute повинно бути дійсною електронною адресою.',
    'url'       => 'Формат поля :attribute недійсний.',
    'regex'     => 'Формат поля :attribute недійсний.',
    'boolean'   => 'Поле :attribute повинно бути true або false.',
    'array'     => 'Поле :attribute повинно бути масивом.',
    'integer'   => 'Поле :attribute повинно бути цілим числом.',
    'exists'    => 'Вибране :attribute не існує.',
    'unique'    => ':attribute вже зайнято.',
    'confirmed' => 'Підтвердження :attribute не збігається.',
    'in'        => 'Вибране :attribute недійсне.',
    'file'      => 'Поле :attribute повинно бути файлом.',
    'mimes'     => 'Поле :attribute повинно бути файлом типу: :values.',
    'incorrect' => 'Введене :attribute некоректне.',
    'after'     => 'Поле :attribute повинно бути датою після :date.',
    'after_now' => 'Поле :attribute повинно бути датою в майбутньому.',

    'max' => [
        'string' => 'Поле :attribute не може містити більше ніж :max символів.',
        'file'   => 'Поле :attribute не може перевищувати :max кілобайт.',
    ],

    'min' => [
        'string' => 'Поле :attribute повинно містити щонайменше :min символів.',
    ],

    'custom' => [

        'fisrt_name' => [
            'regex' => 'Поле :attribute може містити лише літери англійського алфавіту.',
        ],

        'last_name' => [
            'regex' => 'Поле :attribute може містити лише літери англійського алфавіту.',
        ],

        'login' => [
            'regex' => 'Поле :attribute може містити лише літери англійського алфавіту, цифри та підкреслення.',
        ],

        'password' => [
            'letters'           => 'Поле :attribute повинно містити принаймні одну літеру.',
            'mixed'             => 'Поле :attribute повинно містити великі та малі літери.',
            'numbers'           => 'Поле :attribute повинно містити принаймні одну цифру.',
            'symbols'           => 'Поле :attribute повинно містити принаймні один спеціальний символ.',
            'uncompromised'     => 'Введене :attribute потрапило до витоку даних. Будь ласка, оберіть інший.',
            'current_password'  => 'Введений поточний пароль некоректний.',
        ],

        'captcha' => [
            'incorrect' => 'Введене :attribute некоректне.',
        ],

        'avatar' => [
            'image' => 'Поле :attribute повинно бути зображенням (jpg, jpeg, png, webp).',
        ],

        'github' => [
            'incorrect' => 'Введене :attribute не є дійсним профілем GitHub.',
        ],

        'linkedin' => [
            'incorrect' => 'Введене :attribute не є дійсним профілем LinkedIn.',
        ],

        'website' => [
            'incorrect' => 'Введене :attribute не є дійсним публічним URL.',
        ],

    ],

    'attributes' => [
        'first_name'          => 'ім’я',
        'last_name'       => 'прізвище',
        'login'         => 'логін',
        'email'         => 'електронна адреса',
        'password'      => 'пароль',
        'avatar'        => 'аватар',

        'title'         => 'назва',
        'content'       => 'контент',
        'main_image'    => 'головне зображення',
        'status'        => 'статус',
        'published_at'  => 'дата публікації',

        'user_id'       => 'користувач',
        'category_id'   => 'категорія',
        'tag_ids'       => 'теги',
        'permissions'   => 'дозволи',

        'website'       => 'вебсайт',
        'github'        => 'профіль GitHub',
        'linkedin'      => 'профіль LinkedIn',

        'telegram_template' => 'шаблон Telegram',
        'telegram_button_text' => 'текст кнопки Telegram',
        'telegram_message_limit' => 'обмеження повідомлень Telegram',
    ],
];
