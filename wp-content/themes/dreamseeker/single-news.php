  <?php
get_header();
global $post;
?> 

<script type="text/javascript">
//    jQuery(document).ready(function(){
//       jQuery(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390}); 
//       jQuery('#news_share').click(function(){
//       jQuery('.addthis_sharing_toolbox').slideToggle( "slow" );
//});
//
//    jQuery( ".news_video_image" ).click(function() {
//    jQuery( ".youtube" ).trigger( "click" );
//});
//
//    });
</script>



  <!-- Second Navigation
    ================================================== -->
    <nav class="navbar navbar-inverse navbar-top second-navbar hidden-xs" role="navigation">
      <div class="container-fluid">
        <div id="navbar" class="navbar-collapse collapse navbar-second">
        <?php wp_nav_menu(array(
            'theme_location' => 'sub-menu-whatson',
            'menu_class'     => 'nav navbar-nav navbar-right'
        )); ?>
        </div>
      </div>
    </nav>
    
    <!-- News Article intro
    ================================================== -->
    
            <?php 
            $single_news_date = $post->post_date;
            $single_date_new = date('d-m-Y',strtotime($single_news_date));
            $single_news_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
            $single_news_title = $post->post_title;
            $single_news_content = $post->post_content;
            
            $args = array(
            'posts_per_page' => -1,
            'offset' => 0,
            'orderby' => 'post_date',
            'category' => '',
            'post_type' => 'news',
            'post_status' => 'publish',
            'order' => 'DESC'
            );
            
            $pagelist = get_posts( $args );
            $pages = array();
            foreach ($pagelist as $page) {
            $pages[] += $page->ID;
            }

            $current = array_search(get_the_ID(), $pages);
            $prevID = $pages[$current-1];
            $nextID = $pages[$current+1];
            ?>
    
    <?php 
    if($prevID == null){ ?>
     <script type="text/javascript"> 
         jQuery(document).ready(function(){
         jQuery('#news_art_prev') .css('display','none');
         jQuery('#news_art_nxt') .css('display','inline');
         });
     </script>
    <? }else if($nextID == null){?>
    <script type="text/javascript"> 
         jQuery(document).ready(function(){
         jQuery('#news_art_nxt') .css('display','none');
         jQuery('#news_art_prev') .css('display','inline');
         });
     </script>
    <?php }else{ ?>
     <script type="text/javascript"> 
         jQuery(document).ready(function(){
         jQuery('#news_art_nxt') .css('display','inline');
         jQuery('#news_art_prev') .css('display','inline');
         });
     </script>
    <?php } ?>
     <style>
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }
    </style>

    <script>
        
    jQuery(document).ready(function() {
      jQuery("#owl-demo").owlCarousel({
      navigation : true,
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem : true,
      rewindNav : false
      });
          jQuery(".fancybox").fancybox({
        'width':900,
         'autoSize' : false,
          'prevEffect': 'none',
          'nextEffect': 'none',
          'openEffect':   'fade' ,  
         'title' :'Gallery',
          helpers: {
    overlay: {
      locked: false
    }
  }
     });
      jQuery("a[rel^='prettyPhoto']").prettyPhoto();
      
      jQuery('.img_zoom').click(function(){
          jQuery(this).parent().parent().find('a img').trigger('click');
      });
       jQuery('.vdo_play_btn').click(function(){
           jQuery('.view_vdo').trigger('click');
       });       
    });
    </script>
    
    <div class="news-article-intro news_main_item single_nitem">
        <div class="container ">
            <div class="date-location">
               <div class="main_news_location"> AUSTRALIA </div>
                    <span class="main_news_seperator"></span> 
                <div class="main_news_date"><?php echo $single_date_new; ?></div>
            </div>
            
            <h1><?php echo $single_news_title; ?></h1>
            <a href="<?php echo get_permalink(12); ?>" class="pull-right backto-news">BACK TO NEWS ></a>
            <div class="clearfix"></div>
              <div class="news-intro-img">
                  <?php 
                    if (has_post_thumbnail($post->ID)) {
                                    $url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');                                
                    ?>
                  <img src="<?php echo $url[0]; ?>" class="img-responsive"/>
                    <?php } ?>
              </div>
            <div class="news-intro-txt">
                <p><?php echo $single_news_content; ?></p>
            </div>
        </div>
    </div>

    <!-- Article Video
    ================================================== -->
      <?php 
                $news_vdieotit = get_field('video_title');
                $news_videodesc = get_field('video_description');
                $news_videoimage = get_field('video_image');
                $news_video_link = get_field('video_link');
                if($news_vdieotit !=''||$news_videodesc!=''||$news_videoimage!=''||$news_video_link!=''){
                ?>
    <div class="article-video" >
        <div class="container ">
            <div class="row">              
                <div class="col-md-6 news_video_image">
                    <?php
                     echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . $news_videoimage['url'] . "&a=t&w=824&h=542&zc=1' alt=''>";
                    ?><?php if($news_videoimage !=''){?>
                         <div class="vdo_play_btn"></div>
                  <?php }else{  } ?>                        
                </div>
                <div class="col-md-6 extra-padding">
                    <h2><?php echo $news_vdieotit; ?></h2>
                    <p><?php echo $news_videodesc; ?></p>
                     <p><a class="btn btn-lg btn-primary watch_video_class view_vdo" href="#" role="button" data-toggle="modal" data-target="#video_modl" role="button"><i class="fa  fa-play"></i> watch video</a></p>
                                   <!--<p><a class="youtube btn btn-lg btn-primary" href="<?php // echo $news_video_link; ?>" title="<?php // echo $news_vdieotit; ?>"><i class="fa  fa-play"></i> watch video</a></p>-->
                </div>
            </div>
        </div> 
    </div>
<?php } ?>
    <div class="modal fade bs-example-modal-lg layoutmodal video_modal_class" id="video_modl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg dreamseeker-gallery" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                <h4 class="modal-title uppercase" id="myModalLabel"><?php echo($post->post_title); ?> Video</h4>
              </div>
                <div class="modal-body" id="yt-player">
                   <iframe id="sin_p_frm" src="<?php echo $news_video_link; ?>?rel=0&enablejsapi=1" frameborder="0"></iframe>
                </div>
            </div>
        </div>
