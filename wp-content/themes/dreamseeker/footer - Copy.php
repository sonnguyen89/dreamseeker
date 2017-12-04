<footer>
       
    <!--====================================================================Footer Section One=====================================================================================-->
        <div class="firs-section" >
            <div class="container-fluid">
                <div class="row">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'footer-menu',
                        'menu_class'      => 'footer footer-navbar-nav ')
                     ); ?>
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
                            <input type="name" class="form-control" id="news_name" placeholder="Enter your name">
                          </div>
                          <div class="form-group">
                            <input type="email" class="form-control" id="news_email" placeholder="Enter you email">
                          </div>
                          <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
       
<!--================================================================Footer Section Two=========================================================================================-->
 <div class="second-section" >
            <div class="container-fluid">
                <div class="col-sm-12">
                    <div class="row line-a">
                       <?php wp_nav_menu(array(
                        'theme_location' => 'footer-bottom-menu',
                        'menu_class'      => 'footer-bottom-bar'
                         )); ?>
                    </div>
                    <div class="row line-b">
                        <span href="#"><?php echo cedo_get_option('cedo_copy_txt'); ?> <?php echo date('Y');?>.</span><span><?php echo cedo_get_option('cedo_cra_txt'); ?><a href="<?php echo cedo_get_option('cedo_cra_lnk'); ?>">&nbsp;<?php echo cedo_get_option('cedo_cra_company'); ?></a></span>
                    </div>
                </div>
                <div class="col-sm-3 certified">
                    <span class="certified-logo pull-right"></span>
                    <p>CHECK OUR </br>ACCREDIATIONS</p>
                </div>
            </div>
        </div>

    </footer>
<a href="#0" class="cd-top">Top</a>
<div class="search_big mk-fullscreen-search-overlay mk-fullscreen-search-overlay-show">
				<i class="mk-fullscreen-close glyphicon glyphicon-remove"></i>
				<div id="mk-fullscreen-search-wrapper">
					<p>Start typing and press Enter to search</p>
<!--					<form action="#" id="mk-fullscreen-searchform" method="get">
		        <input type="text"  name="s" value="">
		        <i class="mk-icon-search fullscreen-search-icon"><input type="submit" value=""></i>
			    </form>-->                                        
                                        <form role="search" method="get" id="searchform" class="searc" action="<?php echo home_url('/'); ?>">
                                <div class="ui-widget">
                                    <i class="mk-icon-search fullscreen-search-icon"> <input type="submit" id="searchsubmit" value=""  class="search_btn"/></i>
                                    <input id="tags" type="text" class="search_input"  value="" name="s"   placeholder="Search Here"/>
                                    
                                </div>
</form>
				</div>
			</div>
</body>
</html>
