<?php


add_theme_support('post-thumbnails');
set_post_thumbnail_size(624, 9999); // Unlimited height, soft crop

if (!defined('WPDREAMSEEKER_ADMIN_EMAIL')) define('WPDREAMSEEKER_ADMIN_EMAIL', get_option('admin_email'));
if (!defined('ABSPATH')) {
    define('ABSPATH', ABSPATH);
}


//post types
//function post_type_main_slider() {
//    register_post_type('main_slider', array(
//        'label' => __('Slider', 'ADG'),
//        'singular_label' => __("slider"),
//        '_builtin' => false,
//        'public' => true,
//        'show_ui' => true,
//        'show_in_nav_menus' => true,
//        'hierarchical' => true,
//        'capability_type' => 'post',
//        'has_archive' => true,
//        'menu_icon' => 'dashicons-share-alt',
//        'rewrite' => array(
//            'slug' => 'main_slider',
//            'with_front' => FALSE,
//        ),
//        'supports' => array(
//            'title',
//            'editor',
//            'thumbnail',
//            'excerpt',
//            'custom-fields',
//            'comments')
//       )
//    );
//    register_taxonomy('main_slider_category', 'main_slider', array('hierarchical' => true, 'label' => __("categories"), 'singular_name' => __("slider_category"), "rewrite" => true, "query_var" => true));
//    register_taxonomy('main_slider_tag', 'main_slider', array('hierarchical' => false, 'label' => __("tags"), 'singular_name' => __("slider_tag"), 'rewrite' => true, 'query_var' => true));
//}
function post_type_products() {
    register_post_type('products', array(
        'label' => __('Products', 'ADG'),
        'singular_label' => __("Products"),
        '_builtin' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_nav_menus' => true,
        'hierarchical' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'menu_icon' => 'dashicons-cart',
        'rewrite' => array(
            'slug' => 'product',
            'with_front' => FALSE,
        ),
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
            'comments')
       )
    );
    register_taxonomy('products_category', 'products', array('hierarchical' => true, 'label' => __("categories"), 'singular_name' => __("product_category"), "rewrite" => true, "query_var" => true));
    register_taxonomy('products_tag', 'products', array('hierarchical' => false, 'label' => __("tags"), 'singular_name' => __("product_tag"), 'rewrite' => true, 'query_var' => true));
}
function post_type_news() {
    register_post_type('news', array(
        'label' => __('News', 'ADG'),
        'singular_label' => __("News"),
        '_builtin' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_nav_menus' => true,
        'hierarchical' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'menu_icon' => 'dashicons-edit',
        'rewrite' => array(
            'slug' => 'news',
            'with_front' => FALSE,
        ),
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
            'comments')
       )
    );
    register_taxonomy('news_category', 'news', array('hierarchical' => true, 'label' => __("categories"), 'singular_name' => __("news_category"), "rewrite" => true, "query_var" => true));
    register_taxonomy('news_tag', 'news', array('hierarchical' => false, 'label' => __("tags"), 'singular_name' => __("news_tag"), 'rewrite' => true, 'query_var' => true));
}
function post_type_events() {
    register_post_type('events', array(
        'label' => __('Events', 'ADG'),
        'singular_label' => __("Events"),
        '_builtin' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_nav_menus' => true,
        'hierarchical' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'menu_icon' => 'dashicons-calendar',
        'rewrite' => array(
            'slug' => 'events',
            'with_front' => FALSE,
        ),
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
            'comments')
       )
    );
    register_taxonomy('events_category', 'events', array('hierarchical' => true, 'label' => __("categories"), 'singular_name' => __("events_category"), "rewrite" => true, "query_var" => true));
    register_taxonomy('events_tag', 'events', array('hierarchical' => false, 'label' => __("tags"), 'singular_name' => __("events_tag"), 'rewrite' => true, 'query_var' => true));
}
function post_type_dealer() {
    register_post_type('dealer', array(
        'label' => __('Dealer', 'ADG'),
        'singular_label' => __("Dealer"),
        '_builtin' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_nav_menus' => true,
        'hierarchical' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'menu_icon' => 'dashicons-calendar',
        'rewrite' => array(
            'slug' => 'dealer',
            'with_front' => FALSE,
        ),
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
            'comments')
       )
    );
    register_taxonomy('events_category', 'dealer', array('hierarchical' => true, 'label' => __("categories"), 'singular_name' => __("events_category"), "rewrite" => true, "query_var" => true));
    register_taxonomy('events_tag', 'dealer', array('hierarchical' => false, 'label' => __("tags"), 'singular_name' => __("events_tag"), 'rewrite' => true, 'query_var' => true));
}

