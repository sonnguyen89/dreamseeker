  <?php
get_header();
global $post;
?> 

<script type="text/javascript">
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
    $(document).ready(function() {
      $("#owl-demo").owlCarousel({

      navigation : true,
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem : true


      });
    });
    $(document).ready(function () {
         $("a[rel^='prettyPhoto']").prettyPhoto();
//         $(".img_zoom").click(function(){
//     $(".news_gall a").trigger('click');
//      $("a[rel^='prettyPhoto']").prettyPhoto();
// });
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
<!--             <div id="demo">
        <div class="container">
          <div class="row">
            <div class="span12">
              <div id="owl-demo" class="owl-carousel">

                <div class="item"><img src="http://192.168.1.20/dreamseeker_wp/wp-content/themes/dreamseeker/timthumb.php?src=http://192.168.1.20/dreamseeker_wp/wp-content/uploads/2015/08/article-image-set.jpg&a=t&w=1392&h=909&zc=1" alt="The Last of us"></div>
                <div class="item"><img src="http://192.168.1.20/dreamseeker_wp/wp-content/themes/dreamseeker/timthumb.php?src=http://192.168.1.20/dreamseeker_wp/wp-content/uploads/2015/08/article-image-set.jpg&a=t&w=1392&h=909&zc=1" alt="GTA V"></div>
                <div class="item"><img src="http://192.168.1.20/dreamseeker_wp/wp-content/themes/dreamseeker/timthumb.php?src=http://192.168.1.20/dreamseeker_wp/wp-content/uploads/2015/08/article-image-set.jpg&a=t&w=1392&h=909&zc=1" alt="Mirror Edge"></div>

              </div>
            </div>
          </div>
        </div>
    </div>-->
            <div class="news-intro-img owl-slider" id="owl-demo" >
                  <?php 
                    $product_gallery_image = get_field('post_images' );
                    //var_dump(count($product_gallery_image));
                    $i = 0;
                    foreach( $product_gallery_image as $pro_gallery ){
                     $pro_gallery_new = $pro_gallery['url'];
                     $i=$i+1;
                    ?>
                    <div class="item news_gall">
                        
<a href="<?php echo $pro_gallery_new ?>" rel="prettyPhoto">
                     <?php
                    echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . $pro_gallery_new . "&a=t&w=1392&h=909&zc=1' alt=''>";
                    ?>
</a>
                        <div class="owl-button-gall"><div class="owl-pre-g">prev</div><div class="gl-count"><?php echo count($product_gallery_image)."/".$i?></div><div class="owl-nex-g">next</div><div class="img_zoom">zoom</div></div>
                    </div>
                    <?php 
                    
                    } ?>

            </div>
            <div class="news-intro-txt">
                <p><?php echo $single_news_content; ?></p>
            </div>
        </div>
    </div>

    <!-- Article Video
    ================================================== -->
    <div class="article-video" >
        <div class="container ">
            <div class="row">
                <?php 
                $news_vdieotit = get_field('video_title');
                $news_videodesc = get_field('video_description');
                $news_videoimage = get_field('video_image');
                $news_video_link = get_field('video_link');
                ?>
                <div class="col-md-6 news_video_image">
                    <?php
                     echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . $news_videoimage['url'] . "&a=t&w=824&h=542&zc=1' alt=''>";
                    ?>
                </div>
                <div class="col-md-6 extra-padding">
                    <h2><?php echo $news_vdieotit; ?></h2>
                    <p><?php echo $news_videodesc; ?></p>
                    <p><a class="youtube btn btn-lg btn-primary" href="<?php echo $news_video_link; ?>" title="<?php echo $news_vdieotit; ?>"><i class="fa  fa-play"></i> watch video</a></p>
                </div>
            </div>
        </div> 
    </div>

    <!-- News Article Image Gallery
    ================================================== -->
    <div class="news-article-gallery">
        <div class="container ">
            <img src="<?php echo get_template_directory_uri() ?>/img/article-image-set.jpg" class="img-responsive" />
        </div>
    </div>
    
    <!-- News Article links
    ================================================== -->
    <div class="news-article-links">
        <div class="container ">
            <div class="pull-left">
                <a id="news_share" class="article-links  black-link uppercase"><i class="fa fa-share-alt"></i> SHARE ARTICLE</a>
                <div class="share_icons_wrapper">
                <div class="addthis_sharing_toolbox" style="display:none;"></div>
                </div>
            </div>
             <div class="pull-right">
                <a href="<?php echo get_permalink($prevID); ?>" class="article-links gray-link uppercase" id="news_art_prev">
                    <i class="fa fa-angle-left"></i> previous ARTICLE</a>
                <a href="<?php echo get_permalink($nextID); ?>" class="article-links gray-link uppercase" id="news_art_nxt"> NEXT ARTICLE 
                    <i class="fa fa-angle-right"></i></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php
get_footer();
?>