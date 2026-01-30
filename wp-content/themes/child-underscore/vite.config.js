import { defineConfig } from 'vite'
import FullReload from 'vite-plugin-full-reload'
export default defineConfig(({ command }) => ({
    plugins: [FullReload(['./**/*.php'])],
    base: command === 'build' ? '/wp-content/themes/child-underscore/base/tailwindcss/public/' : '/',
    build: {
        outDir: 'base/tailwindcss/public',
        manifest: true,
        emptyOutDir: true,
        rollupOptions: {
            input: {
                app: 'base/tailwindcss/resources/js/app.js',
                style: 'base/tailwindcss/resources/css/app.css',
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