function generate_post_types () {
//    post_type_main_slider();
    post_type_products();
    post_type_news();
    post_type_events();
    post_type_dealer();
}
if ( function_exists('register_sidebar') ){
//    register_sidebar('sidebar-1');
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'dreamseeker' ),
        'id' => 'sidebar-1'       
    ) );
}

function init_action() {
    include_once 'class/ajax.php';
    new drm_ajaxClass();
//    generate_post_types();
  generate_post_types(); 
//menu
    register_nav_menu('header-menu', __('Header Menu'));
    register_nav_menu('mobile-header-menu', __('Mobile Header Menu'));
    register_nav_menu('footer-menu',__( 'Footer Menu' ));
    register_nav_menu('sub-menu-range',__( 'Sub menu range' ));
    register_nav_menu('sub-menu-whatson',__( 'Sub menu whatson' ));
    register_nav_menu('sub-menu-dream',__( 'Sub menu dream' ));
    register_nav_menu('header-top-menu',__( 'Header top menu' ));
    register_nav_menu('footer-bottom-menu',__( 'Footer bottom menu' ));
    register_nav_menu('sub-menu-warranty',__( 'Sub Menu Warranty' ));
    if (!is_admin()) {
        //stylesheets
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/bootstrap.min.css')) {
            wp_register_style('drm_bootstrap_css', trailingslashit(get_template_directory_uri()) . 'css/bootstrap.min.css', false, '1.0', 'all');
            wp_enqueue_style('drm_bootstrap_css');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/bootstrap-theme.min.css')) {
            wp_register_style('drm_bootstrap_theme_css', trailingslashit(get_template_directory_uri()) . 'css/bootstrap-theme.min.css', false, '1.0', 'all');
            wp_enqueue_style('drm_bootstrap_theme_css');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/main.css')) {
            wp_register_style('drm_main_css', trailingslashit(get_template_directory_uri()) . 'css/main.css', false, '1.0', 'all');
            wp_enqueue_style('drm_main_css');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/font-awesome.min.css')) {
            wp_register_style('drm_fontawesome_css', trailingslashit(get_template_directory_uri()) . 'css/font-awesome.min.css', false, '1.0', 'all');
            wp_enqueue_style('drm_fontawesome_css');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/dropdown.css')) {
            wp_register_style('drm_dropdown_css', trailingslashit(get_template_directory_uri()) . 'css/dropdown.css', false, '1.0', 'all');
            wp_enqueue_style('drm_dropdown_css');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/jquery.bxslider.css')) {
            wp_register_style('drm_jquery_bxslider_css', trailingslashit(get_template_directory_uri()) . 'css/jquery.bxslider.css', false, '1.0', 'all');
            wp_enqueue_style('drm_jquery_bxslider_css');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/noJS.css')) {
            wp_register_style('drm_noJS_css', trailingslashit(get_template_directory_uri()) . 'css/noJS.css', false, '1.0', 'all');
            wp_enqueue_style('drm_noJS_css');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/colorbox.css')) {
            wp_register_style('drm_colorbox_css', trailingslashit(get_template_directory_uri()) . 'css/colorbox.css', false, '1.0', 'all');
            wp_enqueue_style('drm_colorbox_css');
        }
        
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/owl-carousel/owl.theme.css')) {
            wp_register_style('owl_theme_css', trailingslashit(get_template_directory_uri()) . 'css/owl-carousel/owl.theme.css', false, '1.0', 'all');
            wp_enqueue_style('owl_theme_css');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/prettyPhoto.css')) {
            wp_register_style('prettyPhoto_css', trailingslashit(get_template_directory_uri()) . 'css/prettyPhoto.css', false, '1.0', 'all');
            wp_enqueue_style('prettyPhoto_css');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/owl-carousel/owl.carousel.css')) {
            wp_register_style('owl_carousel_css', trailingslashit(get_template_directory_uri()) . 'css/owl-carousel/owl.carousel.css', false, '1.0', 'all');
            wp_enqueue_style('owl_carousel_css');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/jquery.fancybox.css')) {
            wp_register_style('drm_fancybox_css', trailingslashit(get_template_directory_uri()) . 'css/jquery.fancybox.css', false, '1.0', 'all');
            wp_enqueue_style('drm_fancybox_css');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/jquery.fancybox-thumbs.css')) {
            wp_register_style('drm_fancybox_thumb_css', trailingslashit(get_template_directory_uri()) . 'css/jquery.fancybox-thumbs.css', false, '1.0', 'all');
            wp_enqueue_style('drm_fancybox_thumb_css');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/datepicker.css')) {
            wp_register_style('drm_date_picker_css', trailingslashit(get_template_directory_uri()) . 'css/datepicker.css', false, '1.0', 'all');
            wp_enqueue_style('drm_date_picker_css');
        }
