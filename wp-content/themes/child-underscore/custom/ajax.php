<?php
function load_more_posts() {
    $paged = isset($_POST['page']) ? $_POST['page'] + 1 : 2;

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'paged' => $paged
    );

    $query = new WP_Query($args);

    if ($query->have_posts()):
        while ($query->have_posts()): $query->the_post(); ?>
            
            <div class="post-item">
                <h3><?php the_title(); ?></h3>
            </div>

        <?php endwhile;
    endif;

    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');


function theme_scripts() {
    wp_enqueue_script(
        'ajax-js',
        get_stylesheet_directory_uri() . '/js/ajax.js',
        array('jquery'), // phụ thuộc vào jQuery
        null,
        true
    );

    // truyền ajaxurl.ajax_url đến /js/ajax.js
    wp_localize_script('ajax-js', 'ajaxurl', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'theme_scripts');