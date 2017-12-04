<?php
get_header();
global $post;
?> 
<script type="text/javascript">
    jQuery(document).ready(function(){
   jQuery('.fancybox').attr('rel', 'media-gallery').fancybox({
    helpers:  {
        thumbs : {
            width: 145,
            height: 90
        }
    }
    });
    jQuery('#fancybox-thumbs').insertAfter('.fancybox-skin');
    

    });
    
</script>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<!-- Second Navigation
 ================================================== -->
    <nav class="navbar navbar-inverse navbar-top navbar-fixed-top second-navbar hidden-xs single_nav" role="navigation">
    <div class="container-fluid">
        <div id="navbar" class="navbar-collapse collapse navbar-second">
            <?php 
             $p_id = $post->ID;
             $in_ttl = get_field('related_product_list',$p_id);
            ?>
            <ul class="nav navbar-nav navbar-right scroll-slow rangesin-menu">
                <li  class="active"><a href="#overview">Overview</a></li>
                <li><a href="#layout">Layout</a></li>
                <li><a href="#specifications">Specifications</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li><a href="#brouchure">Brouchure</a></li>
                <li><a href="#wheretobuy">Where To Buy</a></li>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Other Models<span class="caret"></span></a>
               <?php if($in_ttl != ''){ ?> 
                <ul class="dropdown-menu">
                    <?php
                    foreach ($in_ttl as $in_ttl2) {
                        $rel_ids = $in_ttl2->ID;
                        $rel_ttls = $in_ttl2->post_title;
                        ?>         
                    <li><a href="<?php echo get_permalink($rel_ids); ?>"><?php echo $rel_ttls; ?></a></li>
                   <?php  }   ?>               
            </ul>
                <?php  }   ?>     
            </li>
          </ul>
        </div>
    </div>
</nav>
<!--<nav class="navbar navbar-inverse navbar-top navbar-fixed-top second-navbar hidden-xs single_nav" role="navigation">
      <div class="container">
        <div id="navbar" class="navbar-collapse collapse navbar-second">
          <ul class="nav navbar-nav navbar-right scroll-slow">
            <li><a href="#overview">Overview</a></li>
            <li><a href="#layout">Layout</a></li>
            <li><a href="#specifications">Specifications</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li><a href="#brouchure">Brouchure</a></li>
            <li><a href="#wheretobuy">Where To Buy</a></li>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Other Models<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="product-range.html">inferno 2</a></li>
                    <li><a href="product-range.html">inferno 2</a></li>
                </ul>  
            </li>
          </ul>
        </div>
      </div>
    </nav>-->

<!-- Product Hero Image
================================================== -->
<div class="container fill-top-product" >
    <div class="hero-unit product-img">         
        <div class="scroll-down scroll-slow"><a href="#overview">scroll down <i class="fa fa-angle-down"></i></a></div>       
                    <div class="price_wrp">
                        <?php 
                        $p_thu = get_field('price_thousands',$p_id);
                        $p_hnd = get_field('price_hundreds',$p_id);
                        if($p_thu != '' || $p_hnd!=''){
                        echo '<p>$'.$p_thu.','.$p_hnd.'</p>';
                        }
                        ?>
                    </div>
        <div class="product-img-inner">
            <?php
            $slider_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
            ?>
            <div class="fill" style="background-image:url('<?php echo get_template_directory_uri() . "/timthumb.php?src=" . $slider_image[0] . "&a=t&w=1500&h=700&zc=1"; ?>');">
                <div class="container">
                    <div class="product-img-caption">
                        <h1><?php echo $post->post_title ?></h1>
                        <p><?php echo $post->post_content ?></p>
                        <p><a class="btn btn-lg btn-primary" href="<?php echo get_field('download_link'); ?>" role="button">Download Brochure</a></p>
                    </div>
                  
                </div>
            </div>    
        </div>
    </div>   
</div>

<!-- Product Intro Text
================================================== -->
 <?php 
            $in_ttl = get_field('feature_heading',$p_id);
            $in_txt = get_field('feature_text',$p_id);
            $bg_col= get_field('feature_background_color',$p_id);
            $f_img= get_field('feature_image',$p_id);           
            ?>
