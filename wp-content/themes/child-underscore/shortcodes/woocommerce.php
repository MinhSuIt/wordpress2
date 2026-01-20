<?php
add_shortcode('woo_product_filter', 'woo_product_filter_shortcode');
function woo_product_filter_shortcode()
{
    ob_start(); ?>

    <form method="GET" class="woo-filter-form">

        <!-- Giá -->
        <p>
            <label>Giá từ:</label>
            <input type="number" name="min_price" value="<?php echo esc_attr($_GET['min_price'] ?? ''); ?>">
            <label>đến:</label>
            <input type="number" name="max_price" value="<?php echo esc_attr($_GET['max_price'] ?? ''); ?>">
        </p>

        <!-- In stock -->
        <p>
            <label>
                <input type="checkbox" name="in_stock" value="1" <?php checked(isset($_GET['in_stock'])); ?>>
                Còn hàng
            </label>
        </p>

        <!-- On sale -->
        <p>
            <label>
                <input type="checkbox" name="on_sale" value="1" <?php checked(isset($_GET['on_sale'])); ?>>
                Đang giảm giá
            </label>
        </p>

        <!-- Danh mục -->
        <?php
        $categories = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => true
        ));
        $selected_cats = array_map('sanitize_title', (array) ($_GET['product_cat'] ?? []));

        foreach ($categories as $cat) :
        ?>
            <label>
                <input type="checkbox"
                    name="product_cat[]"
                    value="<?php echo esc_attr($cat->slug); ?>"
                    <?php checked(in_array($cat->slug, $selected_cats)); ?>>


                <?php echo esc_html($cat->name); ?>
            </label>
        <?php endforeach; ?>

        <!-- Brand (đổi product_brand nếu taxonomy brand của bạn khác) -->
        <p>
            <label>Brand:</label>
            <?php
            wp_dropdown_categories(array(
                'taxonomy' => 'product_brand',
                'name' => 'product_brand',
                'show_option_all' => 'Tất cả',
                'selected' => $_GET['product_brand'] ?? '',
                'hide_empty' => true
            ));
            ?>
        </p>

        <!-- Thuộc tính ví dụ: color -->
        <p>
            <label>Màu sắc:</label>
            <?php
            wp_dropdown_categories(array(
                'taxonomy' => 'pa_color',
                'name' => 'pa_color',
                'show_option_all' => 'Tất cả',
                'selected' => $_GET['pa_color'] ?? '',
                'hide_empty' => true
            ));
            ?>
        </p>

        <button type="submit">Lọc sản phẩm</button>
    </form>

<?php
    woo_filter_query_products();
    return ob_get_clean();
}
function woo_filter_query_products()
{

    $meta_query = array('relation' => 'AND');
    $tax_query  = array('relation' => 'AND');

    /* ===== LỌC GIÁ ===== */
    if (!empty($_GET['min_price']) || !empty($_GET['max_price'])) {
        $meta_query[] = array(
            'key' => '_price',
            'value' => array(
                $_GET['min_price'] ?? 0,
                $_GET['max_price'] ?? 999999999
            ),
            'compare' => 'BETWEEN',
            'type' => 'NUMERIC'
        );
    }

    /* ===== IN STOCK ===== */
    if (!empty($_GET['in_stock'])) {
        $meta_query[] = array(
            'key' => '_stock_status',
            'value' => 'instock'
        );
    }

    /* ===== ON SALE ===== */
    $on_sale_ids = [];
    if (!empty($_GET['on_sale'])) {
        $on_sale_ids = wc_get_product_ids_on_sale();
    }

    /* ===== DANH MỤC ===== */
    if (!empty($_GET['product_cat'])) {

        // ép về mảng + làm sạch dữ liệu
        $terms = array_map('sanitize_title', (array) $_GET['product_cat']);

        $tax_query[] = array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',   // 👉 dùng slug
            'terms'    => $terms,
            'operator' => 'IN'
        );
    }
    /* ===== BRAND ===== */
    if (!empty($_GET['product_brand'])) {
        $tax_query[] = array(
            'taxonomy' => 'product_brand',
            'field' => 'term_id',
            'terms' => $_GET['product_brand']
        );
    }

    /* ===== THUỘC TÍNH ===== */
    if (!empty($_GET['pa_color'])) {
        $tax_query[] = array(
            'taxonomy' => 'pa_color',
            'field' => 'term_id',
            'terms' => $_GET['pa_color']
        );
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 12,
        'meta_query' => $meta_query,
        'tax_query' => $tax_query,
    );

    if (!empty($_GET['on_sale'])) {
        $args['post__in'] = $on_sale_ids;
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        woocommerce_product_loop_start();
        while ($query->have_posts()) : $query->the_post();
            wc_get_template_part('content', 'product');
        endwhile;
        woocommerce_product_loop_end();
    else :
        echo '<p>Không tìm thấy sản phẩm.</p>';
    endif;

    wp_reset_postdata();
}
