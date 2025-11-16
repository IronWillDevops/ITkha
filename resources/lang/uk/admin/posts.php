<?php

return [
    'title' => 'Публікації',

    'fields' => [
        'id' => 'ID',
        'slug' => 'Slug',
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
        'slug' => 'Введіть слаг (наприклад my-first-post)',
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
