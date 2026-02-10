<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<?php
function ux_items_movies_by_category_shortcode()
{
    $categories = get_categories(array(
        'taxonomy'   => 'danh_muc',
        'hide_empty' => false,
    ));

    $category_options = array();
    if (!empty($categories)) {
        foreach ($categories as $cat) {
            $category_options[$cat->term_id] = $cat->name;
        }
    }

    add_ux_builder_shortcode('movie_project_items_movies_by_category_shortcode', array(
        'name'      => __('MS - Movie by category'),
        'category'  => __('Content'),
        'priority'  => 1,
        'options' => array(
            'category_movie' => array(
                'type'    => 'select',
                'heading' => __('Chọn Category'),
                'options' => $category_options,
            ),
            'class' => array(
                'type'    => 'textfield',
                'heading' => __('Class'),
                'default' => '',
            ),
        ),
    ));
}