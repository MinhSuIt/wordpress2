<!doctype html>
<html <?php language_attributes(); ?>>

<head>

    <meta charset="UTF-8">
    <title>Megakit| Html5 Agency template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">


    <!-- lấy style.css và các meta tag khác từ plugin -->
    <?php wp_head(); ?>

</head>

<!-- body_class phải có -->

<body <?php body_class(); ?>>
    <!-- wp_body_open phải có hiển thị các bar của plugin Query Monitor/Show Current Template/... -->
    <?php wp_body_open(); ?>

    <!-- Header Start -->
    <?php echo do_shortcode('[menu_shortcode]'); ?>

    <!-- <header class="navigation">
        <div class="header-top ">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-2 col-md-4">
                        <div class="header-top-socials text-center text-lg-left text-md-left">
                            <a href="#" target="_blank"><i class="ti-facebook"></i></a>
                            <a href="#" target="_blank"><i class="ti-twitter"></i></a>
                            <a href="#" target="_blank"><i class="ti-github"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-8 text-center text-lg-right text-md-right">
                        <div class="header-top-info">
                            <a href="tel:+23-345-67890">Call Us : <span>+23-345-67890</span></a>
                            <a href="mailto:support@gmail.com"><i class="fa fa-envelope mr-2"></i><span>support@gmail.com</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg  py-4" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    Mega<span>kit.</span>
                </a>

                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span>
                </button>

                <div class="collapse navbar-collapse text-center" id="navbarsExample09">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'menu-1',
                        'container'      => false,
                        'menu_class'     => 'navbar-nav ml-auto',
                        'walker'         => new Main_Nav_Walker(),
                    ]);
                    ?>

                    <form class="form-lg-inline my-2 my-md-0 ml-lg-4 text-center">
                        <a href="#" class="btn btn-solid-border btn-round-full">Get a Quote</a>
                    </form>
                </div>
            </div>
        </nav>
    </header> -->

    <!-- Header Close -->
    <div class="main-wrapper">