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
        </head>
        <body>
           <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55cdbf8f0515bb4a" async="async"></script>

<!--            header menu style-->
 <script>
            jQuery(document).ready(function(){
            jQuery('#menu-menu-1').last().after().append('<li class="visible-xs"><a href="#">Find a Dealer</a></li><li class="visible-xs"><a href="#">Contact Us</a></li><li class="search-icon"><a href="#"><span class="glyphicon glyphicon-search"></span></a></li>');
            jQuery('#menu-menu-1').find('.sub-menu').addClass('dropdown-menu');
            jQuery('#menu-menu-1').find('li').addClass('dropdown');
            // jQuery('#menu-menu-1').find('.menu-item-has-children a:first').attr( "data-toggle", "dropdown" );

            jQuery('#menu-menu-1 .menu-item-has-children').each(function() {
            jQuery(this).find('a:first').attr( "data-toggle", "dropdown" );
            jQuery(this).find('a:first').append('<span class="caret"></span>');
            });       
            jQuery('.top-menu-bar li a').append(' <i class="fa fa-angle-right"></i>');
     
            });
</script>
<!--            header menu style-->
<!--            footr menu style-->
            <script>
        jQuery(document).ready(function(){
          jQuery('.footer-navbar-nav .menu-item-has-children').each(function() {
            jQuery(this).addClass('col-md-2 col-sm-4 col-xs-6');
             jQuery(this).find('a:first').css({"font-size": "14px", "text-decoration": "none", "font-family": '"AvenirNextBold",sans-serif'});
             jQuery(this).find('a:first').removeAttr("href");
             jQuery(this).find('.sub-menu').css({"margin-top": "5px"});
            
            });
            jQuery('#menu-item-82').removeClass('col-md-2');
            jQuery('#menu-item-82').addClass('col-md-3');
       
       });
            </script>
            
            <script>
             jQuery(document).ready(function(){
                 jQuery('.menu-item-object-products_category').click(function(e){
                 e.preventDefault();
                 var str = jQuery(this).find("a").attr('href');               
                 var res_link = str.split("products_category");     
                 var str = res_link[1];
                 window.location.replace(res_link[0]+'off-road/#'+res_link[1].replace("/", ""));
                 jQuery('.product_category').val(jQuery(this).find("a").text())
                 jQuery('.product_category').trigger('change')
                 jQuery("html, body").animate({scrollTop: jQuery("#scroll_here").offset().top}, 1000);
           });
              });
            </script>
     
<!--            footr menu style-->
    
<style type="text/css">
    html{
        margin-top:0px !important;
    }
</style>

    <nav class="navbar navbar-inverse navbar-top navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand logo text-hide" href="<?php bloginfo('url'); ?>">Dream Seeker</a>
        </div>
        <div id="navbar-secondary" class="hidden-xs navbar-collapse navbar-secondary ">
        <?php wp_nav_menu(array(
                        'theme_location' => 'header-top-menu',
                        'menu_class'      => 'top-menu-bar nav navbar-nav navbar-right'
         )); ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-primary">
           <?php wp_nav_menu(array(
               'theme_location' => 'header-menu',
               'menu_class'      => 'nav navbar-nav navbar-right'
          )); ?>
        </div>
      </div>
    </nav>
