// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    vue(),
  ],
  resolve: {
    alias: {
      '@': '/resources/js',
    },
  },
  optimizeDeps: {
    include: ['datatables.net', 'datatables.net-vue3', 'datatables.net-dt'],
  },
  css: {
    preprocessorOptions: {
    },
  },
});
