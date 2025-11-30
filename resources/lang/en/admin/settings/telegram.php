<?php

return [
    'title' => 'Telegram',
    'fields' => [
        'enabled' => 'Enable Telegram posting',
        'token' => "Bot Token",
        'chatid' => 'Chat ID',
        'send_without_sound' => 'Send without sound',
        'template' => 'Message template',
        'message_limit' => 'Message character limit',
        'button_text' => 'Button text',


    ],
    'placeholder' => [
        'token' => "Enter your Telegram Bot API token (e.g. 1234567890:AAH1aBcD2EfG3...)",
        'chatid' => 'Enter the Telegram chat or channel ID (e.g. -1009876543210)',
        'template' => 'Enter the message template',
        'message_limit' => 'Enter the maximum number of characters',
        'button_text' => 'Enter the button text',
    ],
];
