<?php

class drm_ajaxClass {

    function __construct() {
        add_action('wp_ajax_nopriv_filter_price', array(&$this, 'filter_price')); //no logged
        add_action('wp_ajax_filter_price', array(&$this, 'filter_price'));
        add_action('wp_ajax_nopriv_filter_price_4', array(&$this, 'filter_price_4')); //no logged
        add_action('wp_ajax_filter_price_4', array(&$this, 'filter_price_4'));
        add_action('wp_ajax_nopriv_filter_price_3', array(&$this, 'filter_price_3')); //no logged
        add_action('wp_ajax_filter_price_3', array(&$this, 'filter_price_3'));
        add_action('wp_ajax_nopriv_filter_price_full', array(&$this, 'filter_price_full')); //no logged
        add_action('wp_ajax_filter_price_full', array(&$this, 'filter_price_full'));
        add_action('wp_ajax_nopriv_filter_up', array(&$this, 'filter_up')); //no logged
        add_action('wp_ajax_filter_up', array(&$this, 'filter_up'));
        add_action('wp_ajax_nopriv_filter_up_3', array(&$this, 'filter_up_3')); //no logged
        add_action('wp_ajax_filter_up_3', array(&$this, 'filter_up_3'));
        add_action('wp_ajax_nopriv_filter_up_4', array(&$this, 'filter_up_4')); //no logged
        add_action('wp_ajax_filter_up_4', array(&$this, 'filter_up_4'));
        add_action('wp_ajax_nopriv_send_mail_from_contact_page', array(&$this, 'send_mail_from_contact_page')); //no logged
        add_action('wp_ajax_send_mail_from_contact_page', array(&$this, 'send_mail_from_contact_page')); //logged 
        add_action('wp_ajax_nopriv_send_mail_from_ns', array(&$this, 'send_mail_from_ns')); //no logged
        add_action('wp_ajax_send_mail_from_ns', array(&$this, 'send_mail_from_ns')); //logged 
        add_action('wp_ajax_nopriv_send_make_a_disclaimer', array(&$this, 'send_make_a_disclaimer')); //no logged
        add_action('wp_ajax_send_make_a_disclaimer', array(&$this, 'send_make_a_disclaimer')); //logged 
        add_action('wp_ajax_nopriv_filter_view_more', array(&$this, 'filter_view_more')); //no logged
        add_action('wp_ajax_filter_view_more', array(&$this, 'filter_view_more')); //logged 
        add_action('wp_ajax_nopriv_filter_view_more_4', array(&$this, 'filter_view_more_4')); //no logged
        add_action('wp_ajax_filter_view_more_4', array(&$this, 'filter_view_more_4')); //logged 
        add_action('wp_ajax_nopriv_filter_view_more_3', array(&$this, 'filter_view_more_3')); //no logged
        add_action('wp_ajax_filter_view_more_3', array(&$this, 'filter_view_more_3')); //logged 
        add_action('wp_ajax_nopriv_filter_view_more_up', array(&$this, 'filter_view_more_up')); //no logged
        add_action('wp_ajax_filter_view_more_up', array(&$this, 'filter_view_more_up')); //logged 
        add_action('wp_ajax_nopriv_filter_view_more_up_4', array(&$this, 'filter_view_more_up_4')); //no logged
        add_action('wp_ajax_filter_view_more_up_4', array(&$this, 'filter_view_more_up_4')); //logged 
        add_action('wp_ajax_nopriv_filter_view_more_up_3', array(&$this, 'filter_view_more_up_3')); //no logged
        add_action('wp_ajax_filter_view_more_up_3', array(&$this, 'filter_view_more_up_3')); //logged 
        add_action('wp_ajax_nopriv_show_dealers', array(&$this, 'show_dealers')); //no logged
        add_action('wp_ajax_show_dealers', array(&$this, 'show_dealers')); //logged 
    }

    function action_piority($__post) {
        $nonce = $__post;
        if (!wp_verify_nonce($nonce, 'wpdrm-ajax-cc-nonce')) die('Invalid Request!');
    }

