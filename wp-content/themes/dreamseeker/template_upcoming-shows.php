 <?php
/*
  Template Name: Upcoming shows
 */
get_header();
global $post;
?> 

   <!-- Second Navigation
    ================================================== -->
   <script type="text/javascript">
//       jQuery('document').ready(function(){
//           jQuery('.view_up_btn').click(function(e){
//               e.preventDefault();
//               jQuery(this).
//           })
//       });
   </script>
   
   <nav class="navbar navbar-inverse navbar-top second-navbar hidden-xs navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div id="navbar" class="navbar-collapse collapse navbar-second">
          <?php wp_nav_menu(array(
            'theme_location' => 'sub-menu-whatson',
            'menu_class'     => 'nav navbar-nav navbar-right'
            )); ?>
        </div>
      </div>
    </nav>
    
   <!--=====================================================upcoming show hero image=================================================================================================-->
    <div class="range-heroimg" style="background-image:url('<?php echo get_template_directory_uri() ?>/img/range-heroimg.jpg');">
        <div class="container ">
            <div class="row">
                <h1>Upcoming Shows</h1>
            </div>
        </div> 
    </div>
    
    
   <!--==============================================================Range filters================================================================================================================-->
    <div class="filters up_filt" >
        <div class="container ">
            <div class="row">
               <form class="form-inline"> 
               <div class="form-group">
                    <!--<div class="dealer_select_wraper">-->
                    <select name="upcom_month" class="form-control upcoming_months select_style" id="up_month">
                        <option value="all">All (Months)</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <!--</div>-->
                            <?php