</div>

    <!-- News Article Image Gallery
    ================================================== -->
    <?php 
     $product_gallery_image = get_field('post_images' );
    if($product_gallery_image !='') {?>
    <div class="news-article-gallery">
        <div class="container ">
            <div class="news-intro-img owl-slider" id="owl-demo" >
                  <?php 
                    //var_dump(count($product_gallery_image));
                    $i = 0;
                    foreach( $product_gallery_image as $pro_gallery ){
                     $pro_gallery_new = $pro_gallery['url'];
                     $i=$i+1;
                    ?>
                    <div class="item news_gall">
                    <?php
                    echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . $pro_gallery_new . "&a=t&w=1392&h=909&zc=1' alt=''>";
                    ?>
                        <div class="owl-button-gall">
                            <div class="owl-pre-g">&nbsp;</div>
                            <div class="gl-count"><?php echo $i."/". count($product_gallery_image)?></div>
                            <div class="owl-nex-g">&nbsp;</div>
                            <!--<div class="img_zoom"><i class="new_exp"></i></div>-->
                            <div class="img_share"><a id="news_share2<?php echo $i; ?>" class="news_shr"><i class="icon-share news_ic"></i></a></div>
                        </div>
                        <div class="share_icons_wrapper">
                        <div class="addthis_sharing_toolbox galo" style="display:none;"></div>
                        </div>
                    </div>
                    <?php 
                    
                    } ?>

            </div>
<!--            <img src="<?php // echo get_template_directory_uri() ?>/img/article-image-set.jpg" class="img-responsive" />-->
        </div>
    </div>
    <?php }else{} ?>
    <!-- News Article links
    ================================================== -->
<!--    <div class="news-article-links">
        <div class="container ">
            <div class="pull-left">
                <a id="news_share" class="article-links  black-link uppercase"><i class="icon-share"></i> SHARE ARTICLE</a>
                <div class="share_icons_wrapper">
                <div class="addthis_sharing_toolbox art" style="display:none;"></div>
                </div>
            </div>
             <div class="pull-right">
                <a href="<?php // echo get_permalink($prevID); ?>" class="article-links gray-link uppercase" id="news_art_prev">
                    <i class="fa fa-angle-left"></i> previous ARTICLE</a>
                <a href="<?php // echo get_permalink($nextID); ?>" class="article-links gray-link uppercase" id="news_art_nxt"> NEXT ARTICLE 
                    <i class="fa fa-angle-right"></i></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>-->
    
    <div class="news-article-links">
        <div class="container ">
            <div class="pull-left">
                <a id="news_share" class="article-links  black-link uppercase"><i class="icon-share"></i> SHARE ARTICLE</a>
                 <div class="share_icons_wrapper">
                <div class="addthis_sharing_toolbox art" style="display:none;"></div>
                </div>
            </div>
            <div class="pull-right">
                <a href="<?php echo get_permalink($prevID); ?>" class="article-links gray-link uppercase">
                    <i class="fa fa-angle-left"></i> previous ARTICLE</a>
                <a href="<?php echo get_permalink($nextID); ?>" class="article-links gray-link uppercase"> NEXT ARTICLE 
                    <i class="fa fa-angle-right"></i></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php
get_footer();
?>