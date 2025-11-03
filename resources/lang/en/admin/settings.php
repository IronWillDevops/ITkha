<?php

return [
    'title' => 'Settings',
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
        'timezone' => 'Timezone',

        'placeholders' => [
            'name' => 'Enter your website name (e.g., My Company)',
            'description' => 'Briefly describe your website purpose or content',
            'keywords' => 'Enter meta keywords separated by commas (e.g., blog, tech, news)',
            'favicon' => 'Upload a small icon (16x16 or 32x32)',
            'timezone' => 'Select your site timezone (e.g., Europe/Kyiv)',
        ],
    ],
];
