<footer>
    <!-- Footer Section  1
    ================================================== -->
    <div class="firs-section" >
        <div class="container footer_main_continer">
            <div class="row">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'menu_class' => 'footer footer-navbar-nav ')
                );
                ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="social-icons">
                        <a class="s-icons icon-fb" href="<?php cedo_get_option('cedo_fb_link') ?>"></a>
                        <a class="s-icons icon-tw" href="<?php cedo_get_option('cedo_tw_link') ?>"></a>
                        <a class="s-icons icon-yt" href="<?php cedo_get_option('cedo_yt_link') ?>"></a>
                        <a class="s-icons icon-ig" href="<?php cedo_get_option('cedo_ins_link') ?>"></a>
                    </div>
                    <h4>Newsletter</h4>
                    <form>
                        <div class="form-group">
                            <input type="name" class="form-control f_name input_val_1" id="exampleInputEmail1" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control email1 input_val_1" id="exampleInputEmail1" placeholder="Enter you email">
                        </div>
                        <button type="submit" class="btn btn-default send_ns">Submit</button>
                    </form>
                </div>
            </div>
        </div> 
    </div>
    <!-- Footer Section  2
    ================================================== -->
    <div class="second-section" >
        <div class="container-fluid footer_main_continer">
            <div class="col-sm-12">
                <div class="row line-a">
                    <div class="container">
                        <div class="row">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'footer-bottom-menu',
                                'menu_class' => 'footer-bottom-bar'
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row line-b">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 no_pd left_ft">
                                <span href="#"><?php echo cedo_get_option('cedo_copy_txt'); ?> <?php echo date('Y'); ?>.</span>
                                <br>
                                <span><?php echo cedo_get_option('cedo_cra_txt'); ?><a target="_blank" href="<?php echo cedo_get_option('cedo_cra_lnk'); ?>">&nbsp;<?php echo cedo_get_option('cedo_cra_company'); ?></a></span>
                            </div>
                            <div class="col-md-3 no_pd right_ft">
                                <div class="certified">
                                    <a href="<?php echo get_permalink(cedo_get_option('cedo_ac_id')); ?>" target="_blank"><span class="certified-logo pull-right"></span></a>
                                    <p><a href="<?php echo get_permalink(cedo_get_option('cedo_ac_id')); ?>" target="_blank" style="color:#ffffff"> CHECK OUR </br>ACCREDIATIONS </a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 ">
            </div>
        </div>
    </div>
</footer>

<a href="#0" class="cd-top">Top</a>
<!--<div class="search_big mk-fullscreen-search-overlay mk-fullscreen-search-overlay-show">
                                <i class="mk-fullscreen-close glyphicon glyphicon-remove"></i>
                                <div id="mk-fullscreen-search-wrapper">
                                        <p>Start typing and press Enter to search</p>
                                        <form action="#" id="mk-fullscreen-searchform" method="get">
                        <input type="text"  name="s" value="">
                        <i class="mk-icon-search fullscreen-search-icon"><input type="submit" value=""></i>
                            </form>                                        
                                        <form role="search" method="get" id="searchform" class="searc" action="<?php // echo home_url('/');  ?>">
                                <div class="ui-widget">
                                    <i class="mk-icon-search fullscreen-search-icon"> <input type="submit" id="searchsubmit" value=""  class="search_btn"/></i>
                                    <input id="tags" type="text" class="search_input"  value="" name="s"   placeholder="Search Here"/>
                                    
                                </div>
                                </form>
                                </div>
                        </div>-->
<!--<div class="search_big mk-fullscreen-search-overlay mk-fullscreen-search-overlay-show">
                                <i class="mk-fullscreen-close glyphicon glyphicon-remove"></i>
                                <div id="mk-fullscreen-search-wrapper">
                                        <p>Start typing and press Enter to search</p>
                                        <form role="search" method="get" id="searchform" class="searc" action="<?php // echo home_url('/');  ?>">
                                <div class="ui-widget">
                                    <i class="mk-icon-search fullscreen-search-icon"> <input type="submit" id="searchsubmit" value=""  class="search_btn"/></i>
                                    <input id="tags" type="text" class="search_input"  value="" name="s"   placeholder="Search Here"/>
                                    
                                </div>
                                </form>
                                </div>
                        </div>-->

<script type="text/javascript">
//    jQuery(document).ready(function() {
//        var newHeight = jQuery(window).height() -90;
//        //console.log(newHeight);
//        jQuery(".html * .ls-container img, body * .ls-container img, #ls-global * .ls-container img").css("height", newHeight);
//    });
//    
//    jQuery(window).resize(function(){
//        var newHeight2 = jQuery(window).height() -90;
//        //console.log(newHeight);
//        jQuery(".html * .ls-container img, body * .ls-container img, #ls-global * .ls-container img").css("height", newHeight2);
//    });

</script>
</body>
</html>