import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { esbuildCommonjs } from '@originjs/vite-plugin-commonjs';
import fse from 'fs-extra';
import vue from '@vitejs/plugin-vue'
import path from 'path';

export default defineConfig({
  build: {
    outDir: '../../public/build-admin',
    emptyOutDir: true,
    manifest: true,
  },
  plugins: [
    vue(),
    laravel({
      publicDirectory: '../../public',
      buildDirectory: 'build-admin',
      input: [
        './Resources/assets/css/app.css',
        './Resources/assets/js/app.js'
      ],
      resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '@': '/resources/js',
        }
    },
      refresh: true,
    }),
    esbuildCommonjs(['jquery','jquery-ui-dist/jquery-ui']),
    {
      name: 'copy-assets',
      async writeBundle() {
        await fse.copy('./Resources/assets', '../../public/build-admin', {
          overwrite: true,
          errorOnExist: false,
          dereference: true,
          preserveTimestamps: true,
        });
      }
    }
  ]
});
