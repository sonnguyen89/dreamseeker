	<?php 
/*
  Template Name: search_page
 */ 
?><?php 
	get_header();
        
        $sc_post = $wp_query->posts;
	$_tot_count=count($wp_query->posts);
	?> 
 <script type="text/javascript">
jQuery(document).ready(function(){
           jQuery.each(jQuery('.results-items'), function() {
               if (jQuery(this).attr('data-attr') !== 'products') {
                   jQuery(this).remove();
}  
});
var count = (jQuery('.results-items').length);    
jQuery('.sm_cou').text(count);
});     
 </script>
	<div class="search_list" style="min-height:150px;">
            <div class="search_top">
                 <div class="container ">
                      <div class="row">
            <h3>Results for <?php echo $_GET['s']; ?></h3>
            <small><span class="sm_cou"><?php echo $_tot_count; ?></span> Results Found!</small>
            </div>
            </div>
            </div>
<!--            <div class="range-disoption visible-lg" >
        <div class="container ">
            <div class="row">
                <p class="pull-right"><span class="optintxt uppercase">Viewing Options</span> <span class="colicon col3"></span> <span class="colicon col4"></span> <span class="colicon col1"></span></p>
            </div>
        </div> 
    </div>-->
       <div>
        <div class="container ">
            <div class="row scroll"> 
                 <?php
                if($_tot_count>0){
                  ?>
                <?php
	            foreach($wp_query->posts as $_post_q) {
                        if (has_post_thumbnail($_post_q->ID)) {
                        $url = wp_get_attachment_image_src(get_post_thumbnail_id($_post_q->ID), 'full');
                        $url1 = $url[0];
                    }else{
                        $url1 =  '';        
                    }     
	            ?>
                <div class="search_res results-items col-md-12 nopadding " data-attr="<?php echo $_post_q->post_type; ?>">
                    <a href="<?php echo get_permalink($_post_q->ID);?>">
                    <span class="left-col col-md-3">
                        <p>
                            
                                <?php
                                if($url1 != ''){
                echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . $url1 . "&a=t&w=350&h=260&zc=1' alt=''>";
                ?> <?php }else{
                echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . bloginfo('template_url') . "/img/unavailable.png&a=t&w=350&h=260&zc=1' alt=''>";
                    ?>
                               <?php } ?>
                        </p>
                    </span>
                    <span class="col-md-9">
                        <h4><?php echo $_post_q->post_title;?></h4>
                        <span class="sc_met">
                        <p>$<?php echo get_field('price_thousands', $_post_q->ID); ?>.<?php echo get_field('price_hundreds', $_post_q->ID); ?></p>
                      <?php echo get_field('search_fileds', $_post_q->ID); ?>
                  </span>
                        <!--<p class="des"><?php // echo substr($_post_q->post_content,0,150);?></p>-->
                        <!--<p><a class="view-more " href="<?php // echo get_permalink($_post_q->ID);?>" role="button">View More</a></p>-->
                    </span>
                    </a>

                </div> 
                 <?php
	            }
                    }
                    else{
                        ?>
                      <span class="span_errors">There is no results found.</span>
                          <?php
                    }
                ?>
            </div>
        </div> 
    </div>
            
	</div>  
	<?php
	get_footer();
	
