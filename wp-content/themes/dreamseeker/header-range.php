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
            if(jQuery('.menu-item-object-products_category').trigger("click")){                
                var str = window.location.href;
                 var res_link = str.split("#");
                 jQuery('.product_category').val(res_link[1].replace('/', ''))
                 jQuery('.product_category').trigger('change')
//                 jQuery("html, body").animate({scrollTop: jQuery("#scroll_here").offset().top - 80}, 3000);
            }
            
            jQuery('.menu-item-object-products_category').click(function(e){
            e.preventDefault();           
              var val_opt1 = jQuery(this).find("a").text();
             jQuery.each(jQuery('.product_category option'), function() {
                 if((jQuery(this).text()) == val_opt1){
                      jQuery('.product_category').val(jQuery(this).val());
                      jQuery('.product_category').trigger('change');
                    jQuery('.navbar-second a').removeClass("sec-nav-bg-color");
//                    jQuery("html, body").animate({scrollTop: jQuery("#scroll_here").offset().top - 80}, 3000);
                 }
             });    

      });
     jQuery('.product_category_sub_menu li').click(function(e){
            e.preventDefault();
            var val_opt = jQuery(this).find("a").text();
             jQuery.each(jQuery('.product_category option'), function() {
                 if((jQuery(this).text()) == val_opt){
                      jQuery('.product_category').val(jQuery(this).val());
                      jQuery('.product_category').trigger('change')
                 }
             });           
            jQuery('.navbar-second a').removeClass("sec-nav-bg-color");
            jQuery(this).find("a").addClass( "sec-nav-bg-color" );
          //  jQuery("html, body").animate({scrollTop: jQuery("#scroll_here").offset().top - 80}, 1000);
      });
         });
             </script>             
             <script>
                jQuery(document).ready(function(){
                    jQuery('#menu-menu-1.nav li.dropdown').hover(function() {
                    jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
                }, function() {
                    jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
                });

//                jQuery('#menu-menu-1.nav li.dropdown').toggle(function() {
//                         jQuery('.dropdown-menu').slideUp();
//                    jQuery(this).find('.dropdown-menu').slideDown();
////                    jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
//                }, function() {
//                    jQuery('.dropdown-menu').slideUp();
//                    jQuery(this).find('.dropdown-menu').slideDown();
////                    jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
//                });
                });
            </script>
    <!--google map js-->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
            // When the window has finished loading create our google map below
            google.maps.event.addDomListener(window, 'load', init);
        
            function init() {
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
                    zoom: 11,

                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(40.6700, -73.9400), // New York

                    // How you would like to style the map. 
                    // This is where you would paste any style found on Snazzy Maps.
                    styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
                };

                // Get the HTML DOM element that will contain your map 
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('map');

                // Create the Google Map using our element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);

                // Let's also add a marker while we're at it
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(40.6700, -73.9400),
                    map: map,
                    title: 'Snazzy!'
                });
            }
        </script>  
    <!--/google map js-->
            
<!--            footr menu style-->
    
<style type="text/css">
    html{
        margin-top:0px !important;
    }
</style>
<script>
                jQuery(document).ready(function(){
                jQuery('.serch_close_sec').click(function(){
                jQuery('.search_inpu').css('display','none');
                });
                });
            </script>


<!--    <nav class="navbar navbar-inverse navbar-top navbar-fixed-top" role="navigation">
      <div class="container-fluid">
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
//                        'theme_location' => 'header-top-menu',
//                        'menu_class'      => 'top-menu-bar nav navbar-nav navbar-right'
         )); ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-primary">
           <?php wp_nav_menu(array(
//               'theme_location' => 'header-menu',
//               'menu_class'      => 'nav navbar-nav navbar-right'
          )); ?>
        </div>
      </div>
    </nav>-->
<nav class="navbar navbar-inverse navbar-top navbar-fixed-top" role="navigation">
      <div class="container-fluid" style="">
          <div class="col-md-12" style="">
        <div class="navbar-header col-md-2" style="">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
           <div class="logo_brnd"><a class="navbar-brand logo text-hide" href="<?php bloginfo('url'); ?>">DreamSeeker</a></div>
        </div>
         <div class="second_main_navbar col-md-10" style="padding:0px;">
        <div id="navbar-secondary" class="hidden-xs navbar-collapse navbar-secondary " style="float:left;width:100%;margin-top: -5px;">
           <?php wp_nav_menu(array(
                        'theme_location' => 'header-top-menu',
                        'menu_class'      => 'top-menu-bar nav navbar-nav navbar-right'
         )); ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-primary" style="float:left;width:100%; margin-top:15px;">
          <?php wp_nav_menu(array(
               'theme_location' => 'header-menu',
               'menu_class'      => 'nav navbar-nav navbar-right'
          )); ?>
            <div class="search_inpu">
                                <form role="search" method="get" id="searchform" class="searc" action="<?php echo home_url('/'); ?>">
                                    <div class="ui-widget auto_fill_p">
                                        <i class="mk-icon-search fullscreen-search-icon"> <input type="submit" id="searchsubmit" style=""  value="Search"  class="search_btn"/></i>
                                        <input id="tags" type="text" style="color:#000;" class="search_input search"  value="" name="s"   placeholder="Search Here"  autocomplete="off" />
                                        <!--<input id="tags" type="text" style="color:#000;" class="search_input search"  value="" name="s"   placeholder="Search Here"/>-->
                                        <ul style="display:block;" id="result_sc"></ul>
                                    </div>
                                </form>
                                <span class="serch_close_sec"><img src="<?php echo get_template_directory_uri() ?>/img/ser_close.png"/></span>
                            </div>
        </div>
      </div>
      </div>
      </div>
    </nav>