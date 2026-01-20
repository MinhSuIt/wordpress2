<?php
/*
Template Name: Contact Page
*/
?>
<!-- Tạo page trong admin rồi vào chỉnh sửa nhanh chọn Mẫu trang là template này, Đường dẫn là contact (/contact)
Thêm vào menu dạng Contact Blog
Nếu truy cập /contact ko được thì vào cài đặt > cấu trúc đường dẫn > Tiêu đề bài viết  -->

<?php get_header(); ?>

<?php get_template_part('template-parts/breadcrumb'); ?>

<!-- contact form start -->
<section class="contact-form-wrap section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <!-- <form id="contact-form" class="contact__form" method="post" action="mail.php">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success contact__msg" style="display: none" role="alert">
                                Your message was sent successfully.
                            </div>
                        </div>
                    </div>
                    <span class="text-color">Send a message</span>
                    <h3 class="text-md mb-4">Contact Form</h3>
                    <div class="form-group">
                        <input name="name" type="text" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <input name="email" type="email" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="form-group-2 mb-4">
                        <textarea name="message" class="form-control" rows="4" placeholder="Your Message"></textarea>
                    </div>
                    <button class="btn btn-main" name="submit" type="submit">Send Message</button>
                </form> -->
                <?php echo do_shortcode('[wpforms id="67"]'); ?>
            </div>

            <div class="col-lg-5 col-sm-12">
                <div class="contact-content pl-lg-5 mt-5 mt-lg-0">
                    <span class="text-muted">We are Professionals</span>
                    <h2 class="mb-5 mt-2">Don’t Hesitate to contact with us for any kind of information</h2>

                    <ul class="address-block list-unstyled">
                        <li>
                            <i class="ti-direction mr-3"></i>North Main Street,Brooklyn Australia
                        </li>
                        <li>
                            <i class="ti-email mr-3"></i>Email: contact@mail.com
                        </li>
                        <li>
                            <i class="ti-mobile mr-3"></i>Phone:+88 01672 506 744
                        </li>
                    </ul>

                    <ul class="social-icons list-inline mt-5">
                        <li class="list-inline-item">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="google-map">
    <div id="map"></div>
</div>
<?php
get_sidebar();
get_footer();
?>