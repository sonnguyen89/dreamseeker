 <?php
/*
  Template Name: Product range
 */
get_header("range");
global $post;
 $args = array(
                             'post_type' => 'products',
                             'child_of' => 0,
                             'parent' => '',
                             'orderby' => 'name',
                             'order' => 'ASC',
                             'hide_empty' => 1,
                             'hierarchical' => 1,
                             'exclude' => '',
                             'include' => '',
                             'number' => '',
                             'taxonomy' => 'products_category',
                             'pad_counts' => false
                         );

                         $categories = get_categories($args);                         
?> 

    <!-- Second Navigation
    ================================================== -->
    <nav class="navbar navbar-inverse navbar-top second-navbar hidden-xs navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div id="navbar" class="navbar-collapse collapse navbar-second">
            <ul class="sub-menu-range nav navbar-nav navbar-right filter_pro product_category_sub_menu">           
                           <li><a href="#">All</a></li>
                         <?php 
                        
                         foreach ($categories as $category) {
                             ?>
                         <li><a href="#"><?php echo $category->name ?></a></li>                                                   
                         <?php } ?>
                     
                </ul>
            
<!--          <ul class="nav navbar-nav navbar-right">
                <li><a href="#">All</a></li>
                <li><a href="#">Off-Road</a></li>
                <li><a href="#">Semi Off-Road</a></li>
                <li><a href="#">On-Road</a></li>
                <li><a href="#">Slide-Out</a></li>
                <li><a href="#">Family</a></li>
          </ul>-->
 <?php 
// wp_nav_menu(array('theme_location' => 'sub-menu-range',
//'menu_class'      => 'nav navbar-nav navbar-right')); 
 ?>
        </div>
      </div>
    </nav>
    
    <!-- Range Hero Image
    ================================================== -->
    <div class="range-heroimg" style="background-image:url('<?php echo get_template_directory_uri() ?>/img/range-heroimg.jpg');">
        <div class="container ">
            <div class="row">
                <h1>OFF-ROAD</h1>
            </div>
        </div> 
    </div>
    
    <!-- Range Intro Text
    ================================================== -->
    <div class="range-introtext" >
        <div class="container ">
            <div class="row">
                <h2><?php echo cedo_get_option('cedo_rng_ttl'); ?></h2>
              <?php 
                foreach ($categories as $category) {
//              $category = get_the_category(); 
//              $category_id =  $category[0]->cat_ID;
//              var_dump($category);
                }
              ?>               
                <p><?php echo cedo_get_option('cedo_rng_cnt'); ?></p>
            </div>
        </div> 
    </div>
    
    <!-- Range Filters
    ================================================== -->
    <div class="filters filter_range" id="scroll_here">
        <div class="container ">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <label for="inputEmail3" class="control-label ">Price</label>
                    <?php
                    $price_key = "field_55cc4f13e4d23";
                    $price_field = get_field_object($price_key);
                    if ($price_field) {
                        echo '<select name="product_price" class="filter_pro product_price select_style" data_val="price" id="product_price">';
                        foreach ($price_field['choices'] as $k => $v) {
                            echo '<option value="' . $k . '">' . $v . '</option>';
                        }
                        echo '</select>';
                    }
                    ?>
                </div>
                <div class="col-lg-4 col-sm-4">
                     <label for="inputEmail3" class="control-label ">Length</label>
                     <?php
                    $length_key = "field_55cc6236657d4";
                    $length_field = get_field_object($length_key);
                    if ($length_field) {
                        echo '<select name="product_length" class="filter_pro product_length select_style" data_val="length" id="product_length">';
                        foreach ($length_field['choices'] as $k => $v) {
                            echo '<option value="' . $k . '">' . $v . '</option>';
                        }
                        echo '</select>';
                    }
                    ?>
                </div>
                
               
                <div class="col-lg-4 col-sm-4 last_pro_category">
                     <label for="inputEmail3" class="control-label ">Category</label>
                     <select name="test" class="filter_pro product_category select_style" data_val="category">
                         <option value="">All</option>
                         <?php                     
                         foreach ($categories as $category) {
                             ?>
                             <option value="<?php echo $category->slug ?>"><?php echo $category->name ?></option>                          
                         <?php } ?>
                     </select>   
                </div>
<!--                <div class="col-lg-3 col-sm-6">
                    <label for="inputEmail3" class="control-label ">Dealer / STATE</label>
                    <?php
//                                        
//                        $args2 = array(
//                        'posts_per_page' => -1,
//                        'offset' => 0,
//                        'orderby' => 'post_date',
//                        'category' => '',
//                        'post_type' => 'dealer',
//                        'post_status' => 'publish',       
//                        'order' => 'DESC'
//                            ); 
//                        $loopdealer = get_posts($args2);
                        
                        ?>
                  
                    <select name="product_dealer" class="filter_pro product_dealer select_style" data_val="dealers_list" id="product_dealer">
                        <option value="" >All</option>
                        <?php
