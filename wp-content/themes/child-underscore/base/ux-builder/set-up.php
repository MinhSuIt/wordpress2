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
});
require_files('/base/ux-builder/');

$ux_files = file_list_in_directory(get_stylesheet_directory() . '/base/ux-builder/');
$ux_files = array_filter($ux_files, function ($file) {
  return strpos($file, 'set-up.php') === false;
});
foreach ($ux_files as $file) {
  $file_name = str_replace(".php", "", $file);
  // var_dump($file_name);
  add_action('ux_builder_setup', $file_name);
}