<div class="product-introtext sin-prd" id="overview" style="background:<?php echo $bg_col; ?>">
    <div class="container ">
        <div class="row">     
            <div class="col-md-7">
            <h2><?php echo $in_ttl; ?></h2>
            <div class="al_txt" style="font-family: 'Open Sans', sans-serif!important;"><?php echo $in_txt; ?></div>
            </div>
            <div class="col-md-3">
                <?php if($f_img != '') {?>
            <img src="<?php echo $f_img['url']; ?>"/>
                <?php } ?>
        </div>
        </div>
    </div> 
</div>

<!-- Product Video
================================================== -->
<?php 
 $product_video_empty = get_field('product_video_url' );
 if($product_video_empty != ''){
?>
<div class="product-video" >
    <div class="container ">
        <div class="row">
            <?php 
            $video_poster_image = get_field('video_poster_image' );
            $video_poster_image1 =  $video_poster_image['url'];
            ?>
            <div class="col-md-7 news_video_image">
                <?php
                     echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . $video_poster_image1 . "&a=t&w=824&h=542&zc=1' alt=''>";
                ?>
                  <div class="vdo_play_btn"></div>
            </div>
            <div class="col-md-5 extra-padding">
                <h2><?php echo get_field('product_video_title' ); ?></h2>
                <p><?php echo get_field('video_content' ); ?></p>
                <p><a class="youtube btn btn-lg btn-primary" href="<?php echo get_field('product_video_url' ); ?>" role="button"><i class="fa  fa-play"></i> watch video</a></p>
            </div>
        </div>
    </div> 
</div>
 <?php } ?>
<!--<a class="fancybox" data-thumbnail="<?php echo get_template_directory_uri(); ?>/img/fb-feed-img.jpg" href="<?php echo get_template_directory_uri(); ?>/img/fb-feed-img.jpg">
<img src="<?php echo get_template_directory_uri(); ?>/img/fb-feed-img.jpg">
</a>
<a class="fancybox" data-thumbnail="<?php echo get_template_directory_uri(); ?>/img/featured-products-1.jpg" href="<?php echo get_template_directory_uri(); ?>/img/featured-products-1.jpg">
    <img src="<?php echo get_template_directory_uri(); ?>/img/fb-feed-img.jpg">
</a>-->
<!-- Product Layout
================================================== -->
<div class="product-layout" id="layout">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
               <?php 
                $product_layout_image = get_field('product_layout_image' );
                $product_layout_image1 =  $product_layout_image['url'];
                ?>
                <a href="#" role="button" data-toggle="modal" data-target="#layout_m">  
                    <?php if($product_layout_image1 != ''){ ?>
                <img src="<?php echo $product_layout_image1; ?>"/>
                     <?php }else{ ?>
                     <?php } ?>
                </a></div>
               
            <div class="col-md-12">
                <p> <a class="btn btn-lg btn-primary" href="#" role="button" data-toggle="modal" data-target="#myModal">Tech Specs</a>
                    <a class="btn btn-lg btn-primary" href="<?php echo get_field('virtual_tour_link' ); ?>" role="button">Virtual Tour</a></p>
            </div>
        </div>
    </div> 
</div>



<!-- Product Layout  Modal
    ================================================== -->
    <div class="modal fade bs-example-modal-lg layoutmodal" id="layout_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        
        <div class="modal-dialog modal-lg dreamseeker-gallery" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                <a href="#" type="button" class="share" id="news_share"><span aria-hidden="true"></span></a>
                <div class="share_icons_wrapper_two">
                <div class="addthis_sharing_toolbox" style="display:none;"></div>
                </div>
                <h4 class="modal-title uppercase" id="myModalLabel">Inferno layout</h4>
              </div>
                <?php 
                $product_layout_image_new = get_field('product_layout_image' );
                $product_layout_image_new1 =  $product_layout_image_new['url'];
                ?>
                <div class="modal-body">
                    <img src="<?php echo $product_layout_image_new1;?>" class="img-responsive"  />
                </div>
            </div>
        </div>
    </div>


