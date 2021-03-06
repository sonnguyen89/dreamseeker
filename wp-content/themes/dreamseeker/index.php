<?php
get_header();
global $post;
?>
<?php $hm_id = cedo_get_option('cedo_home_id'); ?>
<script>
    jQuery(document).ready(function() {
        $("#banner-list").owlCarousel({

            navigation : true, // Show next and prev buttons
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem:true,
            mouseDrag:false,
            paginationNumbers: true,
            touchDrag : true,
        });


        $("#banner-list .owl-item img").click(function(event){
                var x = event.pageX;
                var y =  event.pageY;

                var half_point = $(window).width() / 2;

                if(x >= half_point )
                {
                    $("#banner-list").trigger('owl.next');
                }
                else
                {
                    $("#banner-list").trigger('owl.prev');
                }

            }
        );
        $(".hero-banner .banner-content").click(function(event){
                var x = event.pageX;
                var y =  event.pageY;

                var half_point = $(window).width() / 2;

                if(x >= half_point )
                {
                    $("#banner-list").trigger('owl.next');
                }
                else
                {
                    $("#banner-list").trigger('owl.prev');
                }

            }
        );
        $('.hero-banner .banner-content a').click(function(){
            //prevent trigger the event banner slide
            event.stopPropagation();

        });

        $(".hero-banner").mousemove(function(event)
        {
           //current mouse cursor position
           var x = event.pageX;
           var y =  event.pageY;

           var cursorEl = $('#banner_cursor');
           var cursorImageEl = $('#banner_cursor > img');

            // Apply translation (set to actual cursor position)
            cursorEl.css({
                transform : 'translate('+ x + 'px, ' + y + 'px)'
            });



            var half_point = $(window).width() / 2;

            if(x >= half_point )
            {
                var rotate_angle =  360;
                cursorImageEl.css({
                    transform : 'rotate('+ rotate_angle + 'deg)'
                });
            }
            else
            {
                var rotate_angle =   180;
                cursorImageEl.css({
                    transform : 'rotate('+ rotate_angle + 'deg)'
                });
            }
        }).mouseout(function(){

            var cursorEl = $('#banner_cursor');
            // Apply reset translation
            cursorEl.css({
                transform : ''
            });

        });
        $('.hero-banner .banner-content a').hover(
            function () {
                $('#banner_cursor').hide();
            },
            function () {
                $('#banner_cursor').show();
            }
        );
        $('.hero-banner .banner-list .owl-controls .owl-pagination').hover(
            function () {
                $('#banner_cursor').hide();
            },
            function () {
                $('#banner_cursor').show();
            }
        );

        $('.hero-banner .scroll-down').hover(
            function(){
                $('.hero-banner .scroll-down a img').attr('src','/wp-content/themes/dreamseeker/img/banner_down_icons_arrow_black.png');
            },
            function(){
                $('.hero-banner .scroll-down a img').attr('src','wp-content/themes/dreamseeker/img/banner_down_icons_arrow_white.png');
            }

        )
        var left_offset=  $('#navbar.main-navigation .main-navbar-content li:first-child').offset();
        $('.hero-banner .banner-content').css({'left' : left_offset.left + 12});
        $( window ).resize(function(){
            if($(window).width() > 776 )
            {
                var left_offset=  $('#navbar.main-navigation .main-navbar-content li:first-child').offset();
                $('.hero-banner .banner-content').css({'left' : left_offset.left + 12});
            }

        });
    });

</script>

