    <?php
    if (! defined('ABSPATH')) {
        exit; // Exit if accessed directly
    }
    // print_r(wp_get_registered_image_subsizes()); // hệ thống đã đăng ký các kích thước ảnh gì

    ?>

    <nav class="navbar-custom">
        <?php
        $custom_logo_id = get_theme_mod('custom_logo');

        if ($custom_logo_id) {
            // $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
            $logo_url = wp_get_attachment_image_url($custom_logo_id, 'variation_swatches_image_size'); // 50x50
            $logo_alt = get_post_meta($custom_logo_id, '_wp_attachment_image_alt', true);
            // print_r($meta = wp_get_attachment_metadata($custom_logo_id)); // Lấy loại kích thước ảnh về hình ảnh đã tải lên
            if (empty($logo_alt)) {
                $logo_alt = get_bloginfo('name');
            }
        ?>
            <a class="navbar-logo" href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url($logo_url); ?>"
                    alt="<?php echo esc_attr($logo_alt); ?>"
                    class="navbar-logo-img">
            </a>
        <?php
        } else {
            echo esc_html(get_bloginfo('name'));
        }
        ?>
        </a>

        <?php
        if (has_nav_menu('menu-header')) {
            wp_nav_menu(array(
                'theme_location' => 'menu-header',
                'container' => false,
                'menu_class' => 'nav-menu',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'walker' => new Custom_Nav_Walker(),
                'fallback_cb' => false
            ));
        }
        ?>

        <div class="hamburger">
            <span></span><span></span><span></span>
        </div>
    </nav>