<!-- Product Specifications
================================================== -->
<div class="products-specs" id="specifications">
    <div class="container ">
        <div class="row"><div class="header-wrapper"><h2>Specifications</h2></div></div>
        <div class="row">
            <div class="panel-group spec_panel" id="accordion" role="tablist" aria-multiselectable="true">
                 <?php
                        $specs = get_field('specification_section');                       
                        if ($specs) {
                            $i = 1;
                            foreach ($specs as $spec) {                                    
                                ?>    
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading<?php echo $i; ?>">
                        <h4 class="panel-title">
                            <a  role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" 
                              <?php if($i ==1){ ?>
                              class="accordion-toggle" aria-expanded="true"
                         <?php }else{ ?>
                          class="accordion-toggle collapsed" aria-expanded="false"
                         <?php } ?>              
                              
                               aria-controls="collapse<?php echo $i; ?>"><?php echo $spec['specification_title']; ?></a>
                        </h4>
                    </div>
                    <div id="collapse<?php echo $i; ?>" 
                         <?php if($i ==1){ ?>
                              class="panel-collapse collapse in"
                         <?php }else{ ?>
                          class="panel-collapse collapse"
                         <?php } ?>                        
                         role="tabpane<?php echo $i; ?>" aria-labelledby="heading<?php echo $i; ?>">
                        <div class="panel-body">
                           <?php echo $spec['specification_content']; ?>
                        </div>
                    </div>
                </div>
                            <?php 
                            $i++; 
                            }
                           
                        } ?>
               
            </div>
        </div>
    </div> 
</div>

<!-- Product Gallery
================================================== -->
<!--<div class="products-gallery" id="gallery">
    <div class="container ">
        <div class="row"><div class="header-wrapper"><h2>Gallery</h2></div></div>
        <div class="row">
            <div class="product-slider">
                <div class="slide"><img src="<?php // echo get_template_directory_uri() ?>/img/product-img-1.png"></div>
                <div class="slide"><img src="<?php // echo get_template_directory_uri() ?>/img/product-img-2.png"></div>
                <div class="slide"><img src="<?php // echo get_template_directory_uri() ?>/img/product-img-3.png"></div>
                <div class="slide"><img src="<?php // echo get_template_directory_uri() ?>/img/product-img-4.png"></div>
                <div class="slide"><img src="<?php // echo get_template_directory_uri() ?>/img/product-img-.png"></div>
            </div>
        </div>
    </div> 
</div>-->
<?php 
 $product_gallery_image = get_field('single_gallery' );
 
                    if($product_gallery_image != ''){
                        ?>

<div class="products-gallery" id="gallery">
        <div class="container ">
            <div class="row"><div class="header-wrapper"><h2>Gallery</h2></div></div>
            <div class="row">
                <div class="product-slider">
                     <?php
                     foreach( $product_gallery_image as $pro_gallery ){
                     $pro_gallery_new = $pro_gallery['url'];
                     
                    ?>
                    <div class="slide">
                        <a class="fancybox gallery_links" data-fancybox-group="gallery" data-fancybox-type ="image" data-thumbnail="<?php echo $pro_gallery_new ;?>" href="<?php echo get_template_directory_uri() . "/timthumb.php?src=" . $pro_gallery_new. "&a=t&w=500&h=300&zc=1" ?>">
                     <?php
                     echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . $pro_gallery_new. "&a=t&w=300&h=200&zc=1' alt=''>";
                     ?>
                     </a>    
                    </div>
                    
                    <?php } ?>
                    
                </div>
            </div>
        </div> 
    </div>
 <?php } ?>

<!--============================================================Product gallery modal======================================================================================================-->
    



<!-- Product Download Brouchre
================================================== -->
<div class="product-brouchre" id="brouchure">
    <div class="container ">
        <div class="row">
            <div class="">
                <p><a class="btn btn-lg btn-primary" href="<?php echo get_field('download_link'); ?>" role="button">Download Brochure</a></p>
            </div>
        </div>
    </div> 
</div>

<!-- Product Where to buy
================================================== -->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
 <input class="path_link" type="hidden" value="<?php echo bloginfo('template_url'); ?>"/>
