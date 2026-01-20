<!-- thêm post bằng template hierarchy wordpress -->
<form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post">
    <?php wp_nonce_field('user_post_nonce', 'user_post_nonce_field'); ?>

    <label for="title">Title:</label>
    <input type="text" id="title" name="post_title" required />

    <label for="content">Content:</label>
    <textarea id="content" name="post_content" required></textarea>

    <label for="category">Category:</label>
    <select id="category" name="post_category" required>
        <?php 
        $categories = get_categories();
        foreach ($categories as $category) {
            echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
        }
        ?>
    </select>
    <!-- <select id="tag" name="post_tag" required>
        <?php 
        $tags = get_tags();
        foreach ($tags as $tag) {
            echo '<option value="' . $tag->term_id . '">' . $tag->name . '</option>';
        }
        ?>
    </select> -->
    <input type="submit" name="submit_post" value="Submit Post" />
</form>
<?php
if (isset($_POST['submit_post'])) {
    // Kiểm tra nonce
    if (!isset($_POST['user_post_nonce_field']) || !wp_verify_nonce($_POST['user_post_nonce_field'], 'user_post_nonce')) {
        die('Permission Denied');
    }

    // Lấy dữ liệu từ form và sanitize
    $post_title = sanitize_text_field($_POST['post_title']);
    $post_content = sanitize_textarea_field($_POST['post_content']);
    $post_category = intval($_POST['post_category']); // Chuyển đổi thành ID danh mục

    // Kiểm tra dữ liệu có hợp lệ không
    if (!empty($post_title) && !empty($post_content)) {
        // Tạo bài viết mới
        $new_post = array(
            'post_title'   => $post_title,
            'post_content' => $post_content,
            'post_status'  => 'pending', // Trạng thái là "chờ duyệt" hoặc "publish"
            'post_author'  => get_current_user_id(), // Tạo bài viết bởi người dùng hiện tại
            'post_category'=> array($post_category), // Danh mục bài viết
        );

        // Lưu bài viết vào cơ sở dữ liệu
        $post_id = wp_insert_post($new_post);

        // Kiểm tra nếu bài viết được tạo thành công
        if ($post_id) {
            echo '<p>Thank you! Your post has been submitted for review.</p>';
        } else {
            echo '<p>There was an error submitting your post. Please try again later.</p>';
        }
    } else {
        echo '<p>Please fill in all the fields.</p>';
    }
}
?>