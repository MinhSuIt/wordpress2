<?php
// Ngăn truy cập trực tiếp
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
class Main_Nav_Walker extends Walker_Nav_Menu {

    // UL con (submenu)
    function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    // LI + A
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {

        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);

        // LI class
        if ($depth === 0) {
            $li_class = 'nav-item';
            if ($has_children) {
                $li_class .= ' dropdown';
            }
        } else {
            $li_class = '';
        }

        $output .= $indent . '<li class="' . esc_attr($li_class) . '">';

        // A attributes
        $atts = '';
        $atts .= ! empty($item->url) ? ' href="' . esc_url($item->url) . '"' : '';

        if ($depth === 0) {
            // Menu cha
            if ($has_children) {
                $atts .= ' class="nav-link dropdown-toggle"';
                $atts .= ' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
            } else {
                $atts .= ' class="nav-link"';
            }
        } else {
            // Submenu
            $atts .= ' class="dropdown-item"';
        }

        $item_output  = '<a' . $atts . '>';
        $item_output .= apply_filters('the_title', $item->title, $item->ID);
        $item_output .= '</a>';

        $output .= $item_output;
    }

    function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }
}
