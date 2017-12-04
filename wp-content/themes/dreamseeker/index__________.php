<?php
/*
  Template Name: Home
 */
get_header();
global $post;
?>

<script>
jQuery(document).ready(function(){
  jQuery(".carousel-indicators li:first").addClass("active");
  jQuery(".carousel-inner .item:first").addClass("active");
  jQuery('.carousel').carousel({
  interval: 3000
})
});
</script>


<!--
=============================================================================slider==================================================================================================
-->


<div class="container fill-top">
        <div id="myCarousel" class="carousel slide">
             <?php 
            $args = array(
            'posts_per_page' => -1,
            'offset' => 0,
            'orderby' => 'post_date',
            'category' => '',
            'post_type' => 'main_slider',
            'post_status' => 'publish',
            'order' => 'DESC'
            );
        
            $number = 0; ?>
      
             <ol class="carousel-indicators">
             <?php  $loop1 = get_posts($args);
             foreach($loop1 as $loop3){?>
             <li data-target="#myCarousel" data-slide-to="<?php echo $number++; ?>" > </li>
             <?php }  ?>
             </ol>
          
            <div class="scroll-down"><a href="#featured-products">scroll down <i class="fa fa-angle-down"></i></a></div>
            
            <div class="carousel-inner">
               <?php
           
             $loop = get_posts($args);
             foreach($loop as $loop2){
             $slider_image = wp_get_attachment_image_src(get_post_thumbnail_id($loop2->ID), 'full');
             $main_stitle = $loop2->post_title;
//           $main_stitle = get_field('slider_main_title',$loop2->ID);
             $main_sdesc = $loop2->post_content;
//           $main_sdesc = get_field('slider_description',$loop2->ID);
                if( have_rows('slider_link', $loop2->ID) ): 
                while( have_rows('slider_link',$loop2->ID) ): the_row(); 
                    $main_slink =  get_sub_field('slider_link_url'); 
                    $main_s_linkname =  get_sub_field('slider_link_name');
                endwhile;
                endif; 
              ?>  
             <!--start carousel items-->
             <div class="item">
              <div class="fill" style="background-image:url('<?php echo get_template_directory_uri() . "/timthumb.php?src=" . $slider_image[0] . "&a=t&w=1500&h=801&zc=1"; ?>');">
                <div class="container">
                    <div class="carousel-caption">
                      <h2><?php echo $main_stitle; ?></h2>
                      <p><?php echo $main_sdesc; ?></p>
                      <p><a class="btn btn-lg btn-primary" href="<?php echo $main_slink; ?>" role="button"><?php echo $main_s_linkname; ?></a></p>
                    </div>
                </div>
              </div>
             </div>
    
            <?php  }  ?>
           <!--end items-->
          </div>
        </div>
    </div>

 <!--============================== Featured Products=================================================================================================--> 

    <div class="featured-products" id="featured-products">
        <div class="container ">
            <div class="row">
                <div class="header-wrapper">
                    <?php $featured_product_title= get_post_meta(151,'featured_product_title',true); ?>
                    <h2><?php echo $featured_product_title; ?></h2>
                </div>
            </div>
            <div class="row">
                <?php 
            $argsproducts = array(
            'posts_per_page' => 3,
            'offset' => 0,
            'orderby' => 'post_date',
            'category' => '',
            'post_type' => 'products',
            'post_status' => 'publish',
            'order' => 'DESC',
            );
            $looppro = get_posts($argsproducts);
            foreach($looppro as $loop_product){
                $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($loop_product->ID), 'full');
                $product_title = $loop_product->post_title;
                $product_desc = $loop_product->post_content;
                 ?>
                <div class="col-sm-4 nopadding f-product-items">
                    <p><a href="#">
                        <?php
                        echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . $product_image[0] . "&a=t&w=500&h=300&zc=1' alt=''>";
                        ?>     
                        </a>
                    </p>
                    <h4><?php echo $product_title; ?></h4>
                    <p class="des"><?php echo $product_desc; ?></p>
                    <p><a class="view-more" href="#" role="button">View More</a></p>
                </div>
            <?php } ?>
            </div>
        </div> 
    </div>

    <!-- Latest News
    ================================================== -->
    <div class="latest-news-home" >
        <div class="container ">
            <div class="row">
                <div class="header-wrapper">
                    <?php $news_title= get_post_meta(151,'news_title',true); 
                    ?>
                    <h2><?php echo $news_title; ?> </h2>
                </div>
            </div>
            <div class="row">
            <?php 
//            news
            $news_heading = get_field('news_heading',151);
            $news_one = get_field('news_one',151);    
            $news_two = get_field('news_two',151);    
            $news_three = get_field('news_three',151); 
            
//            upcoming shows
            $upcoming_show_heading = get_field('upcoming_show_heading',151);    
            $upcoming_show_one = get_field('upcoming_show_one',151);    
            $upcoming_show_two = get_field('upcoming_show_two',151);    
            $upcoming_show_three = get_field('upcoming_show_three',151);  
            
//            media
            $media_heading = get_field('media_heading',151);    
            $media_news_one = get_field('media_news_one',151);    
            $media_news_two = get_field('media_news_two',151);    
            $media_news_three = get_field('media_news_three',151);    
                
                ?>
                <div class="col-md-4 nopadding news-items">
                    <h4><spa class="icons-news ico-news-feed"></spa><?php echo $news_heading; ?></h4>
                    <ul>
                        <li><?php echo $news_one; ?></li>
                        <li><?php echo $news_two; ?></li>
                        <li><?php echo $news_three; ?></li>
                    </ul>
                </div>
                <div class="col-md-4 nopadding news-items">
                    <h4><spa class="icons-news ico-upcoming-shows"></spa><?php echo $upcoming_show_heading; ?></h4>
                    <ul>
                        <li><?php echo $upcoming_show_one; ?></li>
                        <li><?php echo $upcoming_show_two; ?></li>
                        <li><?php echo $upcoming_show_three; ?></li>
                    </ul>
                </div>
                <div class="col-md-4 nopadding news-items">
                    <h4><spa class="icons-news ico-media"></spa><?php echo $media_heading; ?></h4>
                    <ul>
                        <li><?php echo $media_news_one; ?></li>
                        <li><?php echo $media_news_two; ?></li>
                        <li><?php echo $media_news_three; ?></li>
                    </ul>
                </div>
            </div>
        </div> 
    </div>

    <!-- Find a Dealer & Contact Us
    ================================================== -->
    <div class="calltoaction-home" >
        <div class="container ">
            <div class="row">
                <?php $find_dealer_btn= get_post_meta(151,'find_dealer_btn',true); ?>
                <?php $find_dealer_btn_link= get_post_meta(151,'find_dealer_btn_link',true); ?>
                <?php $contact_us_btn= get_post_meta(151,'contact_us_btn',true); ?>
                <?php $contact_us_btn_link= get_post_meta(151,'contact_us_btn_link',true); ?>
                <a class="btn btn-primary btn-lg" role="button" href="<?php echo $find_dealer_btn_link; ?>" target="_blank"><?php echo $find_dealer_btn; ?></a>
                <a class="btn btn-primary btn-lg" role="button" href="<?php echo $contact_us_btn_link; ?>" target="_blank"><?php echo $contact_us_btn; ?></a>
            </div>
        </div> 
    </div>
    
    <!-- Logos
    ================================================== -->
    <div class="logos-home" >
        <div class="container ">
            <div class="row">
                <div class="logo-wrapper"></div>
            </div>
        </div> 
    </div>

<?php get_footer(); ?>