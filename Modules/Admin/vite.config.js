import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { esbuildCommonjs } from '@originjs/vite-plugin-commonjs';
import fse from 'fs-extra';

export default defineConfig({
  build: {
    outDir: '../../public/build-admin',
    emptyOutDir: true,
    manifest: true,
  },
  plugins: [
    laravel({
      publicDirectory: '../../public',
      buildDirectory: 'build-admin',
      input: [
        './Resources/assets/sass/app.scss',
        './Resources/assets/js/app.js'
      ],
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
