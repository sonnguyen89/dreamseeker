<!DOCTYPE html>
<html class="no-js" lang="">
    <head>
        <title>
            <?php if (is_home() || is_front_page()) { ?>
                Dreamseeker
                <?php
            } else {
                wp_title();
            }
            ?>
        </title>  
        <?php wp_head(); ?>
        <!--<meta charset="utf-8">-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Dreamseeker</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-110544191-1"></script>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-110544191-1', 'auto');
            ga('send', 'pageview');

        </script>


    </head>
    <body>
        <?php
        global $post;

//        $titl = array();
//        $link_blog = array();
//        $args = array(
//            'posts_per_page' => -1,
//            'offset' => 0,
//            'orderby' => 'post_date',
//            'category' => '',
//            'order' => 'DESC',
//            'post_type' => 'products',
//            'post_status' => 'publish'
//        );
//        $_posts_array = get_posts($args);
//        foreach ($_posts_array as $_post1) {
//            if (has_post_thumbnail($_post1->ID)) {
//                $url = wp_get_attachment_image_src(get_post_thumbnail_id($_post1->ID), 'full');
//            }
//            $titl[] = $_post1->post_title;
//            $link_blog[$_post1->post_title] = get_permalink($_post1->ID);
            ?>
        <?php // } ?>
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55cdbf8f0515bb4a" async="async"></script>-->
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55cdbf8f0515bb4a" async="async"></script>

        <!--            header menu style-->
        <script>
//            var link_blog = JSON.parse('<?php // echo json_encode($link_blog); ?>');

            jQuery(document).ready(function() {

                jQuery('#menu-menu-1').find('.sub-menu').addClass('dropdown-menu');
                jQuery('#menu-menu-1').find('li').addClass('dropdown');

                jQuery('#menu-menu-1 .menu-item-has-children').each(function() {
                    jQuery(this).find('a:first').attr("data-toggle", "dropdown");
                    jQuery(this).find('a:first').append('<span class="caret"></span>');
                });
                jQuery('.top-menu-bar li a').append(' <i class="fa fa-angle-right"></i>');

                jQuery('.footer-navbar-nav .menu-item-has-children').each(function() {
                    jQuery(this).addClass('col-md-2 col-sm-4 col-xs-6');
                    jQuery(this).find('a:first').css({"font-size": "14px", "text-decoration": "none", "font-family": '"AvenirNextBold",sans-serif'});
                    jQuery(this).find('a:first').removeAttr("href");
                    jQuery(this).find('.sub-menu').css({"margin-top": "5px"});

                });
                jQuery('#menu-item-82').removeClass('col-md-2');
                jQuery('#menu-item-82').addClass('col-md-3');

                jQuery('.menu-item-object-products_category').click(function(e) {
                    e.preventDefault();
                    var str = jQuery(this).find("a").attr('href');
                    var res_link = str.split("products_category");
                    var str = res_link[1];
                    window.location.replace(res_link[0] + 'off-road/#' + res_link[1].replace("/", ""));
                    jQuery('.product_category').val(jQuery(this).find("a").text())
                    jQuery('.product_category').trigger('change')
                    jQuery("html, body").animate({scrollTop: jQuery("#scroll_here").offset().top}, 1000);
                });
                jQuery('#menu-menu-1.nav li.dropdown').hover(function() {
                    jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
                }, function() {
                    jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
                });

                jQuery('.serch_close_sec').click(function() {
                    jQuery('.search_inpu').slideUp();

                });
            });
        </script>

        <style type="text/css">
            html{
                margin-top:0px !important;
            }
        </style>


        <nav class="navbar navbar-inverse navbar-top navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="row">
                    <div class="navbar-header col-md-12">
                        <div class="navbar-header-content navbar-center">
                        <span class="search_icon_mobile"><a href="#"><span class="glyphicon glyphicon-search"></span></a></span>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="logo_brnd"><a class="navbar-brand logo text-hide" href="<?php bloginfo('url'); ?>">Dream Seeker</a></div>

                        <?php
                            wp_nav_menu(array(
                                'theme_location' => 'header-top-menu',
                                'menu_class' => 'top-menu-bar nav navbar-nav navbar-right'
                            ));
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div id="navbar" class="main-navigation collapse navbar-collapse">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'header-menu',
                                'menu_class' => 'main-navbar-content nav navbar-nav navbar-center'
                            ));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
