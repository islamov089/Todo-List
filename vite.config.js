import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/sass/app.scss', 'resources/js/app.js'],
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
      scss: {
        // additionalData: `@import '@/sass/variables.scss';`
      },
    },
  },
})