//        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/jquery-ui.structure.min.css')) {
//            wp_register_style('drm_jquery_ui_structure_css', trailingslashit(get_template_directory_uri()) . 'css/jquery-ui.structure.min.css', false, '1.0', 'all');
//            wp_enqueue_style('drm_jquery_ui_structure_css');
//        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/jquery-ui.css')) {
            wp_register_style('drm_jquery_ui_css', trailingslashit(get_template_directory_uri()) . 'css/jquery-ui.css', false, '1.0', 'all');
            wp_enqueue_style('drm_jquery_ui_css');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/jquery.jscrollpane.css')) {
            wp_register_style('drm_jquery_sq_css', trailingslashit(get_template_directory_uri()) . 'css/jquery.jscrollpane.css', false, '1.0', 'all');
            wp_enqueue_style('drm_jquery_sq_css');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/css/custom.css')) {
            wp_register_style('custom_css', trailingslashit(get_template_directory_uri()) . 'css/custom.css', false, '1.0', 'all');
            wp_enqueue_style('custom_css');
        }
//        javascripts
        
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/jquery.js')) {
            wp_register_script('drm_jquery', trailingslashit(get_template_directory_uri()) . 'js/jquery.js', array('jquery'), '1.0', false);
            wp_enqueue_script('drm_jquery');
        }        
          if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/jquery-migrate-1.2.1.min.js')) {
            wp_register_script('drm_jquery_migrate_js', trailingslashit(get_template_directory_uri()) . 'js/jquery-migrate-1.2.1.min.js', array('jquery'), '1.0', false);
            wp_enqueue_script('drm_jquery_migrate_js');
        }
          if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/jquery-ui.min.js')) {
            wp_register_script('drm_jquery_ui_min_js', trailingslashit(get_template_directory_uri()) . 'js/jquery-ui.min.js', array('jquery'), '1.0', false);
            wp_enqueue_script('drm_jquery_ui_min_js');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/bootstrap.min.js')) {
            wp_register_script('drm_bootstrap_js', trailingslashit(get_template_directory_uri()) . 'js/bootstrap.min.js', array('jquery'), '1.0', false);
            wp_enqueue_script('drm_bootstrap_js');
        }   
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/jquery.bxslider.min.js')) {
            wp_register_script('drm_bxslider', trailingslashit(get_template_directory_uri()) . 'js/jquery.bxslider.min.js', array('jquery'), '1.0', false);
            wp_enqueue_script('drm_bxslider');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/jquery.jscrollpane.min.js')) {
            wp_register_script('drm_jscrollp', trailingslashit(get_template_directory_uri()) . 'js/jquery.jscrollpane.min.js', array('jquery'), '1.0', false);
            wp_enqueue_script('drm_jscrollp');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/ajaxupload.3.5.js')) {
            wp_register_script('drm_ajaxupload', trailingslashit(get_template_directory_uri()) . 'js/ajaxupload.3.5.js', array('jquery'), '1.0', false);
            wp_enqueue_script('drm_ajaxupload');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/jquery.selectBoxIt.min.js')) {
            wp_register_script('drm_selectBoxIt', trailingslashit(get_template_directory_uri()) . 'js/jquery.selectBoxIt.min.js', array('jquery'), '1.0', false);
            wp_enqueue_script('drm_selectBoxIt');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/jquery.colorbox-min.js')) {
            wp_register_script('drm_colorboxjs', trailingslashit(get_template_directory_uri()) . 'js/jquery.colorbox-min.js', array('jquery'), '1.0', false);
            wp_enqueue_script('drm_colorboxjs');
        }
        if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/jquery.jscroll.js')) {
            wp_register_script('drm_scroll', trailingslashit(get_template_directory_uri()) . 'js/jquery.jscroll.js', array('jquery'), '1.0', false);
            wp_enqueue_script('drm_scroll');
        }
             if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/main.js')) {
            wp_register_script('drm_main_js', trailingslashit(get_template_directory_uri()) . 'js/main.js', array('jquery'), '1.0', false);
            wp_enqueue_script('drm_main_js');
        }
             if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/owl.carousel.js')) {
            wp_register_script('owl_carousel_js', trailingslashit(get_template_directory_uri()) . 'js/owl.carousel.js', array('jquery'), '1.0', false);
            wp_enqueue_script('owl_carousel_js');
        }
         if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/jquery.prettyPhoto.js')) {
            wp_register_script('drm_prettyPhoto_new', trailingslashit(get_template_directory_uri()) . 'js/jquery.prettyPhoto.js', array('jquery'), '1.0', false);
            wp_enqueue_script('drm_prettyPhoto_new');
        }
         if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/script_new.js')) {
            wp_register_script('drm_script_new', trailingslashit(get_template_directory_uri()) . 'js/script_new.js', array('jquery'), '1.0', false);
            wp_enqueue_script('drm_script_new');
        }
