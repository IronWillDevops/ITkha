<?php

return [

    // ===== Поля =====
    'fields' => [
        'id'          => 'ID',
        'created_at'  => 'Створено',
        'updated_at'  => 'Оновлено',

        'published_at' => 'Публікувати о',
        'title'       => 'Заголовок',
        'first_name'        => 'Ім’я',
        'last_name'     => 'Прізвище',
        'post'        => 'Пост',
        'email'       => 'Електронна пошта',
        'role'        => 'Роль',
        'category'    => 'Категорія',
        'tag'         => 'Тег',
        'status'      => 'Статус',
        'avatar'      => 'Аватар',
        'content'     => 'Контент',
        'slug'        => 'Слаг',
        'user'        => 'Користувач',
        'author'      => 'Автор',
        'count'       => 'Кількість',
        'ip_address'  => 'IP-адреса',
        'description' => 'Опис',
        'actions'     => 'Дії',
        'icon'        => 'Іконка',
        'url'         => 'URL',
        'search'      => 'Пошук...',
        'model_type'  => 'Тип моделі',
        'model_id'    => 'ID моделі',
        'key' => 'Ключ',
        'version' => 'Версія',
        'is_active' => 'Активна',

        'file' => [
            'name' => 'Файл',
            'size' => 'Розмір',
        ]
    ],

    'placeholder' => [
        'title'   => 'Введіть заголовок',
        'first_name'    => 'Введіть ім’я',
        'last_name' => 'Введіть прізвище',
        'email'   => 'Введіть електронну пошту',
        'content' => 'Введіть контент',
        'description' => 'Введіть опис',
        'key' => 'Введіть ключ',
        'icon'    => 'Наприклад: fa-brands fa-github',
        'url'     => 'Введіть URL',
    ],

    'buttons' => [

        'accept' => 'Прийняти',
        'create'     => 'Створити',
        'edit'       => 'Редагувати',
        'restore'    => 'Відновити',
        'delete'     => 'Видалити',
        'save'       => 'Зберегти',
        'send'       => 'Надіслати',
        'cancel'     => 'Скасувати',
        'close'      => 'Закрити',
        'upload'     => 'Завантажити',
        'read_more'  => 'Читати далі',
        'search'      => 'Шукати',
        'yes' => 'Так',
        'no'  => 'Ні',
    ],

    'messages' => [
        'created'           => 'Успішно створено.',
        'updated'           => 'Успішно оновлено.',
        'deleted'           => 'Успішно видалено.',
        'no_records'        => 'Ще немає записів',
        'no_posts'          => 'Постів немає',
        'confirm_delete'    => 'Ви впевнені, що хочете видалити?',
        'settings_saved'    => 'Налаштування успішно збережено.',
    ],
];
