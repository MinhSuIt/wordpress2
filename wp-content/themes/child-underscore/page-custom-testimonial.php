<!-- thêm custom post type với page templatae -->
<?php
/*
Template Name: Custom Testimonial Page
*/
?>


<div class="container" style="max-width:600px; margin:40px auto;">
    <h2>Gửi Đánh Giá</h2>

    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">

        <?php wp_nonce_field('submit_testimonial_action', 'testimonial_nonce'); ?>
        <input type="hidden" name="action" value="save_custom_testimonial">

        <p>
            <label>Tên:</label><br>
            <input type="text" name="name" required style="width:100%;padding:8px;">
        </p>

        <p>
            <label>Công việc:</label><br>
            <input type="text" name="job" required style="width:100%;padding:8px;">
        </p>

        <p>
            <label>Bình luận:</label><br>
            <textarea name="comment" required style="width:100%;padding:8px;"></textarea>
        </p>

        <p>
            <label>Rate:</label><br>

            <?php
            $terms = get_terms(array(
                'taxonomy'   => 'rate',
                'hide_empty' => false,
            ));

            if (! empty($terms) && ! is_wp_error($terms)) {
                foreach ($terms as $term) {
                    echo '<label style="margin-right:10px;">
                        <input type="radio" name="rate" value="' . esc_attr($term->term_id) . '" required>
                        ' . esc_html($term->name) . '
                    </label>';
                }
            } else {
                echo '<p>Chưa có rate.</p>';
            }
            ?>

        </p>

        <p>
            <button type="submit" name="submit_testimonial">Gửi đánh giá</button>
        </p>

    </form>

</div>