//             if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/jquery.fancybox.js')) {
//            wp_register_script('drm_fancy_box', trailingslashit(get_template_directory_uri()) . 'js/jquery.fancybox.js', array('jquery'), '1.0', false);
//            wp_enqueue_script('drm_fancy_box');
//        }
             if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/jquery.fancybox.pack.js')) {
            wp_register_script('drm_fancy_box_pack', trailingslashit(get_template_directory_uri()) . 'js/jquery.fancybox.pack.js', array('jquery'), '1.0', false);
            wp_enqueue_script('drm_fancy_box_pack');
        }
             if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/jquery.fancybox-thumbs.js')) {
            wp_register_script('drm_fancy_box_thumb', trailingslashit(get_template_directory_uri()) . 'js/jquery.fancybox-thumbs.js', array('jquery'), '1.0', false);
            wp_enqueue_script('drm_fancy_box_thumb');
        }
             if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/bootstrap-datepicker.js')) {
            wp_register_script('drm_boot_date', trailingslashit(get_template_directory_uri()) . 'js/bootstrap-datepicker.js', array('jquery'), '1.0', false);
            wp_enqueue_script('drm_boot_date');
        }
             if (file_exists(ABSPATH . 'wp-content/themes/dreamseeker/js/jQuery.MultiFile.min.js')) {
            wp_register_script('drm_multifile_upload_js', trailingslashit(get_template_directory_uri()) . 'js/jQuery.MultiFile.min.js', array('jquery'), '1.0', false);
            wp_enqueue_script('drm_multifile_upload_js');
        }
        
            
       
        wp_localize_script('drm_script_new', 'wpdrm', array('ajaxurl' => admin_url('admin-ajax.php'), 'PGNonce' => wp_create_nonce('wpdrm-ajax-cc-nonce')));
    }
}

add_action('init', 'init_action');


