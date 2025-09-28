<?php

return [
    'title' => 'Теги',

    'fields' => [
        'id'         => 'ID',
        'title'      => 'Назва',
        'count'      => 'Кількість тегів',
        'created_at' => 'Створено',
        'posts' => 'Публікації',
    ],

    'placeholder' => [
        'title' => 'Введіть заголовок',
    ],

    'messages' => [
        'create' => 'Тег ":title" успішно створено',
        'edit'   => 'Тег ":title" успішно оновлено',
        'delete' => 'Тег ":title" успішно видалено',
    ],

    'actions' => [
        'create' => 'Додати тег',
        'edit'   => 'Редагувати тег',
        'delete' => 'Видалити тег',
    ],
];