    function filter_view_more() {
        $this->action_piority($_POST['pgnonce']);
        $price_value = isset($_POST['price_value']) ? $_POST['price_value'] : "";
        $price_key = isset($_POST['price_key']) ? $_POST['price_key'] : "";
        $length_key = isset($_POST['length_key']) ? $_POST['length_key'] : "";
        $length_value = isset($_POST['length_value']) ? $_POST['length_value'] : "";
        $dealer_value = isset($_POST['dealer_value']) ? $_POST['dealer_value'] : "";
        $dealer_key = isset($_POST['dealer_key']) ? $_POST['dealer_key'] : "";
        $product_category = isset($_POST['product_category']) ? $_POST['product_category'] : "";
        $product_count = isset($_POST['product_count']) ? $_POST['product_count'] : "";
        $arry = array();
        $cat_array = array();
//        var_dump($product_category);
        if ($product_category != '') {
            $cat_array[] = array(
                'taxonomy' => 'products_category',
                'field' => 'slug',
                'terms' => $product_category
            );
        } else {
            $cat_array = array();
        }

        if ($price_value != '') {

            $arry[] = array(
                'key' => $price_key,
                'value' => $price_value,
                'compare' => '='
            );
        }
        if ($length_value != '') {
            $arry[] = array(
                'key' => $length_key,
                'value' => $length_value,
                'compare' => '='
            );
        }
        if ($dealer_value != '') {
            $arry[] = array(
                'key' => $dealer_key,
                'value' => $dealer_value,
                'compare' => '='
            );
        }
        if ($product_category || $price_value || $length_value || $dealer_value) {

            $argsproducts = array(
                'posts_per_page' => 2,
                'offset' => $product_count,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
                'meta_query' => array($arry),
                'tax_query' => array($cat_array)
            );
        } else {
            $argsproducts = array(
                'posts_per_page' => 2,
                'offset' => $product_count,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
            );
        }
//         var_dump($argsproducts);
        $looppro = get_posts($argsproducts);
        foreach ($looppro as $loop_product) {
            $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($loop_product->ID), 'full');
            $product_title = $loop_product->post_title;
            $product_desc = $loop_product->post_content;
            $product_desc_new = substr($product_desc, 0, 250);
            ?>
<a href="<?php echo post_permalink($loop_product->ID) ?>">
            <span class="results-items EqHeightDiv col-sm-12 nopadding ">
                <span class="left-col col-sm-4">
                    <span><img src="<?php echo get_template_directory_uri() . "/timthumb.php?src=" . $product_image[0]; ?>&a=t&w=500&h=300&zc=1' alt=''>" class="img-responsive" alt="Responsive image"></span>
                </span>
                <span class="col-sm-8">
                    <span class="feature_desc_wrpper">
                        <h4><?php echo $product_title; ?></h4>
                        <span class="des"><?php echo $product_desc_new; ?></span>
                    </span>
                    <span><span class="view-more">View More</span></span>

                </span>
            </span>
</a>
            <?php
        }
        exit();
        // echo json_encode($message);
    }

    function filter_view_more_4() {
        $this->action_piority($_POST['pgnonce']);
        $price_value = isset($_POST['price_value']) ? $_POST['price_value'] : "";
        $price_key = isset($_POST['price_key']) ? $_POST['price_key'] : "";
        $length_key = isset($_POST['length_key']) ? $_POST['length_key'] : "";
        $length_value = isset($_POST['length_value']) ? $_POST['length_value'] : "";
        $dealer_value = isset($_POST['dealer_value']) ? $_POST['dealer_value'] : "";
        $dealer_key = isset($_POST['dealer_key']) ? $_POST['dealer_key'] : "";
        $product_category = isset($_POST['product_category']) ? $_POST['product_category'] : "";
        $product_count = isset($_POST['product_count']) ? $_POST['product_count'] : "";
        $arry = array();
        $cat_array = array();
//        var_dump($product_category);
        if ($product_category != '') {
            $cat_array[] = array(
                'taxonomy' => 'products_category',
                'field' => 'slug',
                'terms' => $product_category
            );
        } else {
            $cat_array = array();
        }

        if ($price_value != '') {

            $arry[] = array(
                'key' => $price_key,
                'value' => $price_value,
                'compare' => '='
            );
        }
        if ($length_value != '') {
            $arry[] = array(
                'key' => $length_key,
                'value' => $length_value,
                'compare' => '='
            );
        }
        if ($dealer_value != '') {
            $arry[] = array(
                'key' => $dealer_key,
                'value' => $dealer_value,
                'compare' => '='
            );
        }
        if ($product_category || $price_value || $length_value || $dealer_value) {

            $argsproducts = array(
                'posts_per_page' => 4,
                'offset' => $product_count,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
                'meta_query' => array($arry),
                'tax_query' => array($cat_array)
            );
        } else {
            $argsproducts = array(
                'posts_per_page' => 4,
                'offset' => $product_count,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
            );
        }
//         var_dump($argsproducts);
        $looppro = get_posts($argsproducts);
        foreach ($looppro as $loop_product) {
            $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($loop_product->ID), 'full');
            $product_title = $loop_product->post_title;
            $product_desc = $loop_product->post_content;
            $product_desc_new = substr($product_desc, 0, 250);
            ?>
<a href="<?php echo post_permalink($loop_product->ID) ?>">
            <span class="results-items EqHeightDiv col-sm-3 nopadding ">
                <span class="left-col">
                    <span><img src="<?php echo get_template_directory_uri() . "/timthumb.php?src=" . $product_image[0]; ?>&a=t&w=500&h=300&zc=1' alt=''>" class="img-responsive" alt="Responsive image"></span>
                </span>
                <span class="">
                    <span class="feature_desc_wrpper">
                        <h4><?php echo $product_title; ?></h4>
                        <span class="des"><?php echo $product_desc_new; ?></span>
                    </span>
                    <span><span class="view-more">View More</span></span>
                </span>
            </span>
</a>
            <?php
        }
        exit();
        // echo json_encode($message);
    }

    function filter_view_more_3() {
        $this->action_piority($_POST['pgnonce']);
        $price_value = isset($_POST['price_value']) ? $_POST['price_value'] : "";
        $price_key = isset($_POST['price_key']) ? $_POST['price_key'] : "";
        $length_key = isset($_POST['length_key']) ? $_POST['length_key'] : "";
        $length_value = isset($_POST['length_value']) ? $_POST['length_value'] : "";
        $dealer_value = isset($_POST['dealer_value']) ? $_POST['dealer_value'] : "";
        $dealer_key = isset($_POST['dealer_key']) ? $_POST['dealer_key'] : "";
        $product_category = isset($_POST['product_category']) ? $_POST['product_category'] : "";
        $product_count = isset($_POST['product_count']) ? $_POST['product_count'] : "";
        $arry = array();
        $cat_array = array();
//        var_dump($product_category);
        if ($product_category != '') {
            $cat_array[] = array(
                'taxonomy' => 'products_category',
                'field' => 'slug',
                'terms' => $product_category
            );
        } else {
            $cat_array = array();
        }

        if ($price_value != '') {

            $arry[] = array(
                'key' => $price_key,
                'value' => $price_value,
                'compare' => '='
            );
        }
        if ($length_value != '') {
            $arry[] = array(
                'key' => $length_key,
                'value' => $length_value,
                'compare' => '='
            );
        }
        if ($dealer_value != '') {
            $arry[] = array(
                'key' => $dealer_key,
                'value' => $dealer_value,
                'compare' => '='
            );
        }
        if ($product_category || $price_value || $length_value || $dealer_value) {

            $argsproducts = array(
                'posts_per_page' => 3,
                'offset' => $product_count,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
                'meta_query' => array($arry),
                'tax_query' => array($cat_array)
            );
        } else {
            $argsproducts = array(
                'posts_per_page' => 3,
                'offset' => $product_count,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
            );
        }
//         var_dump($argsproducts);
        $looppro = get_posts($argsproducts);
        foreach ($looppro as $loop_product) {
            $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($loop_product->ID), 'full');
            $product_title = $loop_product->post_title;
            $product_desc = $loop_product->post_content;
            $product_desc_new = substr($product_desc, 0, 250);
            ?>
<a href="<?php echo post_permalink($loop_product->ID) ?>">
            <span class="results-items EqHeightDiv col-sm-4 nopadding ">
                <span class="left-col">
                    <span><img src="<?php echo get_template_directory_uri() . "/timthumb.php?src=" . $product_image[0]; ?>&a=t&w=500&h=300&zc=1' alt=''>" class="img-responsive" alt="Responsive image"></span>
                </span>
                <span class="">
                    <span class="feature_desc_wrpper">
                        <h4><?php echo $product_title; ?></h4>
                        <span class="des"><?php echo $product_desc_new; ?></span>
                    </span>
                    <span><span class="view-more">View More</span></span>
                </span>
            </span>
</a>
            <?php
        }
        exit();
        // echo json_encode($message);
    }

    function filter_price() {
        $this->action_piority($_POST['pgnonce']);
        $price_value = isset($_POST['price_value']) ? $_POST['price_value'] : "";
        $price_key = isset($_POST['price_key']) ? $_POST['price_key'] : "";
        $length_key = isset($_POST['length_key']) ? $_POST['length_key'] : "";
        $length_value = isset($_POST['length_value']) ? $_POST['length_value'] : "";
//        $dealer_value = 'aaa';
        $dealer_value = isset($_POST['dealer_value']) ? $_POST['dealer_value'] : "";
        $dealer_key = isset($_POST['dealer_key']) ? $_POST['dealer_key'] : "";
//        var_dump($dealer_key);
        $product_category = isset($_POST['product_category']) ? $_POST['product_category'] : "";
        $arry = array();
        $cat_array = array();
        if ($product_category != '') {
            $cat_array[] = array(
                'taxonomy' => 'products_category',
                'field' => 'slug',
                'terms' => $product_category
            );
        } else {
            $cat_array = array();
        }

        if ($price_value != '') {

            $arry[] = array(
                'key' => $price_key,
                'value' => $price_value,
                'compare' => '='
            );
        }
        if ($length_value != '') {
            $arry[] = array(
                'key' => $length_key,
                'value' => $length_value,
                'compare' => '='
            );
        }
        if ($dealer_value != '') {
            $arry[] = array(
                'key' => $dealer_key,
                'value' => $dealer_value,
                'compare' => 'LIKE'
            );
        }
        if ($product_category || $price_value || $length_value || $dealer_value) {
            $argsproducts = array(
                'posts_per_page' => 3,
                'offset' => 0,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
                'meta_query' => array($arry),
                'tax_query' => array($cat_array)
            );
//            print_r($argsproducts);
        } else if ($product_category == '') {
            $argsproducts = array(
                'posts_per_page' => 3,
                'offset' => 0,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
                'meta_query' => array($arry)
            );
        } else {
            $argsproducts = array(
                'posts_per_page' => 3,
                'offset' => 0,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
            );
        }

        $looppro = get_posts($argsproducts);
//            var_dump($looppro);
        foreach ($looppro as $loop_product) {
//                var_dump($loop_product->ID);
            $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($loop_product->ID), 'full');
            $product_title = $loop_product->post_title;
            $product_desc = $loop_product->post_content;
            $product_desc_new = substr($product_desc, 0, 250);
            ?>
<a href="<?php echo post_permalink($loop_product->ID) ?>">
            <span class="results-items EqHeightDiv col-sm-4 nopadding ">
                <span class="left-col">
                    <span><img src="<?php echo get_template_directory_uri() . "/timthumb.php?src=" . $product_image[0]; ?>&a=t&w=500&h=300&zc=1' alt=''>" class="img-responsive" alt="Responsive image"></span>
                </span>
                <span class="">
                    <span class="feature_desc_wrpper">
                        <h4><?php echo $product_title; ?></h4>
                        <span class="des"><?php echo $product_desc_new; ?></span>
                    </span>
                    <span><span class="view-more">View More</span></span>
                </span>
            </span>
</a>
            <?php
        }
        exit();
        // echo json_encode($message);
    }

    function filter_price_full() {
        $this->action_piority($_POST['pgnonce']);
        $price_value = isset($_POST['price_value']) ? $_POST['price_value'] : "";
        $price_key = isset($_POST['price_key']) ? $_POST['price_key'] : "";
        $length_key = isset($_POST['length_key']) ? $_POST['length_key'] : "";
        $length_value = isset($_POST['length_value']) ? $_POST['length_value'] : "";
//        $dealer_value = 'aaa';
        $dealer_value = isset($_POST['dealer_value']) ? $_POST['dealer_value'] : "";
        $dealer_key = isset($_POST['dealer_key']) ? $_POST['dealer_key'] : "";
//        var_dump($dealer_key);
        $product_category = isset($_POST['product_category']) ? $_POST['product_category'] : "";
        $arry = array();
        $cat_array = array();
        if ($product_category != '') {
            $cat_array[] = array(
                'taxonomy' => 'products_category',
                'field' => 'slug',
                'terms' => $product_category
            );
        } else {
            $cat_array = array();
        }

        if ($price_value != '') {

            $arry[] = array(
                'key' => $price_key,
                'value' => $price_value,
                'compare' => '='
            );
        }
        if ($length_value != '') {
            $arry[] = array(
                'key' => $length_key,
                'value' => $length_value,
                'compare' => '='
            );
        }
        if ($dealer_value != '') {
            $arry[] = array(
                'key' => $dealer_key,
                'value' => $dealer_value,
                'compare' => 'LIKE'
            );
        }
        if ($product_category || $price_value || $length_value || $dealer_value) {
            $argsproducts = array(
                'posts_per_page' => 2,
                'offset' => 0,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
                'meta_query' => array($arry),
                'tax_query' => array($cat_array)
            );
//            print_r($argsproducts);
        } else if ($product_category == '') {
            $argsproducts = array(
                'posts_per_page' => 2,
                'offset' => 0,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
                'meta_query' => array($arry)
            );
        } else {
            $argsproducts = array(
                'posts_per_page' => 2,
                'offset' => 0,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
            );
        }

        $looppro = get_posts($argsproducts);
//            var_dump($looppro);
        foreach ($looppro as $loop_product) {
//                var_dump($loop_product->ID);
            $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($loop_product->ID), 'full');
            $product_title = $loop_product->post_title;
            $product_desc = $loop_product->post_content;
            $product_desc_new = substr($product_desc, 0, 250);
            ?>
            <a href="<?php echo post_permalink($loop_product->ID) ?>">
            <span class="results-items EqHeightDiv col-sm-12 nopadding ">
                <span class="left-col">
                    <span><img src="<?php echo get_template_directory_uri() . "/timthumb.php?src=" . $product_image[0]; ?>&a=t&w=500&h=300&zc=1' alt=''>" class="img-responsive" alt="Responsive image"></span>
                </span>
                <span class="">
                    <span class="feature_desc_wrpper">
                        <h4><?php echo $product_title; ?></h4>
                        <span class="des"><?php echo $product_desc_new; ?></span>
                    </span>
                    <span><span class="view-more">View More</span></span>
                </span>
            </span>
</a>
            <?php
        }
        exit();
        // echo json_encode($message);
    }

    function filter_price_4() {
        $this->action_piority($_POST['pgnonce']);
        $price_value = isset($_POST['price_value']) ? $_POST['price_value'] : "";
        $price_key = isset($_POST['price_key']) ? $_POST['price_key'] : "";
        $length_key = isset($_POST['length_key']) ? $_POST['length_key'] : "";
        $length_value = isset($_POST['length_value']) ? $_POST['length_value'] : "";
//        $dealer_value = 'aaa';
        $dealer_value = isset($_POST['dealer_value']) ? $_POST['dealer_value'] : "";
        $dealer_key = isset($_POST['dealer_key']) ? $_POST['dealer_key'] : "";
//        var_dump($dealer_key);
        $product_category = isset($_POST['product_category']) ? $_POST['product_category'] : "";
        $arry = array();
        $cat_array = array();
        if ($product_category != '') {
            $cat_array[] = array(
                'taxonomy' => 'products_category',
                'field' => 'slug',
                'terms' => $product_category
            );
        } else {
            $cat_array = array();
        }

        if ($price_value != '') {

            $arry[] = array(
                'key' => $price_key,
                'value' => $price_value,
                'compare' => '='
            );
        }
        if ($length_value != '') {
            $arry[] = array(
                'key' => $length_key,
                'value' => $length_value,
                'compare' => '='
            );
        }
        if ($dealer_value != '') {
            $arry[] = array(
                'key' => $dealer_key,
                'value' => $dealer_value,
                'compare' => 'LIKE'
            );
        }
        if ($product_category || $price_value || $length_value || $dealer_value) {
            $argsproducts = array(
                'posts_per_page' => 4,
                'offset' => 0,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
                'meta_query' => array($arry),
                'tax_query' => array($cat_array)
            );
//            print_r($argsproducts);
        } else if ($product_category == '') {
            $argsproducts = array(
                'posts_per_page' => 4,
                'offset' => 0,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
                'meta_query' => array($arry)
            );
        } else {
            $argsproducts = array(
                'posts_per_page' => 4,
                'offset' => 0,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
            );
        }

        $looppro = get_posts($argsproducts);
//            var_dump($looppro);
        foreach ($looppro as $loop_product) {
//                var_dump($loop_product->ID);
            $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($loop_product->ID), 'full');
            $product_title = $loop_product->post_title;
            $product_desc = $loop_product->post_content;
            $product_desc_new = substr($product_desc, 0, 250);
            ?>
            <a href="<?php echo post_permalink($loop_product->ID) ?>">
            <span class="results-items EqHeightDiv col-sm-4 nopadding ">
                <span class="left-col">
                    <span><img src="<?php echo get_template_directory_uri() . "/timthumb.php?src=" . $product_image[0]; ?>&a=t&w=500&h=300&zc=1' alt=''>" class="img-responsive" alt="Responsive image"></span>
                </span>
                <span class="">
                    <span class="feature_desc_wrpper">
                        <h4><?php echo $product_title; ?></h4>
                        <span class="des"><?php echo $product_desc_new; ?></span>
                    </span>
                    <span><span class="view-more">View More</span></span>
                </span>
            </span>
</a>
            <?php
        }
        exit();
        // echo json_encode($message);
    }

    function filter_price_3() {
        $this->action_piority($_POST['pgnonce']);
        $price_value = isset($_POST['price_value']) ? $_POST['price_value'] : "";
        $price_key = isset($_POST['price_key']) ? $_POST['price_key'] : "";
        $length_key = isset($_POST['length_key']) ? $_POST['length_key'] : "";
        $length_value = isset($_POST['length_value']) ? $_POST['length_value'] : "";
//        $dealer_value = 'aaa';
        $dealer_value = isset($_POST['dealer_value']) ? $_POST['dealer_value'] : "";
        $dealer_key = isset($_POST['dealer_key']) ? $_POST['dealer_key'] : "";
//        var_dump($dealer_key);
        $product_category = isset($_POST['product_category']) ? $_POST['product_category'] : "";
        $arry = array();
        $cat_array = array();
        if ($product_category != '') {
            $cat_array[] = array(
                'taxonomy' => 'products_category',
                'field' => 'slug',
                'terms' => $product_category
            );
        } else {
            $cat_array = array();
        }

        if ($price_value != '') {

            $arry[] = array(
                'key' => $price_key,
                'value' => $price_value,
                'compare' => '='
            );
        }
        if ($length_value != '') {
            $arry[] = array(
                'key' => $length_key,
                'value' => $length_value,
                'compare' => '='
            );
        }
        if ($dealer_value != '') {
            $arry[] = array(
                'key' => $dealer_key,
                'value' => $dealer_value,
                'compare' => 'LIKE'
            );
        }
        if ($product_category || $price_value || $length_value || $dealer_value) {
            $argsproducts = array(
                'posts_per_page' => 3,
                'offset' => 0,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
                'meta_query' => array($arry),
                'tax_query' => array($cat_array)
            );
//            print_r($argsproducts);
        } else if ($product_category == '') {
            $argsproducts = array(
                'posts_per_page' => 3,
                'offset' => 0,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
                'meta_query' => array($arry)
            );
        } else {
            $argsproducts = array(
                'posts_per_page' => 3,
                'offset' => 0,
                'orderby' => 'post_date',
                'category' => '',
                'post_type' => 'products',
                'post_status' => 'publish',
                'order' => 'DESC',
            );
        }

        $looppro = get_posts($argsproducts);
//            var_dump($looppro);
        foreach ($looppro as $loop_product) {
//                var_dump($loop_product->ID);
            $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($loop_product->ID), 'full');
            $product_title = $loop_product->post_title;
            $product_desc = $loop_product->post_content;
            $product_desc_new = substr($product_desc, 0, 250);
            ?>
<a href="<?php echo post_permalink($loop_product->ID) ?>" >
            <span class="results-items EqHeightDiv col-sm-4 nopadding ">
                <span class="left-col">                        
                    <span><span><img src="<?php echo get_template_directory_uri() . "/timthumb.php?src=" . $product_image[0]; ?>&a=t&w=500&h=300&zc=1' alt=''>" class="img-responsive" alt="Responsive image"></span></span>
                </span>
                <span class="">
                    <span class="feature_desc_wrpper">
                        <h4><?php echo $product_title; ?></h4>
                        <span class="des"><?php echo $product_desc_new; ?></span>
                    </span>
                    <span><span class="view-more ">View More</span></span>
                </span>
            </span>
</a>
            <?php
        }
        exit();
        // echo json_encode($message);
    }

    function filter_up() {
        global $wpdb;
        $this->action_piority($_POST['pgnonce']);
        $ustae_value = isset($_POST['ustae_value']) ? $_POST['ustae_value'] : "";
        $umoth_value = isset($_POST['umoth_value']) ? $_POST['umoth_value'] : "";
        $product_count = isset($_POST['product_count']) ? $_POST['product_count'] : "";

        $umoth_value2 = date('Y') . $umoth_value;
        if ($ustae_value == 'all (states)') {
            $ustae_value = 'all';
        } else {
            $ustae_value = $ustae_value;
        }

        if ($ustae_value != 'all' && $umoth_value != 'all') {
            $query = $wpdb->get_results("SELECT DISTINCT wp_postmeta.post_id FROM wp_postmeta WHERE wp_postmeta.meta_key = 'upcoming_state' AND wp_postmeta.meta_value = '" . $ustae_value . "' AND wp_postmeta.post_id  IN (SELECT wp_postmeta.post_id FROM wp_postmeta WHERE wp_postmeta.meta_key = 'upcoming_show_start_date' AND meta_value LIKE '%" . $umoth_value2 . "%' OR wp_postmeta.meta_key = 'upcoming_show_end_date' AND wp_postmeta.meta_value LIKE '%" . $umoth_value2 . "%')");
        } else if ($ustae_value != 'all' && $umoth_value == 'all') {
            $query = $wpdb->get_results("SELECT DISTINCT wp_postmeta.post_id FROM wp_postmeta WHERE wp_postmeta.meta_key = 'upcoming_state' AND wp_postmeta.meta_value = '" . $ustae_value . "'");
        } else if ($ustae_value == 'all' && $umoth_value != 'all') {
            $query = $wpdb->get_results("SELECT DISTINCT wp_postmeta.post_id FROM wp_postmeta WHERE wp_postmeta.meta_key = 'upcoming_show_start_date' AND meta_value LIKE '%" . $umoth_value2 . "%' OR wp_postmeta.meta_key = 'upcoming_show_end_date' AND wp_postmeta.meta_value LIKE '%" . $umoth_value2 . "%'");
        } else if ($ustae_value == 'all' && $umoth_value == 'all') {
            $query = $wpdb->get_results("SELECT DISTINCT wp_posts.ID FROM wp_posts WHERE wp_posts.post_type = 'events' AND post_status='publish'");
        } else {
            $query = '';
        }
//       var_dump($query);
        $p_id = array();
        foreach ($query as $key => $value) {
            if ($ustae_value == 'all' && $umoth_value == 'all') {
                $p_id[] = $query[$key]->ID;
            } else {
                $p_id[] = $query[$key]->post_id;
            }
        }
        if (!empty($p_id)) {
            $args = array(
                'orderby' => 'post_date',
                'category' => '',
                'order' => 'DESC',
                'post_type' => 'events',
                'post_status' => 'publish',
                'post__in' => $p_id,
                'posts_per_page' => 2,
                'offset' => $product_count,
            );
            $post_ids = get_posts($args);
            foreach ($post_ids as $_post1) {
                if (has_post_thumbnail($_post1->ID)) {
                    $url = wp_get_attachment_image_src(get_post_thumbnail_id($_post1->ID), 'full');
                }
                $pp_id = $_post1->ID;

                $event_image = wp_get_attachment_image_src(get_post_thumbnail_id($pp_id), 'full');
                $event_title = $_post1->post_title;
                $event_desc = $_post1->post_content;
                $event_image_title = get_field('upcoming_image_title', $pp_id);
                $event_website_name = get_field('webiste_d', $pp_id);
                $event_dealer_new = get_field('dealer_list', $pp_id);
                $event_dealer = $event_dealer_new[0]->post_title;

                $event_date = get_field('upcoming_show_start_date', $pp_id);
                $event_date_end = get_field('upcoming_show_end_date', $pp_id);
                $dt = DateTime::createFromFormat('!d/m/Y', $event_date);
                $dt2 = DateTime::createFromFormat('!d/m/Y', $event_date_end);
                $event_date_month = strtoupper($dt->format('M'));
                $event_date_end_month = strtoupper($dt2->format('M'));
                $event_date_date = strtoupper($dt->format('j'));
                $event_date_date_start = strtoupper($dt->format('j-M-Y'));
                $event_date_date_end = strtoupper($dt2->format('j-M-Y'));
                ?>
                <div class="results-items EqHeightDiv col-sm-12 nopadding ">
                    <div class="row">

                        <div class="left-col col-sm-6 col-md-4">
                            <p>
                                <a href="#">
                <?php
                echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . $event_image[0] . "&a=t&w=473&h=200&zc=1' alt=''>";
                ?>
                                </a>
                            </p>
                            <h3 class="uppercase"><a href="<?php echo $event_show_web_link; ?>" target="_blank">LINK OF SHOW WEBSITE</a></h3>
                            <div class="findyour col-sm-12 ">
                                <h4><?php echo $event_image_title; ?> </h4>
                                <p>View Exhibitors <i class="fa fa-chevron-right"></i></p>
                            </div>
                        </div>
                        <div class="pull-right col-sm-6 col-md-8 items-right">
                            <h4><?php echo $event_title; ?></h4>
                            <div class="calendar">
                                <div class="month uppercase"><?php echo $event_date_month; ?></div>
                                <div class="day"><?php echo $event_date_date; ?></div>
                            </div>
                            <div class="from">From <?php echo $event_date_date_start; ?> TO <?php echo $event_date_date_end; ?></div>
                            <div class="dealer">Dealer: <?php echo $event_dealer; ?></div>
                            <div class="website"><a hre="<?php echo $event_show_web_link; ?>" target="_blank" rel="nofollow"><?php echo $event_website_name; ?></a></div>
                            <div><a class="btn btn-default uppercase" type="button" >More</a></div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo 'No Results Found!';
        }
        exit();
        // echo json_encode($message);
    }

    function filter_up_3() {
        global $wpdb;
        $this->action_piority($_POST['pgnonce']);
        $argsevents = array(
            'offset' => 0,
            'orderby' => 'post_date',
            'category' => '',
            'post_type' => 'events',
            'post_status' => 'publish',
            'order' => 'DESC',
            'posts_per_page' => 3,
        );
        $loopevent = get_posts($argsevents);
        foreach ($loopevent as $loop_event) {
            $event_image = wp_get_attachment_image_src(get_post_thumbnail_id($loop_event->ID), 'full');
            $event_title = $loop_event->post_title;
            $event_desc = $loop_event->post_content;
//                    $event_show_web_link = get_field('link_of_show_web_site',$loop_event->ID);
            $event_image_title = get_field('upcoming_image_title', $loop_event->ID);
            $event_website_name = get_field('webiste_d', $loop_event->ID);
            $event_dealer_new = get_field('dealer_list', $loop_event->ID);
            $event_dealer = $event_dealer_new[0]->post_title;

            $event_date = get_field('upcoming_show_start_date', $loop_event->ID);
            $event_date_end = get_field('upcoming_show_end_date', $loop_event->ID);
            $dt = DateTime::createFromFormat('!d/m/Y', $event_date);
            $dt2 = DateTime::createFromFormat('!d/m/Y', $event_date_end);
            $event_date_month = strtoupper($dt->format('M'));
            $event_date_end_month = strtoupper($dt2->format('M'));
            $event_date_date = strtoupper($dt->format('j'));
            $event_date_date_start = strtoupper($dt->format('j-M-Y'));
            $event_date_date_end = strtoupper($dt2->format('j-M-Y'));
            ?>
            <div class="results-items col-sm-4 nopadding ">
                <div class="row">

                    <div class="left-col col-sm-12 col-md-12">
                        <p>
                            <a href="#">
            <?php
            echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . $event_image[0] . "&a=t&w=473&h=200&zc=1' alt=''>";
            ?>
                            </a>
                        </p>
                        <h3 class="uppercase"><a href="<?php echo $event_website_name; ?>" target="_blank">LINK OF SHOW WEBSITE</a></h3>
                        <div class="findyour col-sm-12 ">
                            <h4><?php echo $event_image_title; ?> </h4>
                            <a href="<?php echo $event_website_name; ?>" target="_blank"><p>View Exhibitors <i class="fa fa-chevron-right"></i></p></a>
                        </div>
                    </div>
                    <div class="pull-right col-sm-6 col-md-8 items-right">
                        <h4><?php echo $event_title; ?></h4>
                        <div class="calendar">
                            <div class="month uppercase">
                                <?php
                                if ($event_date_month != '' || $event_date_month != null) {
                                    echo $event_date_month;
                                }
                                ?>
                            </div>
                            <div class="day">
            <?php
            if ($event_date_date != '' || $event_date_date != null) {
                echo $event_date_date;
            }
            ?>

                            </div>
                        </div>
                        <div class="from">From <?php echo $event_date_date_start; ?> TO <?php echo $event_date_date_end; ?></div>
                        <div class="dealer">Dealer: <?php echo $event_dealer; ?></div>
                        <div class="website"><a href="<?php echo $event_website_name; ?>" target="_blank" rel="nofollow"><?php echo $event_website_name; ?></a></div>
                        <div><a class="btn btn-default uppercase" href="<?php echo $event_website_name; ?>" target="_blank" >More</a></div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php
//        } else {
//            echo 'No Results Found!';
//        }
        exit();
        // echo json_encode($message);
    }

    function filter_up_4() {
        global $wpdb;
        $this->action_piority($_POST['pgnonce']);
        $argsevents = array(
            'offset' => 0,
            'orderby' => 'post_date',
            'category' => '',
            'post_type' => 'events',
            'post_status' => 'publish',
            'order' => 'DESC',
            'posts_per_page' => 4,
        );
        $loopevent = get_posts($argsevents);
        foreach ($loopevent as $loop_event) {
            $event_image = wp_get_attachment_image_src(get_post_thumbnail_id($loop_event->ID), 'full');
            $event_title = $loop_event->post_title;
            $event_desc = $loop_event->post_content;
//                    $event_show_web_link = get_field('link_of_show_web_site',$loop_event->ID);
            $event_image_title = get_field('upcoming_image_title', $loop_event->ID);
            $event_website_name = get_field('webiste_d', $loop_event->ID);
            $event_dealer_new = get_field('dealer_list', $loop_event->ID);
            $event_dealer = $event_dealer_new[0]->post_title;

            $event_date = get_field('upcoming_show_start_date', $loop_event->ID);
            $event_date_end = get_field('upcoming_show_end_date', $loop_event->ID);
            $dt = DateTime::createFromFormat('!d/m/Y', $event_date);
            $dt2 = DateTime::createFromFormat('!d/m/Y', $event_date_end);
            $event_date_month = strtoupper($dt->format('M'));
            $event_date_end_month = strtoupper($dt2->format('M'));
            $event_date_date = strtoupper($dt->format('j'));
            $event_date_date_start = strtoupper($dt->format('j-M-Y'));
            $event_date_date_end = strtoupper($dt2->format('j-M-Y'));
            ?>
            <div class="results-items col-sm-3 nopadding ">
                <div class="row">

                    <div class="left-col col-sm-12 col-md-12">
                        <p>
                            <a href="#">
            <?php
            echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . $event_image[0] . "&a=t&w=473&h=200&zc=1' alt=''>";
            ?>
                            </a>
                        </p>
                        <h3 class="uppercase"><a href="<?php echo $event_website_name; ?>" target="_blank">LINK OF SHOW WEBSITE</a></h3>
                        <div class="findyour col-sm-12 ">
                            <h4><?php echo $event_image_title; ?> </h4>
                            <a href="<?php echo $event_website_name; ?>" target="_blank"><p>View Exhibitors <i class="fa fa-chevron-right"></i></p></a>
                        </div>
                    </div>
                    <div class="pull-right col-sm-6 col-md-8 items-right">
                        <h4><?php echo $event_title; ?></h4>
                        <div class="calendar">
                            <div class="month uppercase">
            <?php
            if ($event_date_month != '' || $event_date_month != null) {
                echo $event_date_month;
            }
            ?>
                            </div>
                            <div class="day">
            <?php
            if ($event_date_date != '' || $event_date_date != null) {
                echo $event_date_date;
            }
            ?>

                            </div>
                        </div>
                        <div class="from">From <?php echo $event_date_date_start; ?> TO <?php echo $event_date_date_end; ?></div>
                        <div class="dealer">Dealer: <?php echo $event_dealer; ?></div>
                        <div class="website"><a href="<?php echo $event_website_name; ?>" target="_blank" rel="nofollow"><?php echo $event_website_name; ?></a></div>
                        <div><a class="btn btn-default uppercase" href="<?php echo $event_website_name; ?>" target="_blank" >More</a></div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php
//        } else {
//            echo 'No Results Found!';
//        }
        exit();
        // echo json_encode($message);
    }

    function filter_view_more_up() {
        global $wpdb;
        $this->action_piority($_POST['pgnonce']);
        $ustae_value = isset($_POST['ustae_value']) ? $_POST['ustae_value'] : "";
        $umoth_value = isset($_POST['umoth_value']) ? $_POST['umoth_value'] : "";
        $product_count = isset($_POST['product_count']) ? $_POST['product_count'] : "";

        $umoth_value2 = date('Y') . $umoth_value;
        if ($ustae_value == 'all (states)') {
            $ustae_value = 'all';
        } else {
            $ustae_value = $ustae_value;
        }
        if ($ustae_value != 'all' && $umoth_value != 'all') {
            $query = $wpdb->get_results("SELECT DISTINCT wp_postmeta.post_id FROM wp_postmeta WHERE wp_postmeta.meta_key = 'upcoming_state' AND wp_postmeta.meta_value = '" . $ustae_value . "' AND wp_postmeta.post_id  IN (SELECT wp_postmeta.post_id FROM wp_postmeta WHERE wp_postmeta.meta_key = 'upcoming_show_start_date' AND meta_value LIKE '%" . $umoth_value2 . "%' OR wp_postmeta.meta_key = 'upcoming_show_end_date' AND wp_postmeta.meta_value LIKE '%" . $umoth_value2 . "%')");
        } else if ($ustae_value != 'all' && $umoth_value == 'all') {
            $query = $wpdb->get_results("SELECT DISTINCT wp_postmeta.post_id FROM wp_postmeta WHERE wp_postmeta.meta_key = 'upcoming_state' AND wp_postmeta.meta_value = '" . $ustae_value . "'");
        } else if ($ustae_value == 'all' && $umoth_value != 'all') {
            $query = $wpdb->get_results("SELECT DISTINCT wp_postmeta.post_id FROM wp_postmeta WHERE wp_postmeta.meta_key = 'upcoming_show_start_date' AND meta_value LIKE '%" . $umoth_value2 . "%' OR wp_postmeta.meta_key = 'upcoming_show_end_date' AND wp_postmeta.meta_value LIKE '%" . $umoth_value2 . "%'");
        } else if ($ustae_value == 'all' && $umoth_value == 'all') {
            $query = $wpdb->get_results("SELECT DISTINCT wp_posts.ID FROM wp_posts WHERE wp_posts.post_type = 'events' AND post_status='publish'");
        } else {
            $query = '';
        }
        $p_id = array();
        foreach ($query as $key => $value) {
            if ($ustae_value == 'all' && $umoth_value == 'all') {
                $p_id[] = $value->ID;
            } else {
                $p_id[] = $value->post_id;
            }
        }
        if (!empty($p_id)) {
            $args = array(
                'orderby' => 'post_date',
                'category' => '',
                'order' => 'DESC',
                'post_type' => 'events',
                'post_status' => 'publish',
                'post__in' => $p_id,
                'posts_per_page' => 2,
                'offset' => $product_count,
            );
            $post_ids = get_posts($args);

            foreach ($post_ids as $_post1) {
                if (has_post_thumbnail($_post1->ID)) {
                    $url = wp_get_attachment_image_src(get_post_thumbnail_id($_post1->ID), 'full');
                }
                $pp_id = $_post1->ID;

                $event_image = wp_get_attachment_image_src(get_post_thumbnail_id($pp_id), 'full');
                $event_title = $_post1->post_title;
                $event_desc = $_post1->post_content;

                $event_image_title = get_field('upcoming_image_title', $pp_id);
                $event_website_name = get_field('webiste_d', $pp_id);
                $event_dealer_new = get_field('dealer_list', $pp_id);
                $event_dealer = $event_dealer_new[0]->post_title;

                $event_date = get_field('upcoming_show_start_date', $pp_id);
                $event_date_end = get_field('upcoming_show_end_date', $pp_id);
                $dt = DateTime::createFromFormat('!d/m/Y', $event_date);
                $dt2 = DateTime::createFromFormat('!d/m/Y', $event_date_end);
                $event_date_month = strtoupper($dt->format('M'));
                $event_date_end_month = strtoupper($dt2->format('M'));
                $event_date_date = strtoupper($dt->format('j'));
                $event_date_date_start = strtoupper($dt->format('j-M-Y'));
                $event_date_date_end = strtoupper($dt2->format('j-M-Y'));
                ?>
                <div class="results-items EqHeightDiv col-sm-12 nopadding ">
                    <div class="row">

                        <div class="left-col col-sm-6 col-md-4">
                            <p>
                                <a href="#">
                <?php
                echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . $event_image[0] . "&a=t&w=473&h=200&zc=1' alt=''>";
                ?>
                                </a>
                            </p>
                            <h3 class="uppercase"><a href="<?php echo $event_show_web_link; ?>" target="_blank">LINK OF SHOW WEBSITE</a></h3>
                            <div class="findyour col-sm-12 ">
                                <h4><?php echo $event_image_title; ?> </h4>
                                <p>View Exhibitors <i class="fa fa-chevron-right"></i></p>
                            </div>
                        </div>
                        <div class="pull-right col-sm-6 col-md-8 items-right">
                            <h4><?php echo $event_title; ?></h4>
                            <div class="calendar">
                                <div class="month uppercase"><?php echo $event_date_month; ?></div>
                                <div class="day"><?php echo $event_date_date; ?></div>
                            </div>
                            <div class="from">From <?php echo $event_date_date_start; ?> TO <?php echo $event_date_date_end; ?></div>
                            <div class="dealer">Dealer: <?php echo $event_dealer; ?></div>
                            <div class="website"><a hre="<?php echo $event_show_web_link; ?>" target="_blank" rel="nofollow"><?php echo $event_website_name; ?></a></div>
                            <div><a class="btn btn-default uppercase" type="button" >More</a></div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

            <?php
        } else {
            echo 'No Results Found!';
        }
        exit();
    }

    function filter_view_more_up_4() {
        global $wpdb;
        $this->action_piority($_POST['pgnonce']);
        $ustae_value = isset($_POST['ustae_value']) ? $_POST['ustae_value'] : "";
        $umoth_value = isset($_POST['umoth_value']) ? $_POST['umoth_value'] : "";
        $product_count = isset($_POST['product_count']) ? $_POST['product_count'] : "";

        $umoth_value2 = date('Y') . $umoth_value;
        if ($ustae_value == 'all (states)') {
            $ustae_value = 'all';
        } else {
            $ustae_value = $ustae_value;
        }
        if ($ustae_value != 'all' && $umoth_value != 'all') {
            $query = $wpdb->get_results("SELECT DISTINCT wp_postmeta.post_id FROM wp_postmeta WHERE wp_postmeta.meta_key = 'upcoming_state' AND wp_postmeta.meta_value = '" . $ustae_value . "' AND wp_postmeta.post_id  IN (SELECT wp_postmeta.post_id FROM wp_postmeta WHERE wp_postmeta.meta_key = 'upcoming_show_start_date' AND meta_value LIKE '%" . $umoth_value2 . "%' OR wp_postmeta.meta_key = 'upcoming_show_end_date' AND wp_postmeta.meta_value LIKE '%" . $umoth_value2 . "%')");
        } else if ($ustae_value != 'all' && $umoth_value == 'all') {
            $query = $wpdb->get_results("SELECT DISTINCT wp_postmeta.post_id FROM wp_postmeta WHERE wp_postmeta.meta_key = 'upcoming_state' AND wp_postmeta.meta_value = '" . $ustae_value . "'");
        } else if ($ustae_value == 'all' && $umoth_value != 'all') {
            $query = $wpdb->get_results("SELECT DISTINCT wp_postmeta.post_id FROM wp_postmeta WHERE wp_postmeta.meta_key = 'upcoming_show_start_date' AND meta_value LIKE '%" . $umoth_value2 . "%' OR wp_postmeta.meta_key = 'upcoming_show_end_date' AND wp_postmeta.meta_value LIKE '%" . $umoth_value2 . "%'");
        } else if ($ustae_value == 'all' && $umoth_value == 'all') {
            $query = $wpdb->get_results("SELECT DISTINCT wp_posts.ID FROM wp_posts WHERE wp_posts.post_type = 'events' AND post_status='publish'");
        } else {
            $query = '';
        }
        $p_id = array();
        foreach ($query as $key => $value) {
            if ($ustae_value == 'all' && $umoth_value == 'all') {
                $p_id[] = $value->ID;
            } else {
                $p_id[] = $value->post_id;
            }
        }
        if (!empty($p_id)) {
            $args = array(
                'orderby' => 'post_date',
                'category' => '',
                'order' => 'DESC',
                'post_type' => 'events',
                'post_status' => 'publish',
                'post__in' => $p_id,
                'posts_per_page' => 4,
                'offset' => $product_count,
            );
            $post_ids = get_posts($args);

            foreach ($post_ids as $_post1) {
                if (has_post_thumbnail($_post1->ID)) {
                    $url = wp_get_attachment_image_src(get_post_thumbnail_id($_post1->ID), 'full');
                }
                $pp_id = $_post1->ID;

                $event_image = wp_get_attachment_image_src(get_post_thumbnail_id($pp_id), 'full');
                $event_title = $_post1->post_title;
                $event_desc = $_post1->post_content;

                $event_image_title = get_field('upcoming_image_title', $pp_id);
                $event_website_name = get_field('webiste_d', $pp_id);
                $event_dealer_new = get_field('dealer_list', $pp_id);
                $event_dealer = $event_dealer_new[0]->post_title;

                $event_date = get_field('upcoming_show_start_date', $pp_id);
                $event_date_end = get_field('upcoming_show_end_date', $pp_id);
                $dt = DateTime::createFromFormat('!d/m/Y', $event_date);
                $dt2 = DateTime::createFromFormat('!d/m/Y', $event_date_end);
                $event_date_month = strtoupper($dt->format('M'));
                $event_date_end_month = strtoupper($dt2->format('M'));
                $event_date_date = strtoupper($dt->format('j'));
                $event_date_date_start = strtoupper($dt->format('j-M-Y'));
                $event_date_date_end = strtoupper($dt2->format('j-M-Y'));
                ?>
                <div class="results-items EqHeightDiv col-sm-3 nopadding ">
                    <div class="row">

                        <div class="left-col col-sm-12 col-md-12">
                            <p>
                                <a href="#">
                <?php
                echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . $event_image[0] . "&a=t&w=473&h=200&zc=1' alt=''>";
                ?>
                                </a>
                            </p>
                            <h3 class="uppercase"><a href="<?php echo $event_show_web_link; ?>" target="_blank">LINK OF SHOW WEBSITE</a></h3>
                            <div class="findyour col-sm-12 ">
                                <h4><?php echo $event_image_title; ?> </h4>
                                <p>View Exhibitors <i class="fa fa-chevron-right"></i></p>
                            </div>
                        </div>
                        <div class="pull-right col-sm-6 col-md-8 items-right">
                            <h4><?php echo $event_title; ?></h4>
                            <div class="calendar">
                                <div class="month uppercase"><?php echo $event_date_month; ?></div>
                                <div class="day"><?php echo $event_date_date; ?></div>
                            </div>
                            <div class="from">From <?php echo $event_date_date_start; ?> TO <?php echo $event_date_date_end; ?></div>
                            <div class="dealer">Dealer: <?php echo $event_dealer; ?></div>
                            <div class="website"><a hre="<?php echo $event_show_web_link; ?>" target="_blank" rel="nofollow"><?php echo $event_website_name; ?></a></div>
                            <div><a class="btn btn-default uppercase" type="button" >More</a></div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

            <?php
        } else {
            echo 'No Results Found!';
        }
        exit();
    }

    function filter_view_more_up_3() {
        global $wpdb;
        $this->action_piority($_POST['pgnonce']);
        $ustae_value = isset($_POST['ustae_value']) ? $_POST['ustae_value'] : "";
        $umoth_value = isset($_POST['umoth_value']) ? $_POST['umoth_value'] : "";
        $product_count = isset($_POST['product_count']) ? $_POST['product_count'] : "";

        $umoth_value2 = date('Y') . $umoth_value;
        if ($ustae_value == 'all (states)') {
            $ustae_value = 'all';
        } else {
            $ustae_value = $ustae_value;
        }
        if ($ustae_value != 'all' && $umoth_value != 'all') {
            $query = $wpdb->get_results("SELECT DISTINCT wp_postmeta.post_id FROM wp_postmeta WHERE wp_postmeta.meta_key = 'upcoming_state' AND wp_postmeta.meta_value = '" . $ustae_value . "' AND wp_postmeta.post_id  IN (SELECT wp_postmeta.post_id FROM wp_postmeta WHERE wp_postmeta.meta_key = 'upcoming_show_start_date' AND meta_value LIKE '%" . $umoth_value2 . "%' OR wp_postmeta.meta_key = 'upcoming_show_end_date' AND wp_postmeta.meta_value LIKE '%" . $umoth_value2 . "%')");
        } else if ($ustae_value != 'all' && $umoth_value == 'all') {
            $query = $wpdb->get_results("SELECT DISTINCT wp_postmeta.post_id FROM wp_postmeta WHERE wp_postmeta.meta_key = 'upcoming_state' AND wp_postmeta.meta_value = '" . $ustae_value . "'");
        } else if ($ustae_value == 'all' && $umoth_value != 'all') {
            $query = $wpdb->get_results("SELECT DISTINCT wp_postmeta.post_id FROM wp_postmeta WHERE wp_postmeta.meta_key = 'upcoming_show_start_date' AND meta_value LIKE '%" . $umoth_value2 . "%' OR wp_postmeta.meta_key = 'upcoming_show_end_date' AND wp_postmeta.meta_value LIKE '%" . $umoth_value2 . "%'");
        } else if ($ustae_value == 'all' && $umoth_value == 'all') {
            $query = $wpdb->get_results("SELECT DISTINCT wp_posts.ID FROM wp_posts WHERE wp_posts.post_type = 'events' AND post_status='publish'");
        } else {
            $query = '';
        }
        $p_id = array();
        foreach ($query as $key => $value) {
            if ($ustae_value == 'all' && $umoth_value == 'all') {
                $p_id[] = $value->ID;
            } else {
                $p_id[] = $value->post_id;
            }
        }
        if (!empty($p_id)) {
            $args = array(
                'orderby' => 'post_date',
                'category' => '',
                'order' => 'DESC',
                'post_type' => 'events',
                'post_status' => 'publish',
                'post__in' => $p_id,
                'posts_per_page' => 3,
                'offset' => $product_count,
            );
            $post_ids = get_posts($args);

            foreach ($post_ids as $_post1) {
                if (has_post_thumbnail($_post1->ID)) {
                    $url = wp_get_attachment_image_src(get_post_thumbnail_id($_post1->ID), 'full');
                }
                $pp_id = $_post1->ID;

                $event_image = wp_get_attachment_image_src(get_post_thumbnail_id($pp_id), 'full');
                $event_title = $_post1->post_title;
                $event_desc = $_post1->post_content;

                $event_image_title = get_field('upcoming_image_title', $pp_id);
                $event_website_name = get_field('webiste_d', $pp_id);
                $event_dealer_new = get_field('dealer_list', $pp_id);
                $event_dealer = $event_dealer_new[0]->post_title;

                $event_date = get_field('upcoming_show_start_date', $pp_id);
                $event_date_end = get_field('upcoming_show_end_date', $pp_id);
                $dt = DateTime::createFromFormat('!d/m/Y', $event_date);
                $dt2 = DateTime::createFromFormat('!d/m/Y', $event_date_end);
                $event_date_month = strtoupper($dt->format('M'));
                $event_date_end_month = strtoupper($dt2->format('M'));
                $event_date_date = strtoupper($dt->format('j'));
                $event_date_date_start = strtoupper($dt->format('j-M-Y'));
                $event_date_date_end = strtoupper($dt2->format('j-M-Y'));
                ?>
                <div class="results-items EqHeightDiv col-sm-4 nopadding ">
                    <div class="row">

                        <div class="left-col col-sm-12 col-md-12">
                            <p>
                                <a href="#">
                <?php
                echo "<img class='img-responsive' src='" . get_template_directory_uri() . "/timthumb.php?src=" . $event_image[0] . "&a=t&w=473&h=200&zc=1' alt=''>";
                ?>
                                </a>
                            </p>
                            <h3 class="uppercase"><a href="<?php echo $event_show_web_link; ?>" target="_blank">LINK OF SHOW WEBSITE</a></h3>
                            <div class="findyour col-sm-12 ">
                                <h4><?php echo $event_image_title; ?> </h4>
                                <p>View Exhibitors <i class="fa fa-chevron-right"></i></p>
                            </div>
                        </div>
                        <div class="pull-right col-sm-6 col-md-8 items-right">
                            <h4><?php echo $event_title; ?></h4>
                            <div class="calendar">
                                <div class="month uppercase"><?php echo $event_date_month; ?></div>
                                <div class="day"><?php echo $event_date_date; ?></div>
                            </div>
                            <div class="from">From <?php echo $event_date_date_start; ?> TO <?php echo $event_date_date_end; ?></div>
                            <div class="dealer">Dealer: <?php echo $event_dealer; ?></div>
                            <div class="website"><a hre="<?php echo $event_show_web_link; ?>" target="_blank" rel="nofollow"><?php echo $event_website_name; ?></a></div>
                            <div><a class="btn btn-default uppercase" type="button" >More</a></div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

            <?php
        } else {
            echo 'No Results Found!';
        }
        exit();
    }

    function show_dealers() {
        $this->action_piority($_POST['pgnonce']);
        $searchTextField = isset($_POST['searchTextField']) ? $_POST['searchTextField'] : "";
        $prod_filt = isset($_POST['prod_filt']) ? $_POST['prod_filt'] : "";
        global $wpdb;
        if ($searchTextField != '') {
            $query = $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE meta_key='dealer_state' AND meta_value='" . $searchTextField . "' or meta_key='dealer_city' AND  meta_value='" . $searchTextField . "'", 'ARRAY_A');
            $query_ = array();
            foreach ($query as $key => $value) {
                $p_id = $query[$key]['post_id'];
                $args = array(
                    'orderby' => 'post_date',
                    'category' => '',
                    'order' => 'DESC',
                    'post_type' => 'dealer',
                    'post_status' => 'publish',
                    'include' => $p_id
                );
                $post_ids = get_posts($args);
                foreach ($post_ids as $_post1) {
                    if (has_post_thumbnail($_post1->ID)) {
                        $url = wp_get_attachment_image_src(get_post_thumbnail_id($_post1->ID), 'full');
                    }
                    $sin_p = $_post1->ID;
                    $address = get_field('address_d', $sin_p);
                    $address1 = $address['address'];
                    $lat = $address['lat'];
                    $lng = $address['lng'];
                    $c_nm = get_field('company_name', $sin_p);
                    $telephone_d = get_field('telephone_d', $sin_p);
                    $email_d = get_field('email_d', $sin_p);
                    $webiste_d = get_field('webiste_d', $sin_p);
                    $opening_hours = get_field('opening_hours', $sin_p);
                    $opening_hours = isset($opening_hours) ? $opening_hours : "";
                    $query_[] = array($address1, $lat, $lng, $key, $c_nm, $telephone_d, $email_d, $webiste_d, $opening_hours);
                    ?>
                    <li class="dl_ulli" data-lat="<?php echo $lat; ?>" data-lang="<?php echo $lng; ?>">
                        <span class="uppercase ttl1"><?php echo $c_nm; ?></span><p><?php echo $address['address']; ?></p><p>T: <?php echo $telephone_d; ?></p><p>E:<a href="mailto:<?php echo $em_ad; ?>" target="_blank" ><?php echo $em_ad; ?></a> </p> <p>W:<a href="http://<?php echo $webiste_d; ?>" target="_blank" > <?php echo $webiste_d; ?></a></p><p>Opening Hours: <?php echo $opening_hours; ?></p>
                    </li>
                    <?php
                }
            }
        } else if ($prod_filt != '') {
            $query = $wpdb->get_results("SELECT * FROM wp_postmeta INNER JOIN wp_posts ON wp_postmeta.post_id = wp_posts.ID WHERE wp_posts.post_title = '" . $prod_filt . "'", 'ARRAY_A');
            $p_id2 = $query[0]['post_id'];
            $query_ = array();
            $p_id = get_field('dealers_list', $p_id2);
            if (isset($p_id)) {
                foreach ($p_id as $p_id4) {
                    $ids_a = $p_id4->ID;
                    $ids_a = array($ids_a);
                    $ids_a = implode(',', $ids_a);

                    $args = array(
                        'orderby' => 'post_date',
                        'category' => '',
                        'order' => 'DESC',
                        'post_type' => 'dealer',
                        'post_status' => 'publish',
                        'include' => $ids_a
                    );
                    $post_ids = get_posts($args);
                    foreach ($post_ids as $_post1) {
//                            $i =0;
                        if (has_post_thumbnail($_post1->ID)) {
                            $url = wp_get_attachment_image_src(get_post_thumbnail_id($_post1->ID), 'full');
                        }
                        $sin_p = $_post1->ID;
                        $address = get_field('address_d', $sin_p);
                        $address1 = $address['address'];
                        $lat = $address['lat'];
                        $lng = $address['lng'];
                        $c_nm = get_field('company_name', $sin_p);
                        $telephone_d = get_field('telephone_d', $sin_p);
                        $email_d = get_field('email_d', $sin_p);
                        $webiste_d = get_field('webiste_d', $sin_p);
                        $opening_hours = get_field('opening_hours', $sin_p);
                        $opening_hours = isset($opening_hours) ? $opening_hours : "";
                        $query_[] = array($address1, $lat, $lng, $key, $c_nm, $telephone_d, $email_d, $webiste_d, $opening_hours);
                        ?>
                        <li class="dl_ulli" data-lat="<?php echo $lat; ?>" data-lang="<?php echo $lng; ?>">
                            <span class="uppercase ttl1"><?php echo $c_nm; ?></span><p><?php echo $address['address']; ?></p><p>T: <?php echo $telephone_d; ?></p><p>E:<a href="mailto:<?php echo $em_ad; ?>" target="_blank" ><?php echo $em_ad; ?></a> </p> <p>W:<a href="http://<?php echo $webiste_d; ?>" target="_blank" > <?php echo $webiste_d; ?></a></p><p>Opening Hours: <?php echo $opening_hours; ?></p>
                        </li>
                        <?php
                    }
                }
            }
        } else if ($prod_filt == '' && $searchTextField == '') {

            $query = $wpdb->get_results("SELECT * FROM wp_posts WHERE wp_posts.post_type = 'dealer' AND wp_posts.post_status = 'publish'", 'ARRAY_A');
            $query_ = array();
            foreach ($query as $query3) {
                $p_id = $query3['ID'];
                $ids_a = array($p_id);
                $ids_a = implode(',', $ids_a);

                $args = array(
                    'orderby' => 'post_date',
                    'category' => '',
                    'order' => 'DESC',
                    'post_type' => 'dealer',
                    'post_status' => 'publish',
                    'include' => $ids_a
                );
                $post_ids = get_posts($args);
                foreach ($post_ids as $_post1) {
//                            $i =0;
                    if (has_post_thumbnail($_post1->ID)) {
                        $url = wp_get_attachment_image_src(get_post_thumbnail_id($_post1->ID), 'full');
                    }
                    $sin_p = $_post1->ID;
                    $address = get_field('address_d', $sin_p);
                    $address1 = $address['address'];
                    $lat = $address['lat'];
                    $lng = $address['lng'];
                    $c_nm = get_field('company_name', $sin_p);
                    $telephone_d = get_field('telephone_d', $sin_p);
                    $email_d = get_field('email_d', $sin_p);
                    $webiste_d = get_field('webiste_d', $sin_p);
                    $opening_hours = get_field('opening_hours', $sin_p);
                     $opening_hours = isset($opening_hours) ? $opening_hours : "";
                    $query_[] = array($address1, $lat, $lng, $key, $c_nm, $telephone_d, $email_d, $webiste_d, $opening_hours);
                    ?>
                    <li class="dl_ulli" data-lat="<?php echo $lat; ?>" data-lang="<?php echo $lng; ?>">
                        <span class="uppercase ttl1"><?php echo $c_nm; ?></span><p><?php echo $address['address']; ?></p><p>T: <?php echo $telephone_d; ?></p><p>E:<a href="mailto:<?php echo $em_ad; ?>" target="_blank" ><?php echo $em_ad; ?></a> </p> <p>W:<a href="http://<?php echo $webiste_d; ?>" target="_blank" > <?php echo $webiste_d; ?></a></p><p>Opening Hours: <?php echo $opening_hours; ?></p>
                    </li>
                    <?php
                }
            }
        }
        echo '(%=200=%)';
        echo json_encode($query_);
        exit();
    }

    //send mail from contact page
    function send_mail_from_contact_page() {
        $this->action_piority($_POST['pgnonce']);

        $f_name = isset($_POST['f_name']) ? $_POST['f_name'] : "";
        $l_name = isset($_POST['l_name']) ? $_POST['l_name'] : "";
        $email1 = isset($_POST['email1']) ? $_POST['email1'] : "";
        $phone = isset($_POST['phone']) ? $_POST['phone'] : "";
        $p_code = isset($_POST['p_code']) ? $_POST['p_code'] : "";
        $chasy_no = isset($_POST['chasy_no']) ? $_POST['chasy_no'] : "";
        $dealer = isset($_POST['dealer']) ? $_POST['dealer'] : "";
        $hereus1 = isset($_POST['hereus1']) ? $_POST['hereus1'] : "";
        $hereus1_1 = str_replace("_", " ", $hereus1);
        $hereus2 = isset($_POST['hereus2']) ? $_POST['hereus2'] : "";

        $_email_data = array(
            'name' => $f_name . ' ' . $l_name,
            'to' => WPDREAMSEEKER_ADMIN_EMAIL,
            'from' => $email1,
            'subject' => 'Enquiry Details'
        );
        $email_html = trailingslashit(TEMPLATEPATH) . "/email_template_.html"; //email template
        if (!file_exists($email_html)) {
            echo "Email Template cannot find";
            return FALSE;
        }
        $template = file_get_contents($email_html); //get data   

        $template = str_replace('[f_name]', $f_name, $template);
        $template = str_replace('[l_name]', $l_name, $template);
        $template = str_replace('[email1]', $email1, $template);
        $template = str_replace('[phone]', $phone, $template);
        $template = str_replace('[p_code]', $p_code, $template);
        $template = str_replace('[chasy_no]', $chasy_no, $template);
        $template = str_replace('[dealer]', $dealer, $template);
        $template = str_replace('[hereus1]', $hereus1_1, $template);
        $template = str_replace('[hereus2]', $hereus2, $template);
        $template = str_replace('[url]', get_template_directory_uri(), $template);

        $headers = "From: " . $email1 . "\r\n";
        $headers .= "Reply-To: " . $email1 . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        echo $template;
        if (@mail($_email_data['to'], $_email_data['subject'], $template, $headers)) {
            echo"true";
        } else {
            echo"false";
        }
        exit();
    }

    //send mail from contact page
    function send_mail_from_ns() {
        $this->action_piority($_POST['pgnonce']);

        $f_name = isset($_POST['f_name']) ? $_POST['f_name'] : "";
        $email1 = isset($_POST['email1']) ? $_POST['email1'] : "";
        $emails_ns = 'sadeepa123@gmail.com'.','. $email1;
//        $emails_ns = WPDREAMSEEKER_ADMIN_EMAIL .','. $email1;
//var_dump($emails_ns);
        $_email_data = array(
            'name' => $f_name,
            'to' => $emails_ns,
//            'to' => WPDREAMSEEKER_ADMIN_EMAIL,
            'from' => $email1,
            'subject' => 'Newsletter Subscribed'
        );
        $email_html = trailingslashit(TEMPLATEPATH) . "/email_template_2.html"; //email template
        if (!file_exists($email_html)) {
            echo "Email Template cannot find";
            return FALSE;
        }
        $template = file_get_contents($email_html); //get data   

        $template = str_replace('[f_name]', $f_name, $template);
        $template = str_replace('[email1]', $email1, $template);
        $template = str_replace('[url]', get_template_directory_uri(), $template);

        $headers = "From: " . $email1 . "\r\n";
        $headers .= "Reply-To: " . $email1 . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        echo $template;
        if (@mail($_email_data['to'], $_email_data['subject'], $template, $headers)) {
            echo"true";
        } else {
            echo"false";
        }
        exit();
    }

    //send mail from make a claim
    function send_make_a_disclaimer() {

        $this->action_piority($_POST['pgnonce']);

        $claim_f_name = isset($_POST['claim_f_name']) ? $_POST['claim_f_name'] : "";
        $claim_l_name = isset($_POST['claim_l_name']) ? $_POST['claim_l_name'] : "";
        $claim_email = isset($_POST['claim_email']) ? $_POST['claim_email'] : "";
        $claim_phone = isset($_POST['claim_phone']) ? $_POST['claim_phone'] : "";
        $claim_postal_code = isset($_POST['claim_postal_code']) ? $_POST['claim_postal_code'] : "";
        $claim_sate = isset($_POST['claim_sate']) ? $_POST['claim_sate'] : "";
        $datepicker = isset($_POST['datepicker']) ? $_POST['datepicker'] : "";
        $claim_product = isset($_POST['claim_product']) ? $_POST['claim_product'] : "";
        $claim_model = isset($_POST['claim_model']) ? $_POST['claim_model'] : "";
        $claim_chassis_number = isset($_POST['claim_chassis_number']) ? $_POST['claim_chassis_number'] : "";
        $claim_vin_number = isset($_POST['claim_vin_number']) ? $_POST['claim_vin_number'] : "";
        $claim_comments = isset($_POST['claim_comments']) ? $_POST['claim_comments'] : "";
        $claim_dealer = isset($_POST['claim_dealer']) ? $_POST['claim_dealer'] : "";
        $uploaded_path= isset($_POST['uploaded_path']) ? $_POST['uploaded_path'] : "";
        
        $uploaded_path1 = explode(',', $uploaded_path);
        $uploaded_path2 = '';
        foreach($uploaded_path1 as $uploaded_path11){
        $links = urldecode(stripslashes($uploaded_path11));        
          $uploaded_path2.=  '<a href="'.$links.'"><span>'.($links).'</span></a><br>';
        }
        
        $_email_data = array(
            'name' => $claim_f_name . ' ' . $claim_l_name,
            'to' => WPDREAMSEEKER_ADMIN_EMAIL,
            'from' => $claim_email,
            'subject' => 'Claim Details'
        );
        $email_html = trailingslashit(TEMPLATEPATH) . "/email_template_claim.html"; //email template
        if (!file_exists($email_html)) {
            echo "Email Template cannot find";
            return FALSE;
        }
        $template = file_get_contents($email_html); //get data   

        $template = str_replace('[claim_f_name]', $claim_f_name, $template);
        $template = str_replace('[claim_l_name]', $claim_l_name, $template);
        $template = str_replace('[claim_email]', $claim_email, $template);
        $template = str_replace('[claim_phone]', $claim_phone, $template);
        $template = str_replace('[claim_postal_code]', $claim_postal_code, $template);
        $template = str_replace('[claim_sate]', $claim_sate, $template);
        $template = str_replace('[datepicker]', $datepicker, $template);
        $template = str_replace('[claim_product]', $claim_product, $template);
        $template = str_replace('[claim_model]', $claim_model, $template);
        $template = str_replace('[claim_chassis_number]', $claim_chassis_number, $template);
        $template = str_replace('[claim_vin_number]', $claim_vin_number, $template);
        $template = str_replace('[claim_comments]', $claim_comments, $template);
        $template = str_replace('[claim_dealer]', $claim_dealer, $template);
        $template = str_replace('[uploaded_path]', $uploaded_path2, $template);
        $template = str_replace('[url]', get_template_directory_uri(), $template);

        $headers = "From: " . $claim_email . "\r\n";
        $headers .= "Reply-To: " . $claim_email . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        echo $template;
        if (@mail($_email_data['to'], $_email_data['subject'], $template, $headers)) {
            echo"true";
        } else {
            echo"false";
        }
        exit();
    }

}
?>
    