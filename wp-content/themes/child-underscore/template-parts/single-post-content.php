<div class="col-lg-12 mb-5">
    <div class="single-blog-item">
        <img src="<?php echo Helper::get_thumbnail_url("full") ?>" alt="" class="img-fluid rounded">

        <div class="blog-item-content bg-white p-5">
            <div class="blog-item-meta bg-gray py-1 px-2">
                <span class="text-muted text-capitalize mr-3"><i class="ti-pencil-alt mr-2"></i><?php echo Helper::get_categories() ?></span>
                <span class="text-muted text-capitalize mr-3"><i class="ti-comment mr-2"></i><?php echo Helper::get_comment_count() ?> Comments</span>
                <!-- dạng ngày tháng: 28th January -->
                <!-- c1: get_the_date('j F Y'); -->
                <!-- c2: cài đặt > tổng quan > Định dạng ngày tháng > j F Y và ngôn ngữ tiếng anh mới có January -->
                <span class="text-black text-capitalize mr-3"><i class="ti-time mr-1"></i> <?php echo Helper::get_publish_date() ?></span>
            </div>

            <h2 class="mt-3 mb-4"><a href="<?php echo Helper::get_post_url(); ?>"><?php echo Helper::get_title() ?></a></h2>
            <p class="lead mb-4"><?php echo Helper::get_description() ?></p>

            <!-- <pre> -->
            <?php echo Helper::get_content(); ?>
            <!-- </pre> -->

            <div class="tag-option mt-5 clearfix">
                <ul class="float-left list-inline">
                    <li>Tags:</li>
                    <?php
                    echo Helper::get_tags(true);
                    ?>
                    <!-- <li class="list-inline-item"><a href="#" rel="tag">Advancher</a></li> -->
                </ul>

                <ul class="float-right list-inline">
                    <li class="list-inline-item"> Share: </li>
                    <li class="list-inline-item"><a href="#" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                    <li class="list-inline-item"><a href="#" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                    <li class="list-inline-item"><a href="#" target="_blank"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                    <li class="list-inline-item"><a href="#" target="_blank"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('template-parts/single-post-pagination'); ?>

<?php
$comments = get_comments(array(
    'post_id' => get_the_ID(),
    'status'  => 'approve',
    'order'   => 'ASC',
));

if ($comments) : ?>
    <div class="col-lg-12 mb-5">
        <div class="comment-area card border-0 p-5">
            <h4 class="mb-4"><?php echo count($comments) . ' Comments'; ?></h4>
            <ul class="comment-tree list-unstyled">
                <?php foreach ($comments as $comment) : ?>
                    <li id="comment-<?php echo esc_attr($comment->comment_ID); ?>">
                        <div class="comment-area-box">
                            <?php echo get_avatar($comment, 80, '', '', array('class' => 'img-fluid float-left')); ?>
                            <h5 class=""><?php echo esc_html($comment->comment_author); ?></h5>
                            <div class="comment-meta mt-4 mt-lg-0 mt-md-0 float-lg-right float-md-right">
                                <a href="#comment-<?php echo esc_attr($comment->comment_ID); ?>">
                                    <i class="icofont-reply mr-2 text-muted"></i>Reply |
                                </a>
                                <span class="date-comm">Posted <?php echo esc_html(get_comment_date('F j, Y', $comment)); ?></span>
                            </div>
                            <div class="comment-content mt-3">
                                <p><?php echo esc_html($comment->comment_content); ?></p>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>

<?php
// nếu ko thấy thì vào admin duyệt
$commenter = wp_get_current_commenter();

comment_form(array(
    'class_form' => 'contact-form bg-white rounded p-5',
    'id_form'    => 'comment-form',

    'title_reply' => 'Write a comment',
    'title_reply_before' => '<h4 class="mb-4">',
    'title_reply_after'  => '</h4>',

    'fields' => array(

        'author' =>
        '<div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input class="form-control"
                            type="text"
                            name="author"
                            id="author"
                            value="' . esc_attr($commenter['comment_author']) . '"
                            placeholder="Name:"
                            required>
                    </div>
                </div>',

        'email' =>
        '<div class="col-md-6">
                    <div class="form-group">
                        <input class="form-control"
                            type="email"
                            name="email"
                            id="email"
                            value="' . esc_attr($commenter['comment_author_email']) . '"
                            placeholder="Email:"
                            required>
                    </div>
                </div>
            </div>',
    ),

    'comment_field' =>
    '<textarea class="form-control mb-3"
            name="comment"
            id="comment"
            cols="30"
            rows="5"
            placeholder="Comment"
            required></textarea>',

    'submit_button' =>
    '<input class="btn btn-main btn-round-full"
            type="submit"
            name="submit"
            id="submit"
            value="Submit Message">',

    'comment_notes_before' => '',
    'comment_notes_after'  => '',
));
?>


<!-- <div class="col-lg-12">
    <form class="contact-form bg-white rounded p-5" id="comment-form">
        <h4 class="mb-4">Write a comment</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input class="form-control" type="text" name="name" id="name" placeholder="Name:">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input class="form-control" type="text" name="mail" id="mail" placeholder="Email:">
                </div>
            </div>
        </div>


        <textarea class="form-control mb-3" name="comment" id="comment" cols="30" rows="5" placeholder="Comment"></textarea>

        <input class="btn btn-main btn-round-full" type="submit" name="submit-contact" id="submit_contact" value="Submit Message">
    </form>
</div> -->