function upload_claim_images(){
   
   $valid_formats = array("jpg", "png", "gif", "zip", "bmp");
$max_file_size = 1024*100; //100 kb
$path_n = get_template_directory();
$path = $path_n."/claim_uploads/"; // Upload directory
$count = 0;
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	// Loop $_FILES to exeicute all files
//    var_dump($_FILES['files']);
	foreach ($_FILES['files']['name'] as $f => $name) {     
	    if ($_FILES['files']['error'][$f] == 4) {
	        continue; // Skip file if any error found
	    }	       
	    if ($_FILES['files']['error'][$f] == 0) {	           
	        if ($_FILES['files']['size'][$f] > $max_file_size) {
	            $message[] = "$name is too large!.";
	            continue; // Skip large files
	        }
			elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
				$message[] = "$name is not a valid format";
				continue; // Skip invalid file formats
			}
	        else{ // No error found! Move uploaded files 
	            if(copy_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
	            $count++; // Number of successfully uploaded file
	        }
	    }
	}
}
}


function __search_by_title_only( $search, &$wp_query )
{
    global $wpdb;
    if(empty($search)) {
        return $search; // skip processing - no search term in query
    }
    $q = $wp_query->query_vars;
    $n = !empty($q['exact']) ? '' : '%';
    $search =
    $searchand = '';
    foreach ((array)$q['search_terms'] as $term) {
        $term = esc_sql($wpdb->esc_like($term));
        $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
        $searchand = ' AND ';
    }
    if (!empty($search)) {
        $search = " AND ({$search}) ";
        if (!is_user_logged_in())
            $search .= " AND ($wpdb->posts.post_password = '') ";
    }
    return $search;
}
add_filter('posts_search', '__search_by_title_only', 500, 2);


//**************add category custom field*************


//************** customize the main navigation menu item *************
add_filter('nav_menu_item_args','customize_main_menu_items', 10, 3);
function customize_main_menu_items( $args, $item, $depth  ) {
    if( $args->theme_location == 'header-menu' && $item->object == 'products' )
    {

        if($_product = get_post($item->object_id))
        {
            //price


            $product_content  = '<div class="dropdown-content">' ;
            $product_content .= '<div class="dropdown-title">' ;
            $product_content .= '<h2>' . $_product->post_title . '</h2>';
            $product_content .=  '</div>';
            $product_content .= '<div class="product-content">' . $_product->post_content . '</div>';


            $sz_ft = get_field('size_feet', $_product->ID) ? get_field('size_feet',  $_product->ID) : "";

            $sz_inch = get_field('size_inches',  $_product->ID) ? get_field('size_inches',  $_product->ID) : "";

            $occ = get_field('occupants',  $_product->ID) ? get_field('occupants',  $_product->ID) : "";


            if ($sz_ft != '' || $sz_inch != '')
            {
                $product_content .= '<div class="product-size"><span class="size_wr"><span class="size_img"></span>';
                if ($sz_ft != '')
                {
                    $product_content .=  $sz_ft .'\'' ;
                }
                if($sz_inch != '')
                {
                    $product_content .= $sz_inch . '"';
                }
                $product_content .= '</span> </div>';

            }
            if ($occ != '')
            {
                $product_content .= '<div class="product-occupant"><span class="occu_wr"> <span class="occu_img"></span>'. $occ . '</span></div>';
            }
            $product_content .= '<a type="button"  class="product-find-more" href="'. $item->url . '">FIND OUT MORE</a>';


            $product_content .=  '</div>';


            //product image for menu
            if(get_field('menu_product_image', $_product->ID))
            {
                $p_image = get_field('menu_product_image', $_product->ID);
                $image_url = $p_image['url'];
            }
            else
            {
                $p_image = wp_get_attachment_image_src(get_post_thumbnail_id($_product->ID), 'full');
                $image_url = $p_image[0];
            }


            $p_image = wp_get_attachment_image_src(get_post_thumbnail_id($_product->ID), 'full');
            $image_htlm = '<img class="dropdown-image" src="'. $image_url.'"/>';




            $args->after = '<div class="menu-item-dropdown">'. $image_htlm . $product_content . '</div>';

        }

    }
    else if( $args->theme_location == 'mobile-header-menu' && $item->object == 'products')
    {



        if($_product = get_post($item->object_id))
        {
            //product image for menu
            if(get_field('menu_product_image', $_product->ID))
            {
                $p_image = get_field('menu_product_image', $_product->ID);
                $image_url = $p_image['url'];
            }
            else
            {
                $p_image = wp_get_attachment_image_src(get_post_thumbnail_id($_product->ID), 'full');
                $image_url = $p_image[0];
            }



            $image_htlm = '<p><a type="button"  class="product-find-more" href="'. $item->url . '"><img class="dropdown-image" src="'. $image_url.'" width="300"/></a></p>';



            $args->after = $image_htlm ;

        }
    }
    else
    {
        $args->after = '';
    }

    return $args;

}


