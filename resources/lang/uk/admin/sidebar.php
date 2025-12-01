<?php
return [
    'dashboard' => [
        'title' => 'Панель керування',
    ],

    'post' => [
        'title' => 'Пости',
        'post' => [
            'title' => 'Пости',
        ],
        'category' => [
            'title' => 'Категорії',
        ],
        'tag' => [
            'title' => 'Теги',
        ],
        'comment' => [
            'title' => 'Коментарі',
        ],
    ],

    'user' => [
        'title' => 'Користувачі',
        'user' => [
            'title' => 'Користувачі',
        ],
        'role' => [
            'title' => 'Ролі',
        ],
    ],

    'contact' => [
        'title' => 'Контакти',
    ],
    
    'setting' => [
        'title' => 'Налаштування',
        'sections' => [
            'main' => [
                'title' => 'Основні',
                'entities' => [
                    'general' => ['title' => 'Загальні'],
                    'user'    => ['title' => 'Користувачі'],
                    'comment' => ['title' => 'Коментарі'],
                ],
            ],
            'additional' => [
                'title' => 'Додаткові',
                'entities' => [
                    'footerlink' => ['title' => 'Посилання в футері'],
                    'info'       => ['title' => 'Інформація'],
                    'log'        => ['title' => 'Логи'],
                ],
            ],
            'integrations' => [
                'title' => 'Інтеграції',
                'entities' => [
                    'telegram' => ['title' => 'Telegram'],
                ],
            ],
        ],
    ],

    'icon' => [
        'title' => 'Іконки',
    ],
];
