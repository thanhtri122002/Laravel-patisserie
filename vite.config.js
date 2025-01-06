import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/app.scss', 'resources/js/app.js', 'resources/scss/app.scss'],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build', // Ensure the output is set to public/build
    },
});
