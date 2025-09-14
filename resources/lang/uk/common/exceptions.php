<?php

return [
    'category' => [
        'CannotDeleteCategoryWithPostsException' => 'Неможливо видалити категорію, поки в ній є пости.',
        'CannotDeleteLastCategoryException' => 'Видалення останньої категорії заборонено.',
    ],
    'role' => [
        'CannotDeleteProtectedRoleException' => 'Видалення системних ролей заборонено.',
        'CannotUpdateProtectedRoleException' => 'Редагування системних ролей заборонено.',
    ],
    'user' => [
        'CannotDeactivateLastActiveUserException' => 'Неможливо деактивувати останнього активного користувача.',
        'CannotDeleteAdminUserException' => 'Видалення користувача з цього облікового запису заборонено.',
        'CannotDeleteSelfException' => 'Видалення власного облікового запису заборонено.',
        'EmailNotVerifiedException' => 'Адресу електронної пошти не підтверджено.',
    ],

];