<!-- =============== HERO BANNER =============== -->
<div class="hero-banner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-list" id="banner-list">
                    <?php if(get_field('home_hero_banner_image', $hm_id)): ?>
                        <div>
                            <div class="banner-content">
                                <?php the_field('home_hero_banner_text', $hm_id); ?>
                            </div>
                            <img src="<?php the_field('home_hero_banner_image', $hm_id); ?>" attr="banner 1" />
                            <div class="mobile-banner-content">
                                <?php the_field('home_hero_banner_text', $hm_id); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(get_field('home_hero_banner_image_2', $hm_id)): ?>
                        <div>
                            <div class="banner-content">
                                <?php the_field('home_hero_banner_text_2', $hm_id); ?>
                            </div>
                            <img src="<?php the_field('home_hero_banner_image_2', $hm_id); ?>" attr="banner 2" />
                            <div class="mobile-banner-content">
                                <?php the_field('home_hero_banner_text_2', $hm_id); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(get_field('home_hero_banner_image_3', $hm_id)): ?>
                        <div>
                            <div class="banner-content">
                                <?php the_field('home_hero_banner_text_3', $hm_id); ?>
                            </div>
                            <img src="<?php the_field('home_hero_banner_image_3', $hm_id); ?>" attr="banner 3" />
                            <div class="mobile-banner-content">
                                <?php the_field('home_hero_banner_text_3', $hm_id); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div id="banner_cursor"><img alt="Cursor Hand" src="/wp-content/themes/dreamseeker/img/banner_arrow.svg"></div>



                <div class="scroll-down scroll-slow">
                    <a href="#featured-products" ><img src="/wp-content/themes/dreamseeker/img/banner_down_icons_arrow_white.png" style="width:40px"/></a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- =============== Featured Products =============== -->
<div class="featured-products hm_fea" id="featured-products">
    <div class="container">
        <div class="row">
            <div class="header-wrapper">
                
                <?php $featured_product_title = get_field('featured_products_title', $hm_id); ?>
                <h2><?php echo $featured_product_title; ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="featured-products-wrapper">
            <?php
            $argsproducts = array(
                'posts_per_page' => -1,
                'offset' => 0,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
            );
            $looppro = get_posts($argsproducts);
            $featured_count = 0;

            foreach ($looppro as $loop_product) {
                $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($loop_product->ID), 'full');
                $product_title = $loop_product->post_title;
                $product_desc = $loop_product->post_content;
                $v_id = $loop_product->ID;
                $length_you_want = '300';

                $hh = get_field('featured_product', $v_id);

                if (isset($hh) && !empty($hh)) {
                    $featured_count++;
                    if ($hh = 'yes' && $featured_count < 4) {
                        ?>
                        <span class="col-md-4 f-product-items">
                             <a href="<?php echo get_permalink($loop_product->ID); ?>" >
                                <span class="feature_img_wrpper">
                                    <?php
                                    echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . $product_image[0] . "&a=t&w=500&h=300&zc=1' alt=''>";
                                    ?>

                                    <?php $badge_img = get_field('badge_image',$v_id); ?>
                                    <?php if(!empty($badge_img)): ?>
                                        <div class="badge-img" style="background-image:url('<?php echo $badge_img['url'] ?>')"></div>
                                    <?php endif; ?>
                                </span>
                                <span class="feature_desc_wrpper">
                                    <h4><?php echo $product_title; ?></h4>
                                    <span class="des EqHeightDiv2">
                                        <?php echo substr($product_desc, 0, $length_you_want); ?>
                                    </span>
                                </span>
                             </a>
                        </span>
                        <?php
                    }
                }
            }
            ?>

            </div>
        </div>
        <div class="row">
                <hr class="section-divider"/>
        </div>
    </div> 
</div>


<!--========================================================================Latest News===============================================================================-->

