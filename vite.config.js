import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [vue()],
    server: {
        host: 'node',
        port: 5174,
    },
    build: {
        outDir: 'public',
    },
    resolve: {
        alias: {
            '@': '/var/www/html/resources/js',
        },
    },
    optimizeDeps: {
        include: ['vue', 'vue-router'], 
    },
});
