<?php
return [
    'dashboard' => [
        'title' => 'Dashboard',
    ],

    'post' => [
        'title' => 'Posts',
        'post' => [
            'title' => 'Posts',
        ],
        'category' => [
            'title' => 'Categories',
        ],
        'tag' => [
            'title' => 'Tags',
        ],
        'comment' => [
            'title' => 'Comments',
        ],
    ],

    'user' => [
        'title' => 'Users',
        'user' => [
            'title' => 'Users',
        ],
        'role' => [
            'title' => 'Roles',
        ],
    ],

    'contact' => [
        'title' => 'Contacts',
    ],

    'setting' => [
        'title' => 'Settings',
        'sections' => [
            'main' => [
                'title' => 'Main',
                'entities' => [
                    'general'    => ['title' => 'General'],
                    'user'    => ['title' => 'Users'],
                    'comment' => ['title' => 'Comments'],
                    'backup'  => ['title' => 'Backup Management'],
                ],
            ],
            'additional' => [
                'title' => 'Additional',
                'entities' => [
                    'policy' => ['title' => 'Policy'],
                    'footerlink' => ['title' => 'Footer link'],
                    'info'       => ['title' => 'Info'],
                    'log'        => ['title' => 'Logs'],
                ],
            ],
            'integrations' => [
                'title' => 'Integrations',
                'entities' => [
                    'telegram' => ['title' => 'Telegram'],
                ],
            ],
        ],
    ],

    'icon' => [
        'title' => 'Icons',
    ],
];