//                        foreach ($loopdealer as $loopdealer2) {
//                            $dealer_name = $loopdealer2->post_title;
//                            $dealer_id = $loopdealer2->ID;
//                            $add = get_field('dealer_state', $dealer_id);
//                            $lati = $add['lat'];
//                            $longt = $add['lng'];
//                            $dealer_name2 = str_replace(' ', '_', $dealer_name);
//                            $dealer_key = "field_55dc2b9c97d6c";
                            ?>
                            <option value="<?php // echo $dealer_id; ?>"><?php // echo $dealer_name ?> - <?php // echo $add; ?></option> 
                        <?php // } ?>
                    </select>             
                </div>-->
				
            </div>
        </div> 
    </div>

    <!-- Display Options
    ================================================== -->
    <div class="range-disoption range_op visible-lg"   style="padding-right:15px;">
        <div class="container-fluid ">
            <div class="row">
                <p class="pull-right"><span class="optintxt uppercase">Viewing Options</span> <span class="colicon col3 current"></span> <span class="colicon col4"></span> <span class="colicon col1"></span></p>
            </div>
        </div> 
    </div>
    
    <!-- Range Results
    ================================================== -->   
    <div class="range-results" >
        <div class="container ">
            <div class="row scroll">
                <div class="data-loading hide_load" style="display: none">
                    <p>Loading Results</br><img src="<?php echo get_template_directory_uri() ?>/img/bx_loader.gif"/></p>
                </div>
                 <div class="append_res">                     
                   <?php 
            $argsproducts = array(
            'posts_per_page'   =>3,
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
               $product_desc_new = substr($product_desc, 0, 250);
               $v_id = $loop_product->ID;
               
                 ?>
                     <a href="<?php echo get_permalink($loop_product->ID); ?>">
                <span class="results-itemsbn  col-sm-4 nopadding ">
                    <span class="left-col EqHeightDiv_3">                        
                        <span><img src="<?php echo get_template_directory_uri()."/timthumb.php?src=". $product_image[0]; ?>&a=t&w=500&h=300&zc=1'" class="img-responsive" alt="Responsive image"></span>
                    </span>
                    <span class="fl_rng EqHeightDiv_3 EqHeightDiv4">
                        <span class="feature_desc_wrpper">
                        <h4><?php echo $product_title; ?></h4>
<!--                        <span class="des"><?php // echo $product_desc_new; ?>
                        </span>-->
                         <?php
                        $pr_thou = get_field('price_thousands', $v_id)? get_field('price_thousands', $v_id) : "";
                        $pr_hund = get_field('price_hundreds', $v_id)? get_field('price_hundreds', $v_id) : "";
                        $sz_ft = get_field('size_feet', $v_id)? get_field('size_feet', $v_id) : "";
                        $sz_inch = get_field('size_inches', $v_id)? get_field('size_inches', $v_id) : "";
                        $occ = get_field('occupants', $v_id)? get_field('occupants', $v_id) : "";
                        $tare = get_field('tare', $v_id)? get_field('tare', $v_id) : "";
                        $ball_weight = get_field('ball_weight', $v_id)? get_field('ball_weight', $v_id) : "";
                        $other_details = get_field('other_details', $v_id)? get_field('other_details', $v_id) : "";
                        ?>
                        <span class="des">
                             <?php if($pr_thou != '' || $pr_hund !='') { ?><span class="price_wr">$&nbsp;<?php echo $pr_thou; ?>,<?php echo $pr_hund; ?></span><?php } ?>
                            <?php if($sz_ft != '' || $sz_inch !='') { ?><span class="size_wr"><span class="size_img"></span><?php echo $sz_ft; ?>'<?php echo $sz_inch; ?>"</span><?php } ?>
                            <span class="occu_wr"> <?php if($occ != '') { ?><span class="occu_img"></span><?php } ?><?php echo $occ; ?></span>
                            <span class="other_wr"><?php echo $other_details; ?></span>
                            <span class="tare_wr">Tare (approx):<?php echo $tare; ?></span>
                            <span class="b_wght_wr">Ball Weight (approx):<?php echo $ball_weight; ?></span>
                        </span>                       
                    </span>
<!--                   <span class="go_lnk"></span>      -->
                        <!--<span><span class="view-more">View More</span></span>-->                    
                    </span>
                     <span class="go_lnk"></span>   
                </span>
                     </a>
            <?php } ?>
                     </div>
            </div>
        </div> 
    </div>
    
    <!-- View More Button
    ================================================== -->
<!--    <div class="range-viewmore" >
        <div class="container ">
            <div class="row scroll viewmore_main_row">
                <a id="view_more_count" data_count="" class="uppercase filter_view_more">View More &nbsp; 
                   
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