<div class="product-wheretobuy" id="wheretobuy">
    <div class="container ">
        <div class="row"><div class="header-wrapper"><h2>Where to buy</h2></div></div>
        <div class="col-sm-5 deal_view EqHeightDiv">
        <?php
        $post_id= $post->ID;
      
        $dealer_lst = get_field('dealers_list', $post_id);
          if(isset($dealer_lst)){
            foreach($dealer_lst as $p_id4){
               $ids_a = $p_id4->ID;
               $ids_a = array($ids_a);
                $ids_a = implode(',', $ids_a);
              $args = array(
                    'orderby' => 'post_date',
                    'category' => '',
                    'order' => 'DESC',
                    'post_type' => 'dealer',
                    'post_status' => 'publish',
                    'include' => $ids_a
                  );
                     $post_ids = get_posts($args);
                        foreach ($post_ids as $_post1) {
                               if (has_post_thumbnail($_post1->ID)) {
                        $url = wp_get_attachment_image_src(get_post_thumbnail_id($_post1->ID), 'full');
                    } 
                        $sin_p = $_post1->ID;
                        $address = get_field('address_d',$sin_p);
                        $address1 = $address['address'];
                        $lat = $address['lat'];
                        $lng = $address['lng'];
                        $c_nm =  get_field('company_name',$sin_p);
                        $telephone_d =  get_field('telephone_d',$sin_p);
                        $email_d =  get_field('email_d',$sin_p);
                        $webiste_d =  get_field('webiste_d',$sin_p);
                        $query_[]=array($address1,$lat,$lng,$key,$c_nm,$telephone_d,$email_d,$webiste_d);       
                        ?>
        <div class="company-info">
                <img src="<?php echo get_template_directory_uri() ?>/img/wheretobuy-logo.png" class="img-responsive" alt="Responsive image" align=left>
                <h5><?php echo $c_nm; ?></h5>
                <p style="margin-bottom:0;"><?php echo $address1; ?></br>
                    T: <?php echo $telephone_d; ?></br>
                    E: <?php echo $email_d; ?></br>
                    W: <a href="<?php echo $webiste_d; ?>" target="_blank"><?php echo $webiste_d; ?></a>
                </p>
            </div>
        
                            <?php 
                    } 
                    } 
                    } 
                    
        ?>
        
   <script type="text/javascript">     
 google.maps.event.addDomListener(window, 'load', init);
    function init() {
//        console.log('saasas');
        var locations = JSON.parse('<?php echo json_encode($query_); ?>');
        var mapOptions = {
            zoom: 4,
            center: new google.maps.LatLng(-25.368268, 135.357241), // australia
            styles: [{"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#e9e9e9"}, {"lightness": 17}]}, {"featureType": "landscape", "elementType": "geometry", "stylers": [{"color": "#f5f5f5"}, {"lightness": 20}]}, {"featureType": "road.highway", "elementType": "geometry.fill", "stylers": [{"color": "#ffffff"}, {"lightness": 17}]}, {"featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{"color": "#ffffff"}, {"lightness": 29}, {"weight": 0.2}]}, {"featureType": "road.arterial", "elementType": "geometry", "stylers": [{"color": "#ffffff"}, {"lightness": 18}]}, {"featureType": "road.local", "elementType": "geometry", "stylers": [{"color": "#ffffff"}, {"lightness": 16}]}, {"featureType": "poi", "elementType": "geometry", "stylers": [{"color": "#f5f5f5"}, {"lightness": 21}]}, {"featureType": "poi.park", "elementType": "geometry", "stylers": [{"color": "#dedede"}, {"lightness": 21}]}, {"elementType": "labels.text.stroke", "stylers": [{"visibility": "on"}, {"color": "#ffffff"}, {"lightness": 16}]}, {"elementType": "labels.text.fill", "stylers": [{"saturation": 36}, {"color": "#333333"}, {"lightness": 40}]}, {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {"featureType": "transit", "elementType": "geometry", "stylers": [{"color": "#f2f2f2"}, {"lightness": 19}]}, {"featureType": "administrative", "elementType": "geometry.fill", "stylers": [{"color": "#fefefe"}, {"lightness": 20}]}, {"featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{"color": "#fefefe"}, {"lightness": 17}, {"weight": 1.2}]}]
        };
        var mapElement = document.getElementById('map');
        var map = new google.maps.Map(mapElement, mapOptions);

        var infowindow = new google.maps.InfoWindow();
        var marker, i;
        var iconBase = $('.path_link').val();
        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon: iconBase + '/img/marker_small.png'
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent('<div class="info_wrap"><div class="header"><div class="arrow-up"></div><h4 class="uppercase">DEALERSHIP DETAILS</h4></div><div class="details"><h4 class="uppercase">' + locations[i][4] + '</h4><div>T: ' + locations[i][5] + '</div><div>E: ' + locations[i][6] + '</div><div>W: ' + locations[i][7] + '</div><button type="submit" class="btn btn-default direct_bb">DIRECTIONS</button></div></div>');
                    infowindow.open(map, marker);
                }                   
            })(marker, i));
        }
    }
    </script>
    <style>
        .sing_map #map{
            height:145px;
        }
    </style>
    </div>
      <div class="col-sm-7 sing_map EqHeightDiv">
      <div id="map" class="EqHeightDiv" style="min-height:140px;width:100%;"></div>
      </div>
