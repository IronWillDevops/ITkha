<?php

return [
    'title' => 'Пости',

    'fields' => [
        'id' => 'ID',
        'title' => 'Назва',
        'main_image' => 'Головне зображення',
        'categories' => 'Категорії',
        'content' => 'Зміст',
        'tags' => 'Теги',
        'status' => 'Статус',
        'created_at' => 'Створено',
        'author' => 'Автор',
        'comments_enabled' => 'Коментарі увімкнено',
    ],

    'placeholder' => [
        'title' => 'Введіть заголовок',
        'content' => 'Введіть контент',
    ],

    'messages' => [
        'create'   => 'Публікацію ":title" успішно створено',
        'edit'     => 'Публікацію ":title" успішно оновлено',
        'delete'   => 'Публікацію ":title" успішно видалено',
        'no_posts' => 'Немає публікацій',
    ],

    'actions' => [
        'create' => 'Додати пост',
        'edit' => 'Редагувати пост',
        'delete' => 'Видалити пост',

    ],
];
