import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'node_modules/admin-lte/plugins/jquery/jquery.min.js',
                'node_modules/admin-lte/plugins/select2/js/select2.full.min.js',
                'node_modules/bs-stepper/dist/css/bs-stepper.min.css',
                'node_modules/admin-lte/plugins/select2/css/select2.min.css',
                'node_modules/admin-lte/plugins/select2/js/select2.full.min.js',
                'node_modules/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
                'node_modules/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
                'node_modules/admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'
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
    build: {
        commonjsOptions: {
            include: [],
        },
    }
});