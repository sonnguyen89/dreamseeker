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

            jQuery(document).ready(function($) {


                $('#navbar ul.main-navbar-content')
                    .last()
                    .after()
                    .append('<li class="visible-xs"><a href="#">Find a Dealer</a></li>\
                              <li class="visible-xs"><a href="#">Contact Us</a></li>\n\
                               <li class="search-icon"><a href="#"><span class="glyphicon glyphicon-search"></span></a></li>'
                    );
                $('#navbar ul.main-navbar-content').find('.sub-menu').addClass('dropdown-menu');
                $('#navbar ul.main-navbar-content').find('li').addClass('dropdown');

                $('#navbar ul.main-navbar-content .menu-item-has-children').each(function() {
                    jQuery(this).find('a:first').attr("data-toggle", "dropdown");
                    jQuery(this).find('a:first').append('<span class="caret"></span>');
                });
                $('.top-menu-bar li a').append(' <i class="fa fa-angle-right"></i>');

                $('.footer-navbar-nav .menu-item-has-children').each(function() {
                    $(this).addClass('col-md-2 col-sm-4 col-xs-6');
                    $(this).find('a:first').css({"font-size": "14px", "text-decoration": "none", "font-family": '"AvenirNextBold",sans-serif'});
                    $(this).find('a:first').removeAttr("href");
                    $(this).find('.sub-menu').css({"margin-top": "5px"});

                });
                $('#menu-item-82').removeClass('col-md-2');
                $('#menu-item-82').addClass('col-md-3');

                $('.menu-item-object-products_category').click(function(e) {
                    e.preventDefault();
                    var str = $(this).find("a").attr('href');
                    var res_link = str.split("products_category");
                    var str = res_link[1];
                    window.location.replace(res_link[0] + 'off-road/#' + res_link[1].replace("/", ""));
                    $('.product_category').val($(this).find("a").text())
                    $('.product_category').trigger('change')
                    $("html, body").animate({scrollTop: $("#scroll_here").offset().top}, 1000);
                });
                $('#navbar ul.main-navbar-content li.dropdown').hover(function() {
                    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
                }, function() {
                    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
                });


                //these functions respond for  animation and style for seach at desktop theme
                $('.main-navigation .serch_close_sec').click(function()
                {


                    $('#navbar.main-navigation form.searc').animate({
                        width: "0",
                    }, 500, function(){
                        $(".main-navigation .search-icon").show();
                    });
                    $('.main-navigation .search_inpu').css('overflow', 'hidden');
                    $('.main-navigation input.search_input').val('');
                    $('.main-navigation #result_sc').html('');

                });
                $(".search-icon").live('click', function()
                {
                    event.stopPropagation();
                    $('.search-icon').hide();

                    //set the search form position before doing animation
                    var search_input_right_pos = 0;
                    var search_width = 550;
                    if($(window).width() < 1450 )
                    {
                        search_width = $(window).width();
                        $('.search_input').css({width : '89%'})
                    }
                    else
                    {
                        $('.search_input').css({width : ''})
                        if((($(window).width() - $('#navbar.main-navigation > div').outerWidth() )/2) > 0 )
                        {
                            search_input_right_pos = ($(window).width() - $('#navbar.main-navigation > div').outerWidth())/2;
                        }
                    }
                    if($(window).width() < 1000 )
                    {
                        $('.search_input').css({width : '80%'})
                    }
                    $('.search_inpu').css({
                        overflow: 'visible',
                        right : search_input_right_pos
                    });

                    $('#navbar.main-navigation form.searc').animate({
                        width: search_width,
                    },
                        500,
                        function(){
                            $('input.search_input').focus();
                        }
                    );
                });



                //these functions respond for  animation and style for seach at Mobile theme

                $('.mobile_search_inpu .serch_close_sec').click(function()
                {

                    $('.mobile_search_inpu input.search_input').animate({
                        width: "",
                    }, 300, function(){
                        $('.mobile_search_inpu').css('display','');
                        $(".search_icon_mobile > a").show();
                    });
                    $('.mobile_search_inpu').css('overflow', 'hidden');
                    $('.mobile_search_inpu input.search_input').val('');
                    $('.mobile_search_inpu #result_sc').html('');

                });


                $(".search_icon_mobile > a").live('click', function()
                {
                    event.stopPropagation();
                    $('.search_icon_mobile > a').hide();
                    $('.mobile_search_inpu').show();


                    var mobi_search_width = $(window).width() - 250;


                    $('.mobile_search_inpu input.search_input').animate({
                            width: mobi_search_width,
                        },
                        300,
                        function(){
                            $('.mobile_search_inpu input.search_input').focus();
                        }
                    );


                });


                //these functions  do animation and style for main menu for responsive
                if($(window).width() <= 990 )
                {
                    $('.main-navigation .navbar-nav > li > div.menu-item-dropdown').css('width', '100%');

                    $( window ).resize(function(){

                        $('.main-navigation .navbar-nav > li > div.menu-item-dropdown').css('width', '100%');

                    });
                }
                else if($(window).width() <= 1150 )
                {
                    $('.main-navigation .navbar-nav > li > div.menu-item-dropdown').css('width', $('.main-navbar-content.navbar-center').width());

                    $( window ).resize(function(){

                        $('.main-navigation .navbar-nav > li > div.menu-item-dropdown').css('width', $('.main-navbar-content.navbar-center').width());

                    });
                }
                else if($(window).width() <= 1300 )
                {
                    $('.main-navigation .navbar-nav > li > div.menu-item-dropdown').css('width', $('.main-navbar-content.navbar-center').width() - 200);


                    $( window ).resize(function(){
                        $('.main-navigation .navbar-nav > li > div.menu-item-dropdown').css('width', $('.main-navbar-content.navbar-center').width() - 200);


                    });
                }
                else if($(window).width() <= 1400 )
                {
                    $('.main-navigation .navbar-nav > li > div.menu-item-dropdown').css('width', $('.main-navbar-content.navbar-center').width() - 300);


                    $( window ).resize(function(){
                        $('.main-navigation .navbar-nav > li > div.menu-item-dropdown').css('width', $('.main-navbar-content.navbar-center').width() - 300);


                    });
                }
                else
                {
                    $('.main-navigation .navbar-nav > li > div.menu-item-dropdown').css('width', $('.main-navbar-content.navbar-center').width() - 200);


                    $( window ).resize(function(){
                        $('.main-navigation .navbar-nav > li > div.menu-item-dropdown').css('width', $('.main-navbar-content.navbar-center').width() - 200);

                    });
                }



                $('.main-navigation .navbar-nav > li > div.menu-item-dropdown div.dropdown-content').css('height',$('.main-navigation .navbar-nav > li > div.menu-item-dropdown img.dropdown-image').height());


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
                        <!--  search function for mobile theme --->
                        <span class="search_icon_mobile"><a href="#"><span class="glyphicon glyphicon-search"></span></a>
                            <div class="mobile_search_inpu">
                                <form role="search" method="get" id="mobi_searchform" class="searc" action="<?php echo home_url('/'); ?>">
                                    <div class="ui-widget auto_fill_p">
                                         <span class="serch_close_sec"><img src="<?php echo get_template_directory_uri() ?>/img/serch_close_icon_black.png"/></span>
                                        <input id="tags" type="text" style="color:#000;" class="search_input mobile_search"  value="" name="s"   placeholder="SEARCH...."  autocomplete="off" />
                                         <button class="search_btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                        <ul style="display:block;" id="mobile_result_sc"></ul>
                                    </div>
                                </form>
                            </div>
                        </span>

                        <!--  mobile navigation button/ toggle  --->
                        <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!--  desktop/tablet navigation menu --->
                        <div id="navbar" class="main-navigation navbar-collapse collapse">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'header-menu',
                                'menu_class' => 'main-navbar-content nav navbar-nav navbar-center'
                            ));
                            ?>
                            <!--  search function--->
                            <div class="search_inpu">
                                <form role="search" method="get" id="searchform" class="searc" action="<?php echo home_url('/'); ?>">
                                    <div class="ui-widget auto_fill_p">
                                        <button class="search_btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                        <input id="tags" type="text" style="color:#000;" class="search_input search"  value="" name="s"   placeholder="SEARCH...."  autocomplete="off" />
                                        <span class="serch_close_sec"><img src="<?php echo get_template_directory_uri() ?>/img/serch_close_icon_black.png"/></span>
                                        <ul style="display:block;" id="result_sc"></ul>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <!--  mobile navigation menu --->
                        <div id="mobile-navbar" class="mobile-navigation">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'mobile-header-menu',
                                'menu_class' => 'main-navbar-content nav navbar-nav navbar-center'
                            ));
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </nav>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            // Enter your ids or classes
            var pagewrapper = '#page-content';
            var navigationwrapper = '.navbar-header';
            var menuwidth = '100%'; // the menu inside the slide menu itself
            var slidewidth = '80%';
            var menuneg = '-100%';
            var slideneg = '-80%';


            $("button.navbar-toggle").on("click", function (e) {

                var selected = $(this).hasClass('mobile-active');
                $(this).toggleClass('mobile-active', !selected);
                $(' #mobile-navbar.mobile-navigation').toggleClass('mobile-active');


                $('#mobile-navbar.mobile-navigation:not(.mobile-active)').stop().animate({
                    left:'-100%'
                });

                $('#mobile-navbar.mobile-navigation.mobile-active').stop().animate({
                    left:'0px'
                });

            });
            $(" #mobile-navbar.mobile-navigation .main-navbar-content li").has('ul.sub-menu').children('a').append('<img class="right_arrow_img" src="<?php echo get_template_directory_uri() ?>/img/right_arrow_menu.png"/>');
            $(" #mobile-navbar.mobile-navigation .main-navbar-content li").has('ul.sub-menu').children('a').append('<img class="left_arrow_img" src="<?php echo get_template_directory_uri() ?>/img/left_arrow_menu.png"/>');


            $(" #mobile-navbar.mobile-navigation .main-navbar-content li").on("click", function (e) {

                var top = $(this).height();
                $(this).children('ul.sub-menu').css({'top':  top });
                $(this).children('ul.sub-menu').css({'height':  $(window).height() - 300});


                var selected = $(this).hasClass('mobile-active');
                $(this).toggleClass('mobile-active', !selected);
                $(this).children('ul.sub-menu').toggleClass('mobile-active');



                $(this).children('ul.sub-menu').stop().animate({
                    left:'0px'
                });

                $(this).children('ul.sub-menu:not(.mobile-active)').stop().animate({
                    left:'-100%'
                });

            });



        });

    </script>

