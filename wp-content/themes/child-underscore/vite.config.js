import { defineConfig } from 'vite'
import FullReload from 'vite-plugin-full-reload'
export default defineConfig(({ command }) => ({
    plugins: [FullReload(['./**/*.php'])],
    base: command === 'build' ? '/wp-content/themes/child-underscore/tailwindcss/public/' : '/',
    build: {
        outDir: 'tailwindcss/public',
        manifest: true,
        emptyOutDir: true,
        rollupOptions: {
            input: {
                app: 'tailwindcss/resources/js/app.js',
                style: 'tailwindcss/resources/css/app.css',
            },
        }
    }, server: {
        host: 'localhost',
        port: 5173,
        strictPort: true,
        cors: true,
        hmr: { host: 'localhost' }
    }
}))