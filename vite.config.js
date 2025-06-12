import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        outDir: 'public/build',
        assetsDir: 'assets', // asegúrate de que los CSS/JS se coloquen aquí
        rollupOptions: {
            input: ['resources/css/app.css', 'resources/js/app.js'],
        },
        emptyOutDir: true,
    },
});
