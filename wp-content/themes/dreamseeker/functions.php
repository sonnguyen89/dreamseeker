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
                $product_content .= '<div class="product-size"><span class="size_wr"><span class="size_img"></span>'. $sz_ft .'\'' . $sz_inch . '"' .'</span> </div>';


            }
            if ($occ != '')
            {
                $product_content .= '<div class="product-occupant"><span class="occu_wr"> <span class="occu_img"></span>'. $occ . '</span></div>';
            }
            $product_content .= '<a type="button"  class="product-find-more" href="'. $item->url . '">FIND OUT MORE</a>';


            $product_content .=  '</div>';

            //image
            $p_image = wp_get_attachment_image_src(get_post_thumbnail_id($_product->ID), 'full');
            $image_htlm = '<img class="dropdown-image" src="'. $p_image[0].'"/>';




            $args->after = '<div class="menu-item-dropdown">'. $image_htlm . $product_content . '</div>';
        }

    }

    return $args;
}
