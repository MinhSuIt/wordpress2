<?php
// Ngăn truy cập trực tiếp
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
class Helper
{
    static function get_custom_logo_url()
    {
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
        return $logo_url;
    }
    static function get_asset($name)
    {
        // ví dụ current_theme/images/abc.jpg => Helper::get_asset('images/abc.jpg')
        return get_stylesheet_directory_uri() . '/' . $name;
    }


    // tạo breadcrumb bằng function flexible hơn template-parts
    static function the_breadcrumb_for_page()
    {
        if (!is_page() && !is_single()) return; // Chỉ hiển thị cho Page hoặc Single Post

        echo '<section class="page-title bg-1">';
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col-md-12">';
        echo '<div class="block text-center">';

        // Tiêu đề
        if (is_page()) {
            // echo '<span class="text-white">Page</span>'; // Có thể tùy chỉnh, hoặc lấy category nếu muốn
            echo '<h1 class="text-capitalize mb-4 text-lg">' . get_the_title() . '</h1>';
        } elseif (is_single()) {
            // echo '<span class="text-white">Blog</span>';
            echo '<h1 class="text-capitalize mb-4 text-lg">' . get_the_title() . '</h1>';
        }

        // Breadcrumb list
        echo '<ul class="list-inline">';

        // Home link
        echo '<li class="list-inline-item"><a href="' . home_url() . '" class="text-white">Home</a></li>';
        echo '<li class="list-inline-item"><span class="text-white">/</span></li>';

        // Page hierarchy
        if (is_page()) {
            global $post;
            if ($post->post_parent) {
                $ancestors = get_post_ancestors($post->ID);
                $ancestors = array_reverse($ancestors);
                foreach ($ancestors as $ancestor) {
                    echo '<li class="list-inline-item"><a href="' . get_permalink($ancestor) . '" class="text-white-50">' . get_the_title($ancestor) . '</a></li>';
                    echo '<li class="list-inline-item"><span class="text-white">/</span></li>';
                }
            }
            // Page hiện tại
            echo '<li class="list-inline-item"><a href="' . get_permalink() . '" class="text-white-50">' . get_the_title() . '</a></li>';
        }

        // Single post breadcrumb
        if (is_single()) {
            $categories = get_the_category();
            if ($categories) {
                $category = $categories[0]; // Lấy category đầu tiên
                echo '<li class="list-inline-item"><a href="' . get_category_link($category->term_id) . '" class="text-white-50">' . $category->name . '</a></li>';
                echo '<li class="list-inline-item"><span class="text-white">/</span></li>';
            }
            // Post hiện tại
            echo '<li class="list-inline-item"><a href="' . get_permalink() . '" class="text-white-50">' . get_the_title() . '</a></li>';
        }

        echo '</ul>'; // end list
        echo '</div>'; // end block
        echo '</div>'; // end col-md-12
        echo '</div>'; // end row
        echo '</div>'; // end container
        echo '</section>';
    }

    // 'full', 'medium', 'thumbnail'
    static function get_thumbnail_url($type)
    {
        return get_the_post_thumbnail_url(get_the_ID(), $type);
    }

    // nếu withLink true thì trả về kèm tag a
    static function get_categories(bool $withLink = false): string
    {
        $categories = get_the_category();
        if ($categories) {
            $cat_names = array();
            foreach ($categories as $cat) {
                if ($withLink) {
                    $cat_names[] = '<a href="' . get_category_link($cat->term_id) . '">' . esc_html($cat->name) . '</a>';
                } else {
                    $cat_names[] = esc_html($cat->name);
                }
            }
            return implode(', ', $cat_names); // Hiển thị: Category1, Category2
        }
        return "";
    }
    static function get_comment_count()
    {
        return get_comments_number();
    }
    static function get_publish_date()
    {
        return get_the_date();
    }
    static function get_post_url()
    {
        return esc_url(get_permalink());
    }

    // nếu withLink true thì trả về kèm tag a
    static function get_tags(bool $withLink = false): string
    {
        $tags = get_the_tags(); // Lấy tất cả tag của bài viết hiện tại
        if ($tags) {
            $tag_items = array();
            foreach ($tags as $tag) {
                if ($withLink) {
                    $tag_items[] = '<li class="list-inline-item"><a href="' . esc_url(get_tag_link($tag->term_id)) . '" rel="tag">' . esc_html($tag->name) . '</a></li>';
                } else {
                    $tag_items[] = esc_html($tag->name);
                }
            }

            if ($withLink) {
                // Nếu dùng <li>, nên bao quanh <ul> hoặc <ol> kiểu list-inline
                return '<ul class="list-inline">' . implode('', $tag_items) . '</ul>';
            } else {
                return implode(', ', $tag_items); // Ví dụ: Tag1, Tag2
            }
        }
        return "";
    }
    static function get_description(): string
    {
        return get_the_excerpt();
    }
    static function get_title(): string
    {
        return get_the_title();
    }
    static function get_content()
    {
        return the_content(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'default-underscore'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            )
        );;
    }
}