<div class="latest-news-home" >
    <div class="container-fluid">
        <div class="row">
            <?php $news_title = get_field('home_page_news_section_title', $hm_id); ?>
            <div class="header-wrapper">
                <div class="col-md-12 nopadding">
                <h2><?php echo $news_title; ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="news-home-wrapper">
                <?php
    //            news
                $news_heading = get_field('news_heading', $hm_id);
                $news_one = get_field('news_one', $hm_id);
                $news_two = get_field('news_two', $hm_id);
                $news_three = get_field('news_three', $hm_id);

    //            upcoming shows
                $upcoming_show_heading = get_field('upcoming_show_heading', $hm_id);
                $upcoming_show_one = get_field('upcoming_show_one', $hm_id);
                $upcoming_show_two = get_field('upcoming_show_two', $hm_id);
                $upcoming_show_three = get_field('upcoming_show_three', $hm_id);

    //            media
                $media_heading = get_field('media_heading', $hm_id);
                $media_news_one = get_field('media_news_one', $hm_id);
                $media_news_two = get_field('media_news_two', $hm_id);
                $media_news_three = get_field('media_news_three', $hm_id);
                ?>
                <div class="col-md-4 nopadding news-items">
                    <a href="<?php echo get_permalink(cedo_get_option('cedo_nw_id')); ?>">
                    <!--<h4><span class="col_3_hd_sc"><span class="icons-news ico-news-feed"></span><span class="tx_hd_wrp"><?php // echo $news_heading;      ?></span></span></h4>-->
                        <span class="icon_aa"><?php echo $news_heading; ?></span>
                        <ul class="hm_col_3_ul">
                            <?php if(!empty($news_one)): ?>
                                <li><?php echo $news_one; ?></li>
                            <?php endif; ?>
                            <?php if(!empty($news_two)): ?>
                                <li><?php echo $news_two; ?></li>
                            <?php endif; ?>
                            <?php if(!empty($news_three)): ?>
                                <li><?php echo $news_three; ?></li>
                            <?php endif; ?>
                        </ul>
                    </a>
                </div>
                <div class="col-md-4 nopadding news-items">
                    <a href="<?php echo get_permalink(cedo_get_option('cedo_us_id')); ?>">
                        <span class="icon_bb"><?php echo $upcoming_show_heading; ?></span>
                        <ul class="hm_col_3_ul">
                            <?php if(!empty($upcoming_show_one)): ?>
                                <li><?php echo $upcoming_show_one; ?></li>
                            <?php endif; ?>
                            <?php if(!empty($upcoming_show_two)): ?>
                                <li><?php echo $upcoming_show_two; ?></li>
                            <?php endif; ?>
                            <?php if(!empty($upcoming_show_three)): ?>
                                <li><?php echo $upcoming_show_three; ?></li>
                            <?php endif; ?>
                        </ul>
                    </a>
                </div>
                <div class="col-md-4 nopadding news-items">
                    <a href="<?php echo get_permalink(cedo_get_option('cedo_md_id')); ?>">
                        <span class="icon_cc"><?php echo $media_heading; ?></span>
                        <ul class="hm_col_3_ul">
                            <?php if(!empty($media_news_one)): ?>
                                <li><?php echo $media_news_one; ?></li>
                            <?php endif; ?>
                            <?php if(!empty($media_news_two)): ?>
                                <li><?php echo $media_news_two; ?></li>
                            <?php endif; ?>
                            <?php if(!empty($media_news_three)): ?>
                                <li><?php echo $media_news_three; ?></li>
                            <?php endif; ?>
                        </ul>
                    </a>
                </div>
            </div>
        </div>
    </div> 
</div>


<!--======================================================================Find a Dealer and Contact Us===========================================================================================-->

<div class="calltoaction-home" >
    <div class="container ">
        <div class="row">
            <?php $find_dealer_btn = get_field('home_page_find_a_dealer_button_title', $hm_id) ?>
            <?php $find_dealer_btn_link = get_field('home_page_find_a_dealer_link_id', $hm_id) ?>
            <?php $contact_us_btn = get_field('home_page_contact_us_button_title', $hm_id) ?>
            <?php $contact_us_btn_link = get_field('home_page_contact_us_link_id', $hm_id) ?>
            <a class="btn btn-primary btn-lg" role="button" href="<?php echo get_permalink($find_dealer_btn_link); ?>"><?php echo $find_dealer_btn; ?></a>
            <a class="btn btn-primary btn-lg" role="button" href="<?php echo get_permalink($contact_us_btn_link); ?>"><?php echo $contact_us_btn; ?></a>
        </div>
    </div> 
</div>

<!--===========================================================================Logos======================================================================================================-->

<div class="logos-home" >
    <div class="container ">
        <div class="row">
            <div class="logo-wrapper">
                <div class="logo-img-content">
                    <img src="/wp-content/themes/dreamseeker/img/home_icons_black-01.png" alt="home icon 1"/>
                   <p>AUSTRALIA MADE</p>
                </div>
                <div class="logo-img-content">
                    <img src="/wp-content/themes/dreamseeker/img/home_icons_black-02.png" alt="home icon 2"/>
                    <p>NATIONWIDE WARRANTY</p>
                </div>
                <div class="logo-img-content">
                    <img src="/wp-content/themes/dreamseeker/img/home_icons_black-03.png" alt="home icon 3"/>
                    <p>Satisfaction Guarantee</p>
                </div>

            </div>
        </div>
    </div> 
</div>

<?php get_footer(); ?>