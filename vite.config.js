import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/public/app.js',
                'resources/js/admin/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
