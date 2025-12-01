<?php

return [
    'title' => 'Telegram',
    'fields' => [
        'enabled'             => 'Увімкнути публікацію в Telegram',
        'token'               => 'Токен бота',
        'chatid'              => 'ID чату',
        'send_without_sound'  => 'Надіслати без звуку',
        'template'            => 'Шаблон повідомлення',
        'message_limit'       => 'Обмеження символів у повідомленні',
        'button_text'         => 'Текст кнопки',
    ],
    'placeholder' => [
        'token'         => 'Введіть токен вашого Telegram Bot API (наприклад, 1234567890:AAH1aBcD2EfG3...)',
        'chatid'        => 'Введіть ID чату або каналу Telegram (наприклад, -1009876543210)',
        'template'      => 'Введіть шаблон повідомлення',
        'message_limit' => 'Введіть максимальну кількість символів',
        'button_text'   => 'Введіть текст кнопки',
    ],
];