//hide the start maker at Dealer Locator Page

add_filter( 'wpsl_js_settings', 'custom_js_settings' );

function custom_js_settings( $settings ) {

    $settings['startMarker'] = '';

    return $settings;
}


add_filter( 'wpsl_templates', 'custom_templates' );

function custom_templates( $templates ) {

    /**
     * The 'id' is for internal use and must be unique ( since 2.0 ).
     * The 'name' is used in the template dropdown on the settings page.
     * The 'path' points to the location of the custom template,
     * in this case the folder of your active theme.
     */
    $templates[] = array (
        'id'   => 'custom',
        'name' => 'Custom template',
        'path' => get_stylesheet_directory() . '/' . 'wpsl-templates/custom.php',
    );

    return $templates;
}




add_filter( 'wpsl_listing_template', 'custom_locator_listing_template' );

function custom_locator_listing_template()
{
    global $wpsl, $wpsl_settings;

    $listing_template = '<li data-store-id="<%= id %>">' . "\r\n";
    $listing_template .= "\t\t" . '<div class="wpsl-store-location">' . "\r\n";
    $listing_template .= "\t\t\t" . '<p class="store-location-detail"><%= thumb %>' . "\r\n";
    $listing_template .= "\t\t\t\t" . wpsl_store_header_template( 'listing' ) . "\r\n"; // Check which header format we use
    $listing_template .= "\t\t\t\t" . '<span class="wpsl-street"><%= address %></span>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<% if ( address2 ) { %>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<span class="wpsl-street"><%= address2 %></span>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<% } %>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<span>' . wpsl_address_format_placeholders() . '</span>' . "\r\n"; // Use the correct address format

    if ( !$wpsl_settings['hide_country'] ) {
        $listing_template .= "\t\t\t\t" . '<span class="wpsl-country"><%= country %></span>' . "\r\n";
    }

    $listing_template .= "\t\t\t" . '</p>' . "\r\n";

    // Show the phone, fax or email data if they exist.
    if ( $wpsl_settings['show_contact_details'] ) {
        $listing_template .= "\t\t\t" . '<p class="wpsl-contact-details">' . "\r\n";
        $listing_template .= "\t\t\t" . '<% if ( phone ) { %>' . "\r\n";
        $listing_template .= "\t\t\t" . '<span><strong>' . esc_html( $wpsl->i18n->get_translation( 'phone_label', __( 'Phone', 'wpsl' ) ) ) . '</strong>: <%= formatPhoneNumber( phone ) %></span>' . "\r\n";
        $listing_template .= "\t\t\t" . '<% } %>' . "\r\n";
        $listing_template .= "\t\t\t" . '<% if ( fax ) { %>' . "\r\n";
        $listing_template .= "\t\t\t" . '<span><strong>' . esc_html( $wpsl->i18n->get_translation( 'fax_label', __( 'Fax', 'wpsl' ) ) ) . '</strong>: <%= fax %></span>' . "\r\n";
        $listing_template .= "\t\t\t" . '<% } %>' . "\r\n";
        $listing_template .= "\t\t\t" . '<% if ( email ) { %>' . "\r\n";
        $listing_template .= "\t\t\t" . '<span><strong>' . esc_html( $wpsl->i18n->get_translation( 'email_label', __( 'Email', 'wpsl' ) ) ) . '</strong>: <%= email %></span>' . "\r\n";
        $listing_template .= "\t\t\t" . '<% } %>' . "\r\n";
        $listing_template .= "\t\t\t" . '</p>' . "\r\n";
    }

    $listing_template .= "\t\t\t" . wpsl_more_info_template() . "\r\n"; // Check if we need to show the 'More Info' link and info
    $listing_template .= "\t\t" . '</div>' . "\r\n";
    $listing_template .= "\t\t" . '<div class="wpsl-direction-wrap">' . "\r\n";

    if ( !$wpsl_settings['hide_distance'] ) {
        $listing_template .= "\t\t\t" . '<%= distance %> ' . esc_html( wpsl_get_distance_unit() ) . '' . "\r\n";
    }

    $listing_template .= "\t\t\t" . '<%= createDirectionUrl() %>' . "\r\n";
    $listing_template .= "\t\t" . '</div>' . "\r\n";
    $listing_template .= "\t" . '</li>';

    return $listing_template;
}


