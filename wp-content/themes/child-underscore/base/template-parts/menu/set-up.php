<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php
// Đăng ký menu location, vào menu thêm menu ở vị trí "Menu Header"
function register_my_menus()
{
    register_nav_menus(array(
        'menu-header' => __('Menu Header', 'textdomain')
    ));
}
add_action('init', 'register_my_menus');

// Custom Walker để tạo cấu trúc HTML theo template
class Custom_Nav_Walker extends Walker_Nav_Menu
{

    // Bắt đầu level (ul)
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"submenu\">\n";
    }

    // Kết thúc level (ul)
    function end_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    // Bắt đầu element (li)
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;

        // Class cho li
        if ($depth === 0) {
            $li_class = 'nav-item';
            $link_class = 'nav-link';

            // Kiểm tra có submenu không
            if (in_array('menu-item-has-children', $classes)) {
                $li_class .= ' has-submenu';
            }
        } else {
            $li_class = '';
            $link_class = 'submenu-link';
        }

        $class_names = $li_class ? ' class="' . esc_attr($li_class) . '"' : '';

        $output .= $indent . '<li' . $class_names . '>';

        // Tạo link
        $atts = array();
        $atts['href'] = !empty($item->url) ? $item->url : '';
        $atts['class'] = $link_class;

        if (!empty($item->target)) {
            $atts['target'] = $item->target;
        }

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

// Thêm search form vào cuối menu
function add_search_to_menu($items, $args)
{
    if ($args->theme_location == 'menu-header') {
        $items .= '<li class="nav-item search-item">';
        $items .= '<form class="search-form" method="get" action="' . esc_url(home_url('/')) . '">';
        $items .= '<input type="text" name="s" placeholder="Tìm kiếm..." value="' . get_search_query() . '">';
        $items .= '<button type="submit">🔍</button>';
        $items .= '</form>';
        $items .= '</li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_search_to_menu', 10, 2);