<!--        <div class="row">
            <div class="col-sm-5 company-info">
                <img src="<?php // echo get_template_directory_uri() ?>/img/wheretobuy-logo.png" class="img-responsive" alt="Responsive image" align=left>
                <h5>Brisbane water caravans</h5>
                <p>176-180 Bellarine Highway</br>
                    Newcomb, Geelong.</br>
                    T: 0466 186 386</br>
                    E: bwcaravans@hotmail.com</br>
                    W: <a href="www.brisbanewaterrvs.com.au" target="_blank">www.brisbanewaterrvs.com.au</a>
                </p>
            </div>
            <div class="col-sm-7 ">
                <input class="path_link" type="hidden" value="<?php // echo bloginfo('template_url'); ?>"/>
                <?php
//                $Address = get_field('where_to_buy_adderss', get_the_ID());
//                $Address = urlencode($Address);
//                $request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=" . $Address . "&sensor=true";
//                $xml = simplexml_load_file($request_url) or die("url not loading");
//                $status = $xml->status;
//                if ($status == "OK") {
//                    $Lat = $xml->result->geometry->location->lat;
//                    $Lon = $xml->result->geometry->location->lng;
//                    $LatLng = "$Lat,$Lon";
//                }
                ?>
                <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
                <script type="text/javascript">
                    google.maps.event.addDomListener(window, 'load', init);
                    function init() {
                        var mapOptions = {
                            zoom: 11,
                            center: new google.maps.LatLng(<?php // echo $LatLng; ?>), // New York
                            styles: [{"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#e9e9e9"}, {"lightness": 17}]}, {"featureType": "landscape", "elementType": "geometry", "stylers": [{"color": "#f5f5f5"}, {"lightness": 20}]}, {"featureType": "road.highway", "elementType": "geometry.fill", "stylers": [{"color": "#ffffff"}, {"lightness": 17}]}, {"featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{"color": "#ffffff"}, {"lightness": 29}, {"weight": 0.2}]}, {"featureType": "road.arterial", "elementType": "geometry", "stylers": [{"color": "#ffffff"}, {"lightness": 18}]}, {"featureType": "road.local", "elementType": "geometry", "stylers": [{"color": "#ffffff"}, {"lightness": 16}]}, {"featureType": "poi", "elementType": "geometry", "stylers": [{"color": "#f5f5f5"}, {"lightness": 21}]}, {"featureType": "poi.park", "elementType": "geometry", "stylers": [{"color": "#dedede"}, {"lightness": 21}]}, {"elementType": "labels.text.stroke", "stylers": [{"visibility": "on"}, {"color": "#ffffff"}, {"lightness": 16}]}, {"elementType": "labels.text.fill", "stylers": [{"saturation": 36}, {"color": "#333333"}, {"lightness": 40}]}, {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {"featureType": "transit", "elementType": "geometry", "stylers": [{"color": "#f2f2f2"}, {"lightness": 19}]}, {"featureType": "administrative", "elementType": "geometry.fill", "stylers": [{"color": "#fefefe"}, {"lightness": 20}]}, {"featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{"color": "#fefefe"}, {"lightness": 17}, {"weight": 1.2}]}]
                        };
                        var mapElement = document.getElementById('map');
                        var map = new google.maps.Map(mapElement, mapOptions);
                        var iconBase = $('.path_link').val();
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(<?php // echo $LatLng; ?>),
                            map: map,
                            title: 'Snazzy!',
                            icon: iconBase + '/img/marker.png'
                        });
                    }
                </script> 
                <div id="map" style="height:142px;width:100%;"></div>
            </div>
        </div>-->
    </div> 
</div>

<!-- Product Specifications Modal
================================================== -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                <h4 class="modal-title uppercase" id="myModalLabel">tech specs</h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <tbody>
                        <?php
                        $spec_pops = get_field('tech_spec_popup');
                        if ($spec_pops) {
                            foreach ($spec_pops as $spec_pop) {
                                ?>    
                                <tr>
                                    <td><?php echo $spec_pop['spec_title1']; ?></td>
                                    <td><?php echo $spec_pop['spec_value'] ?></td>
                                </tr>		
                            <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
              <?php echo get_field('tech_spec_popup_footer'); ?>
            </div>
        </div>
    </div>
</div>




<?php
get_footer();
?>