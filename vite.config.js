import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import commonjs from '@rollup/plugin-commonjs';
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'node_modules/bs-stepper/dist/css/bs-stepper.min.css',
                'node_modules/admin-lte/plugins/select2/css/select2.min.css',
                'node_modules/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
                'node_modules/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
                'node_modules/admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css',
                'node_modules/admin-lte/plugins/jquery/jquery.min.js',
                'node_modules/bs-stepper/dist/js/bs-stepper.min.js',
                'node_modules/admin-lte/plugins/select2/js/select2.full.min.js',
                'node_modules/admin-lte/plugins/datatables/jquery.dataTables.min.js',
                'node_modules/admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js',
                'node_modules/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        commonjs()
    ],
    resolve: {
        alias: [
            {
                // this is required for the SCSS modules
                find: /^~(.*)$/,
                $:'JQuery',
                replacement: '$1',
            },
        ],
    },
    build: {
        commonjsOptions: {
            include: [
                'resources/sass/app.scss',
                'node_modules/bs-stepper/dist/css/bs-stepper.min.css',
                'node_modules/admin-lte/plugins/select2/css/select2.min.css',
                'node_modules/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
                'node_modules/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
                'node_modules/admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css',
                'node_modules/admin-lte/plugins/jquery/jquery.min.js',
                'node_modules/bs-stepper/dist/js/bs-stepper.min.js',
                'node_modules/admin-lte/plugins/select2/js/select2.full.min.js',
                'node_modules/admin-lte/plugins/datatables/jquery.dataTables.min.js',
                'node_modules/admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js',
                'node_modules/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
                'resources/js/app.js',
            ],
        },
    }
});