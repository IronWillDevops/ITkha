import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/public/app.css',
                'resources/js/public/app.js',
'resources/js/public/togglePasswordVisibility.js',
                'resources/js/public/like.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
