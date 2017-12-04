  <?php
/*
  Template Name: News details
 */
get_header();
global $post;
?> 

  <!-- Second Navigation
    ================================================== -->
    <nav class="navbar navbar-inverse navbar-top second-navbar hidden-xs" role="navigation">
      <div class="container">
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
    <div class="news-article-intro">
        <div class="container ">
            <div class="date-location">AUSTRALIA <span>â€¢</span> 16-07-2015</div>
            <h1>New Realese Dreamseeker Vision </h1>
            <a href="#" class="pull-right backto-news">BACK TO NEWS ></a>
            <div class="clearfix"></div>
            <div class="news-intro-img"><img src="<?php echo get_template_directory_uri() ?>/img/new-full.jpg" class="img-responsive"/></div>
            <div class="news-intro-txt"><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p></div>
        </div>
    </div>
    

    <!-- Article Video
    ================================================== -->
    <div class="article-video" >
        <div class="container ">
            <div class="row">
                <div class="col-md-6"><img src="<?php echo get_template_directory_uri() ?>/img/article-video.jpg"/></div>
                <div class="col-md-6 extra-padding">
                    <h2>experience the thrill</h2>
                    <p>The Dreamseeker Inferno is a caravan without limits. Everything you need making the Inferno ready to take on anything.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button"><i class="fa  fa-play"></i> watch video</a></p>
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
                <a href="#" class="article-links  black-link uppercase"><i class="fa fa-share-alt"></i> SHARE ARTICLE</a>
            </div>
            <div class="pull-right">
                <a href="#" class="article-links gray-link uppercase">
                    <i class="fa fa-angle-left"></i> previous ARTICLE</a>
                <a href="#" class="article-links gray-link uppercase"> NEXT ARTICLE 
                    <i class="fa fa-angle-right"></i></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    
<?php
get_footer();
?>