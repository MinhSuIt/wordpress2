<?php

add_action('ux_builder_setup', function () {
  function custom_flatsome_ux_builder_template($path)
  {
    ob_start();
    include get_stylesheet_directory() . '/base/ux-builder/shortcodes/templates/' . $path;
    return ob_get_clean();
  }

  function custom_flatsome_ux_builder_thumbnail($name)
  {
    return get_stylesheet_directory_uri() . '/base/ux-builder/shortcodes/thumbnails/' . $name . '.svg';
  }

  function custom_flatsome_ux_builder_template_thumb($name)
  {
    return get_stylesheet_directory_uri() . '/base/ux-builder/templates/thumbs/' . $name . '.jpg';
  }
  require_once get_stylesheet_directory() . '/base/shortcodes/custom_section.php';
  require_once __DIR__ . '/custom_section.php';
});
