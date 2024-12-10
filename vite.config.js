// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css','resources/js/app.jsx'], // Ensure this points to your main JavaScript entry file
            refresh: true,
        }),
        react(), // This should handle JSX correctly
    ],
    server: {
        host: '127.0.0.1', // or specific IP if needed
        port: 5173, // Ensure port matches
        strictPort: true,
      },
    resolve: {
        alias: {
            '@': '/resources/js', // Optional: Adjust according to your directory structure
        },
    },
});