import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.jsx', 'resources/css/app.css'],
            refresh: true,
        }),
        react(),
    ],
    server: {
        host: '0.0.0.0', // Permite que Vite sea accesible en la red
        port: 5173,      // Asegúrate de que el puerto coincida
        strictPort: true,
        hmr: {
            host: '127.0.0.1', // Ajusta esto si accedes desde fuera del host local
        },
    },
});