add_filter( 'wpsl_more_info_template', 'custom_more_info_template');
function custom_more_info_template()
{
    global $wpsl_settings, $wpsl;

    if ( $wpsl_settings['more_info'] ) {
        $more_info_url = '#';

        if ( $wpsl_settings['template_id'] == 'default' && $wpsl_settings['more_info_location'] == 'info window' ) {
            $more_info_url = '#wpsl-search-wrap';
        }

        if ( $wpsl_settings['more_info_location'] == 'store listings' ) {
            $more_info_template = '<% if ( !_.isEmpty( phone ) || !_.isEmpty( fax ) || !_.isEmpty( email ) ) { %>' . "\r\n";
            $more_info_template .= "\t\t\t" . '<p class="more_info_button"><a class="wpsl-store-details wpsl-store-listing" href="#wpsl-id-<%= id %>">' . esc_html( $wpsl->i18n->get_translation( 'more_label', __( 'More info', 'wpsl' ) ) ) . '</a></p>' . "\r\n";
            $more_info_template .= "\t\t\t" . '<div id="wpsl-id-<%= id %>" class="wpsl-more-info-listings">' . "\r\n";
            $more_info_template .= "\t\t\t\t" . '<% if ( description ) { %>' . "\r\n";
            $more_info_template .= "\t\t\t\t" . '<%= description %>' . "\r\n";
            $more_info_template .= "\t\t\t\t" . '<% } %>' . "\r\n";

            if ( !$wpsl_settings['show_contact_details'] ) {
                $more_info_template .= "\t\t\t\t" . '<p>' . "\r\n";
                $more_info_template .= "\t\t\t\t" . '<% if ( phone ) { %>' . "\r\n";
                $more_info_template .= "\t\t\t\t" . '<span><strong>' . esc_html( $wpsl->i18n->get_translation( 'phone_label', __( 'Phone', 'wpsl' ) ) ) . '</strong>: <%= formatPhoneNumber( phone ) %></span>' . "\r\n";
                $more_info_template .= "\t\t\t\t" . '<% } %>' . "\r\n";
                $more_info_template .= "\t\t\t\t" . '<% if ( fax ) { %>' . "\r\n";
                $more_info_template .= "\t\t\t\t" . '<span><strong>' . esc_html( $wpsl->i18n->get_translation( 'fax_label', __( 'Fax', 'wpsl' ) ) ) . '</strong>: <%= fax %></span>' . "\r\n";
                $more_info_template .= "\t\t\t\t" . '<% } %>' . "\r\n";
                $more_info_template .= "\t\t\t\t" . '<% if ( email ) { %>' . "\r\n";
                $more_info_template .= "\t\t\t\t" . '<span><strong>' . esc_html( $wpsl->i18n->get_translation( 'email_label', __( 'Email', 'wpsl' ) ) ) . '</strong>: <%= email %></span>' . "\r\n";
                $more_info_template .= "\t\t\t\t" . '<% } %>' . "\r\n";
                $more_info_template .= "\t\t\t\t" . '<% if ( url ) { %>' . "\r\n";
                $more_info_template .= "\t\t\t\t" . '<span><a href="<%= url %>"><strong>' . esc_html( $wpsl->i18n->get_translation( 'url_label', __( 'Url', 'wpsl' ) ) ) . '</strong>: <%= url %></a></span>' . "\r\n";
                $more_info_template .= "\t\t\t\t" . '<% } %>' . "\r\n";

                $more_info_template .= "\t\t\t\t" . '</p>' . "\r\n";
            }

            if ( !$wpsl_settings['hide_hours'] ) {
                $more_info_template .= "\t\t\t\t" . '<% if ( hours ) { %>' . "\r\n";
                $more_info_template .= "\t\t\t\t" . '<div class="wpsl-store-hours"><strong>' . esc_html( $wpsl->i18n->get_translation( 'hours_label', __( 'Hours', 'wpsl' ) ) ) . '</strong><%= hours %></div>' . "\r\n";
                $more_info_template .= "\t\t\t\t" . '<% } %>' . "\r\n";
            }

            $more_info_template .= "\t\t\t" . '</div>' . "\r\n";
            $more_info_template .= "\t\t\t" . '<% } %>';

        } else {
            $more_info_template = '<p><a class="wpsl-store-details" href="' . $more_info_url . '">' . esc_html( $wpsl->i18n->get_translation( 'more_label', __( 'More info', 'wpsl' ) ) ) . '</a></p>';
        }

        return $more_info_template;
    }
}

