<?php

return [
    'title' => 'Backup Management',

    'fields' => [
        'backup_file' => 'Backup File',
    ],

    'list' => [
        'title' => 'Available Backups',
        'empty' => 'No backups available',
        'empty_description' => 'Create your first backup to get started',
    ],

    'sections' => [
        'upload' => 'Upload Backup',
    ],

    'upload' => [
        'help' => 'Maximum file size: 500 MB. Only ZIP archives with database.sql file are supported',
        'confirm' => 'Are you sure you want to upload this backup file?',
        'processing' => 'Uploading and validating file...',
    ],

    'messages' => [
        'created' => 'Backup successfully created',
        'restored' => 'Backup ":filename" has been restored successfully',
        'deleted' => 'Backup ":filename" has been successfully deleted',
        'uploaded' => 'Backup has been successfully uploaded',
    ],

    'confirm' => [
        'restore' => 'Are you sure you want to restore this backup? This action will replace all current data!',
        'delete' => 'Are you sure you want to delete this backup?',
    ],

];
