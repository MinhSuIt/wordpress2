<?php
add_action('wp_enqueue_scripts', function () {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        wp_enqueue_script_module('vite-client', 'http://localhost:5173/@vite/client', [], null);
        wp_enqueue_script_module('vite-app', 'http://localhost:5173/tailwindcss/resources/js/app.js', [], null);
    } else {
        // ===== PROD (build files) =====
        $manifest_path = get_stylesheet_directory() . '/tailwindcss/public/.vite/manifest.json';

        if (!file_exists($manifest_path)) return;

        $manifest = json_decode(file_get_contents($manifest_path), true);

        if (isset($manifest['tailwindcss/resources/css/app.css'])) {
            foreach ($manifest['tailwindcss/resources/css/app.css']['css'] as $css_file) {
                wp_enqueue_style(
                    'tailwindcss-' . $css_file,
                    get_stylesheet_directory_uri() . '/tailwindcss/public/' . $css_file,
                    [],
                    null
                );
            }
        }
        if (isset($manifest['tailwindcss/resources/js/app.js'])) {
            wp_enqueue_script(
                'tailwindcss',
                get_stylesheet_directory_uri() . '/tailwindcss/public/' . $manifest['tailwindcss/resources/js/app.js']['file'],
                [],
                null,
                true
            );
        }
    }
});
