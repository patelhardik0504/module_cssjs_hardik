const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    build: {
        outDir: '../../public/build-providers',
        emptyOutDir: true,
        manifest: true,
    },
    plugins: [
        vue(),
        laravel({
            publicDirectory: '../../public',
            buildDirectory: 'build-providers',
            input: [
                __dirname + '/Resources/assets/css/app.css',
                __dirname + '/Resources/assets/js/app.js'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': __dirname + '/Resources/assets/js',
            'vue': 'vue/dist/vue.esm-bundler.js'
        },
    },
});