add_filter('wpsl_store_header_template', 'custom_store_header_template');
function custom_store_header_template( $location = 'info_window')
{
    global $wpsl_settings;

    if ( $wpsl_settings['new_window'] ) {
        $new_window = ' target="_blank"';
    } else {
        $new_window = '';
    }

    /*
     * To keep the code readable in the HTML source we ( unfortunately ) need to adjust the
     * amount of tabs in front of it based on the location were it is shown.
     */
    if ( $location == 'listing') {
        $tab = "\t\t\t\t";
    } else {
        $tab = "\t\t\t";
    }

    if ( $wpsl_settings['permalinks'] ) {

        /**
         * It's possible the permalinks are enabled, but not included in the location data on
         * pages where the [wpsl_map] shortcode is used.
         *
         * So we need to check for undefined, which isn't necessary in all other cases.
         */
        if ( $location == 'wpsl_map') {
            $header_template = '<% if ( typeof permalink !== "undefined" ) { %>' . "\r\n";
            $header_template .= $tab . '<strong><a' . $new_window . ' href="<%= permalink %>"><%= store %></a></strong>' . "\r\n";
            $header_template .= $tab . '<% } else { %>' . "\r\n";
            $header_template .= $tab . '<strong><%= store %></strong>' . "\r\n";
            $header_template .= $tab . '<% } %>';
        } else {
            $header_template = '<strong><a' . $new_window . ' href="<%= permalink %>"><%= store %></a></strong>';
        }
    } else {
        $header_template = '<% if ( wpslSettings.storeUrl == 1 && url ) { %>' . "\r\n";
        $header_template .= $tab . '<strong><a' . $new_window . ' href="<%= url %>"><%= store %></a></strong>' . "\r\n";
        $header_template .= $tab . '<% } else { %>' . "\r\n";
        $header_template .= $tab . '<strong><%= store %></strong>' . "\r\n";
        $header_template .= $tab . '<% } %>';
    }

    return  $header_template ;
}


//sort the dealer location by dealer name
add_filter( 'wpsl_store_data', 'custom_result_sort' );

function custom_result_sort( $store_meta ) {

    $custom_sort = array();

    foreach ( $store_meta as $key => $row ) {
        $custom_sort[$key] = $row['store'];
    }

    array_multisort( $custom_sort, SORT_ASC, SORT_REGULAR, $store_meta );

    return $store_meta;
}


add_filter( 'wpsl_marker_props', 'custom_marker_props' );

function custom_marker_props( $marker_props ) {

    $marker_props['scaledSize'] = '40,51'; // Set this to 50% of the original size
    $marker_props['origin'] = '0,0';
    $marker_props['anchor'] = '20,51';

    return $marker_props;
}