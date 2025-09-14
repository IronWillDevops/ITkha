import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/public/app.css',
                'resources/js/public/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