//                            $price_key = "field_55d6d6be956d2";
//                            $price_field = get_field_object($price_key);
//                            
//                            if ($price_field) {
//                                
//                            echo '<select name="upcom_month" class="form-control upcoming_months" id="up_month">';
//                            foreach ($price_field['choices'] as $k => $v) {
//                            echo '<option value="' . $k . '">' . $v . '</option>';
//                            }
//                            echo '</select>';
//                            }
                            ?>                    
                          
                </div>
                <div class="form-group">
                    <!--<div class="dealer_select_wraper">-->
                           <?php
                            $price_key_two = "field_55d6d641956d1";
                            $price_field_two = get_field_object($price_key_two);
                            if ($price_key_two) {
                            
                            echo '<select name="upcom_state" class="form-control upcoming_sate select_style" id="up_state">';
                            foreach ($price_field_two['choices'] as $k => $v) {
                            echo '<option value="' . $k . '">' . $v . '</option>';
                            }
                            echo '</select>';
                            }
                            ?>
                <!--</div>-->
                </div>
                <div class="form-group find_up_c">
                    <button class="btn btn-default uppercase filter_upcomings" type="button" >Find</button>
                </div>
            </form>
            </div>
        </div> 
    </div>

    <!--==========================================================Display options=======================================================================================================-->
    <div class="range-disoption upcome_opt visible-lg" >
        <div class="container-fluid">
            <div class="row">
                <p class="pull-right" style="padding-right:15px;"><span class="optintxt uppercase">Viewing Options</span> <span class="colicon col1"></span> <span class="colicon col3"> </span> <span class="colicon col4"></span> </p>
            </div>
        </div> 
    </div>
    
   <!--=============================================================Range Results==============================================================================================-->
   
   <div class="upcoming-results" > 
        <div class="container-fluid events_sec_main">
            <div class="row">
                <div class="data-loading hide">
                    <p>Loading Results</br><img src="<?php echo get_template_directory_uri() ?>/img/bx_loader.gif"/></p>
                </div>
                <div class="append_res">
                <?php 
                    $argsevents = array(
                    'offset' => 0,
                    'orderby' => 'post_date',
                    'category' => '',
                    'post_type' => 'events',
                    'post_status' => 'publish',
                    'order' => 'DESC',
                    'posts_per_page'   =>9999,
                    );
                    $loopevent = get_posts($argsevents);
                    foreach($loopevent as $loop_event){
                    $event_image = wp_get_attachment_image_src(get_post_thumbnail_id($loop_event->ID), 'full');
                    $event_title = $loop_event->post_title;
                    $event_desc = $loop_event->post_content;
//                    $event_show_web_link = get_field('link_of_show_web_site',$loop_event->ID);
                    $event_image_title = get_field('upcoming_image_title',$loop_event->ID);
                    $event_website_name = get_field('webiste_d',$loop_event->ID);
                    $event_dealer_new = get_field('dealer_list',$loop_event->ID);
                    if($event_dealer_new != NULL){
                        $event_dealer = $event_dealer_new[0]->post_title;
                    }
                    
                    $event_date = get_field('upcoming_show_start_date',$loop_event->ID);
                    $event_date_end = get_field('upcoming_show_end_date',$loop_event->ID);
                    $dt = DateTime::createFromFormat('!d/m/Y', $event_date);
                    $dt2 = DateTime::createFromFormat('!d/m/Y', $event_date_end);
                     $event_date_month = strtoupper($dt->format('M'));
                     $event_date_end_month = strtoupper($dt2->format('M'));
                     $event_date_date = strtoupper($dt->format('j'));
                     $event_date_date_start = strtoupper($dt->format('j-M-Y'));
                     $event_date_date_end = strtoupper($dt2->format('j-M-Y'));
                     ?>
                <div class="results-items col-sm-12 nopadding ">
                    <div class="row upcoming_tb_row">
                        
                        <div class="left-col col-sm-6 col-md-4 upcoming_tb_left">
                            <p>
                                <a target="_blank" href="<?php echo $event_website_name; ?>">
                                    <?php
                                    if($event_image[0] !=''){              
                                    echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . $event_image[0] . "&a=t&w=503&h=299&zc=0' alt=''>";
                                   }else{
                                   echo "<img style='background-color:#fff;' class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . get_template_directory_uri() . "/img/unavailable.png&a=t&w=503&h=299&zc=0' alt=''>";
                                  } ?>
                                </a>
                            </p> 
                            <!--<h3 class="uppercase"><a href="<?php // echo $event_website_name; ?>" target="_blank">LINK OF SHOW WEBSITE</a></h3>-->
                            <div class="findyour col-sm-12 ">
                                    <!--<h4><?php // echo $event_image_title; ?> </h4>-->
                                    <a href="<?php echo $event_website_name; ?>" target="_blank"><p>View Exhibitors <i class="fa fa-chevron-right"></i></p></a>
                                </div>
                        </div>
                        <div class="pull-right col-sm-6 col-md-8 items-right upcoming_tb_right">
                            <div class="upcoming_tb_right_iner">
                            <h4><?php echo $event_title; ?></h4>
                            <div class="calendar">
                                <div class="month uppercase">
                                    <?php if($event_date_month != '' || $event_date_month != null){
                                    echo $event_date_month; 
                                    }?>
                                </div>
                                <div class="day">
                                    <?php if($event_date_date != '' || $event_date_date != null){
                                    echo $event_date_date; 
                                    }?>
                                    
                                </div>
                            </div>
                            <div class="from">From <?php echo $event_date_date_start; ?> TO <?php echo $event_date_date_end; ?></div>
                            <div class="dealer">Dealer: <?php echo $event_dealer; ?></div>
                            <div class="website"><a href="<?php echo $event_website_name; ?>" target="_blank" rel="nofollow"><?php echo $event_website_name; ?></a></div>
                            <div class="btn_up_wrp"><a class="btn btn-default uppercase view_up_btn" href="<?php echo $event_website_name; ?>" target="_blank" >More</a></div>
                        </div>
                        </div>
                    </div>
                </div>
                 <?php } ?>
                      </div>
            </div>
        </div> 
    </div>
    
    <!--================================================================View more button===================================================================================================-->
<!--    <div class="range-viewmore" >
        <div class="container ">
            <div class="row scroll viewmore_main_row">
                <a id="view_more_count" data_count="" class="uppercase filter_view_more_upcmng">View More &nbsp; 
                   
                    <i class="fa fa-angle-down fa-2x"></i>
                </a>
                <span class="view_more_wrp"> <i class="dropdownicon_viewmore"></i></span>
            </div>
            <div class="jscroll-added" style="display: none"><div class="jscroll-loading"><small>Loading...</small></div></div>
        </div> 
    </div>-->
    
    
<?php
get_footer();
?>