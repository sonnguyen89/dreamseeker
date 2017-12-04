 <?php
/*
  Template Name: Latest News
 */
get_header();
global $post;
global $paged;
?> 

  <!-- Second Navigation
    ================================================== -->
    <nav class="navbar navbar-inverse navbar-top second-navbar hidden-xs" role="navigation">
      <div class="container">
        <div id="navbar" class="navbar-collapse collapse navbar-second">
<!--          <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#">news</a></li>
                <li><a href="#">upcoming shows</a></li>
          </ul>-->
<?php wp_nav_menu(array('theme_location' => 'sub-menu-whatson',
                        'menu_class'      => 'nav navbar-nav navbar-right')); ?>
        </div>
      </div>
    </nav>
    
    <!-- News  Hero Image
    ================================================== -->
    <div class="range-heroimg">
        <div class="container ">
            <div class="row">
                <h1>News</h1>
            </div>
        </div> 
    </div>
    
    <div class="news-list">
        <div class="container ">
            <div class="row">
                <div class="col-md-8 ">
              <?php
                $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                $argsnews = array(
                        'posts_per_page' => 2,
                        'offset' => 0,
                        'orderby' => 'post_date',
                        'category' => '',
                        'post_type' => 'news',
                        'post_status' => 'publish',
                        'paged' => $paged 
                );

            $the_query = new WP_Query( $argsnews );
            if ($the_query->have_posts()) : 
            while ($the_query->have_posts()) : $the_query->the_post(); 
            $length_you_want = '100px';
            $news_inner = get_post();
            $news_date = $news_inner->post_date;
            $date_new = date('d-m-Y',strtotime($news_date));
            $news_image = wp_get_attachment_image_src(get_post_thumbnail_id($news_inner->ID), 'full');
            $news_title = $news_inner->post_title;
            $news_content = $news_inner->post_content; ?>
        
                    <div class="news-item news_main_item">
                        <div class="date-location">
                           <div class="main_news_location"> AUSTRALIA </div>
                            <span class="main_news_seperator"></span> 
                            <div class="main_news_date"><?php echo $date_new; ?></div>
                        </div>
                        <h2><?php echo $news_title; ?></h2>
                        <div class="news-item-img pull-left">
                        <?php
                        echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . $news_image[0] . "&a=t&w=573&h=370&zc=1' alt=''>";
                        ?>
                        </div>
                        <div class="news-item-content">
                            <p><?php echo substr($news_content, 0, $length_you_want); ?>... </p> 
                            <button type="submit" class="btn btn-default ">More</button>
                            <!--<p>Kokoda welcomes the new Force V ‘bunk edition’ It is an off-road van fit for the whole family...</p> <button type="submit" class="btn btn-default ">More</button>-->
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                  <?php 
                        endwhile;
                         endif;  
                  ?> 
                   
                    <div class="news_pagination">
                    <?php
                    $big = 999999999;
                    echo paginate_links( array(
                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, get_query_var('paged') ),
                    'total' => $the_query->max_num_pages
                    ) );
                    ?>
                    </div>
                    
                </div>
                
                <div class="col-md-4 ">
                    <div class="fb-feed">
                        <div class="fb-title">
                            <h2>dreamseeker official</h2><div class="fb-logo pull-right"></div>
                        </div>
                        <div class="fb-feed-item">
                            <div class="fb-header">
                                <div class="company-logo pull-left">
                                    <img src="<?php echo get_template_directory_uri() ?>/img/dream-fb.jpg" class="img-responsive"/>
                                </div>
                                <div class="company-info">
                                    <div>Dreamseeker</div>
                                    <div>16-07-15</div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="fb-feed-content">
                                Kokoda welcomes the new Force V ‘bunk edition’ It is an off-road van fit for the whole family...
                            </div>
                            <div class="fb-feed-img"><img src="<?php echo get_template_directory_uri() ?>/img/fb-feed-img.jpg" class="img-responsive" </div>
                        </div>
                     </div>
                        <div class="fb-feed-item">
                            <div class="fb-header">
                                <div class="company-logo pull-left">
                                    <img src="<?php echo get_template_directory_uri() ?>/img/dream-fb.jpg" class="img-responsive"/>
                                </div>
                                <div class="company-info">
                                    <div>Dreamseeker</div>
                                    <div>16-07-15</div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="fb-feed-content">
                                Kokoda welcomes the new Force V ‘bunk edition’ It is an off-road van fit for the whole family...
                            </div>
                            <div class="fb-feed-img"><img src="<?php echo get_template_directory_uri() ?>/img/fb-feed-img.jpg" class="img-responsive" </div>
                        </div>
                     </div>
                        <div class="read-all uppercase"><a href="#">Read all</a></div>
                    </div>
                    <div class="yt-feed">
                        <div class="yt-title">
                            <h2>dreamseeker official</h2><div class="yt-logo pull-right"></div>
                        </div>
                        <div class="yt-feed-item">
                            <div class="yt-header">
                                <div class="company-logo pull-left">
                                    <img src="<?php echo get_template_directory_uri() ?>/img/dream-fb.jpg" class="img-responsive"/>
                                </div>
                                <div class="company-info">
                                    <div>Dreamseeker</div>
                                    <div>16-07-15</div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="yt-feed-content">
                                Dreamseeker welcomes the new Enforcer It is an off-road van packed with inclusions
                            </div>
                            <div class="yt-feed-img"><img src="<?php echo get_template_directory_uri() ?>/img/yt-feed-img.jpg" class="img-responsive" </div>
                        </div>
                     </div>
                        <div class="read-all uppercase"><a href="#">Read all</a></div>
                </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();
?>