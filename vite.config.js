import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.css',
                'resources/js/app.js',
                // 'resources/css/app.css',
                // 'resources/js/app.js',
                // 'resources/css/style.min.css',
                // 'resources/js/waves.js',
                // 'resources/js/sidebarmenu.js',
                // 'resources/js/custom.min.js',
                // 'resources/js/pages/chart/chart-page-init.js',
            ],
            refresh: true,
        }),
    ],
});
