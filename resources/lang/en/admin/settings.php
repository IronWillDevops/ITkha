<?php

return [
    'title' => 'Settings',
    'section' => [
        'main' => 'Main',
        'additional' => 'Additional',
        'integrations' => 'Integrations',
    ],
    'updated' => 'Settings saved',
    'comments' => [
        'title' => 'Comment Settings',
        'enabled' => 'Allow comments under posts',
        'auto_approve' => 'Automatically approve comments',
        'filter_words' => 'Blocked words',
        'filter_words_hint' => 'Enter words to block, separated by commas (e.g., spam, casino, viagra).',
        'links_policy' => 'Links policy for comments',
        'links_allow' => 'Allow links',
        'links_remove' => 'Remove links',
        'links_reject' => 'Reject comments containing links',
        'comment_cannot_be_empty' => 'Comment cannot be empty.',
    ],
    'users' => [
        'title' => 'User settings',
        'default_status' => 'Default Status',
        'default_role' => 'Default Role',
        'require_email_verification' => 'Require Email Verification',
    ],
    'site' => [
        'title' => 'General Settings',
        'name' => 'Site Name',
        'description' => 'Site Description',
        'keywords' => 'Meta Keywords',
        'favicon' => 'Favicon',

        'placeholders' => [
            'name' => 'Enter your website name (e.g., My Company)',
            'description' => 'Briefly describe your website purpose or content',
            'keywords' => 'Enter meta keywords separated by commas (e.g., blog, tech, news)',
            'favicon' => 'Upload a small icon (16x16 or 32x32)',
            'timezone' => 'Select your site timezone (e.g., Europe/Kyiv)',
        ],
    ],
    'telegram' => [
        'title' => 'Telegram',
        'enabled' => 'Enable Telegram posting',
        'token' => "Bot Token",
        'chatid' => 'Chat ID',
        'send_without_sound' => 'Send without sound',
        'placeholder' => [
            'token' => "Enter your Telegram Bot API token (e.g. 1234567890:AAH1aBcD2EfG3...)",
            'chatid' => 'Enter the Telegram chat or channel ID (e.g. -1009876543210)',
        ]
    ],
];
