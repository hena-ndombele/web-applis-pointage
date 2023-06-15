import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js',
            'node_modules/bs-stepper/dist/js/bs-stepper.min.js',
            'node_modules/bs-stepper/dist/css/bs-stepper.min.css',
            'node_modules/admin-lte/plugins/select2/css/select2.min.css',
            'node_modules/admin-lte/plugins/select2/js/select2.full.min.js',
        ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: [
            {
                // this is required for the SCSS modules
                find: /^~(.*)$/,
                replacement: '$1',
            },
        ],
    },
});
