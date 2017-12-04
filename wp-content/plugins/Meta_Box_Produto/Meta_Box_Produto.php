<?php
/*
  Plugin Name:Meta_Box_Produto
  Plugin URI: http://www.jcdv.com.br
  Description: Insert Meta Box in your places
  Version: 1.0
  Author: Rafael Mendes
  Author URI: http://jcdv.com.br
 */
add_action('add_meta_boxes', 'produto_meta_box_add');

function produto_meta_box_add() {
//    for post type meta box
//    add_meta_box('my-meta-box-id', 'Slider Description', 'main_slider_meta_box', 'slider', 'normal', 'high');
     
    // check for home page.
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    $template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
  if ($template_file == 'index.php') {
   add_meta_box('my-meta-box-id', 'Home Page Details', 'news_section_meta_box', 'page', 'normal', 'high');
  }
    
}

//FORMULARIO PARA SALVAS OS DADOS

/*******************************************************************meta box for the main slider***********************************************************************************/
function old_news_section_meta_box($post_id) {
    global $post, $user;
    $new_id = $post->ID;
    $values = get_post_custom($post->ID);
    
    $featured_product_title = isset($values['featured_product_title']) ? esc_attr($values['featured_product_title'][0]) : '';
    $news_title = isset($values['news_title']) ? esc_attr($values['news_title'][0]) : '';
    $find_dealer_btn = isset($values['find_dealer_btn']) ? esc_attr($values['find_dealer_btn'][0]) : '';
    $find_dealer_btn_link = isset($values['find_dealer_btn_link']) ? esc_attr($values['find_dealer_btn_link'][0]) : '';
    $contact_us_btn = isset($values['contact_us_btn']) ? esc_attr($values['contact_us_btn'][0]) : '';
    $contact_us_btn_link = isset($values['contact_us_btn_link']) ? esc_attr($values['contact_us_btn_link'][0]) : '';
 

    wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
    ?>
    <style type="text/css">
        .inpt_title{
            float: left; width: 112px;
        }
        .span_tag_ttldes{
            color: #858585;
            font-style: italic;
            margin-left: 7px;
            font-weight: normal;
            font-size: 13px;
        }
        .input_tags input[type=text]{
            width: 81%;
        }
        .trck_lng input[type=text]{
            margin-left: 25px;
            margin-right: 8px;
            width: 45px;
        }
        .trck_lng{
            border-bottom: 1px solid #e3e3e3;
            margin-bottom: 12px;
            padding-bottom: 12px;
        }
        .mpupload{
            border-bottom: 1px solid #e3e3e3;
            margin-bottom: 12px;
            padding-bottom: 12px;
        }
        .column_title{
            float: left;
            width: 162px;  
        }
        .text_bb{
            min-height: 140px;
        }
    </style>  

   <?php // if(($new_id == 267)){ ?>
<!--    <p class="">
        <label for="maternity_image">Post Image</label>
        <input type="text" name="maternity_image" id="maternity_image" style="width:100%;" value="<?php // echo $maternity_image; ?>" />
        <input id="upload_mart_image_question" type="button" name="maternity_image" alt="Galeria" value="Upload" />
        <input class="mart_gallery" type="hidden" value="<?php echo $post->ID; ?>">
    </p>-->
    <p class="">
        <label for="featured_product_title">Featured Product Title</label>
        <input type="text" name="featured_product_title" id="featured_product_title" style="width:100%;" value="<?php echo $featured_product_title; ?>" />  
    </p>
    <p class="">
        <label for="news_title">News Section Title</label>
        <input type="text" name="news_title" id="news_title" style="width:100%;" value="<?php echo $news_title; ?>" />  
    </p>
    <p class="">
        <label for="find_dealer_btn">Find a Dealer Button Title</label>
        <input type="text" name="find_dealer_btn" id="find_dealer_btn" style="width:100%;" value="<?php echo $find_dealer_btn; ?>" />  
    </p>
    <p class="">
        <label for="find_dealer_btn_link">Find a Dealer Button Link</label>
        <input type="text" name="find_dealer_btn_link" id="find_dealer_btn_link" style="width:100%;" value="<?php echo $find_dealer_btn_link; ?>" />  
    </p>
    <p class="">
        <label for="contact_us_btn">Contact Us Button Title</label>
        <input type="text" name="contact_us_btn" id="contact_us_btn" style="width:100%;" value="<?php echo $contact_us_btn; ?>" />  
    </p>
    <p class="">
        <label for="contact_us_btn_link">Contact Us Button Link</label>
        <input type="text" name="contact_us_btn_link" id="contact_us_btn_link" style="width:100%;" value="<?php echo $contact_us_btn_link; ?>" />  
    </p>
<!--    <p class="">
        <label for="health_homelink_desc">Home Page Health Description</label>
            <textarea name="health_homelink_desc" style="width:100%;" id="health_homelink_desc" style="width:100%;"><?php // echo $health_homelink_desc; ?></textarea> 
    </p>-->
    
  <?php // } ?>
 

    <script type="text/javascript">
        jQuery(document).ready(function() {

            var name = '';
            
            jQuery('#upload_chronic_image_question').click(function() {

                post_id = jQuery('.chronic_gallery').val();
                name = jQuery(this).attr('name');
                media = jQuery(this).attr('alt');

                tb_show('', 'media-upload.php?post_id=' + post_id + '&amp;type=image&amp;TB_iframe=true');

                return false;
            });

            window.send_to_editor = function(html)
            {
                var nome = '#' + name;
                var valor_field = jQuery(nome).val();
                var attachment_id = 0;
                var classes = jQuery('img', html).attr('class').match(/wp\-image\-([0-9]+)/);
                if (media == 'Destaque')
                {
                    var atts = jQuery('img', html).attr('src');
                    jQuery('span' + nome + ' img#theImg').attr("src", atts);
                    jQuery('input[type=text]' + nome).val(atts);
                }
                else
                {
                    if (classes[1])
                        attachment_id = classes[1];

                    if (valor_field != '')
                    {
                        atts = valor_field + ',' + attachment_id;
                    }
                    else
                    {
                        atts = attachment_id;
                    }

                    jQuery('input[type=text]' + nome).val(atts);
                }
                tb_remove();
            }
        });
    </script>
    <?php
} 


/*************************************************************************************************************************************************************************/
//to save metabox for the main slider
add_action('save_post', 'home_news_box_save');
//
//function home_news_box_save($post_id) {
//    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
//
//    if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce')) return;
//
//    if (!current_user_can('edit_post', $post_id)) return "";
//    
//    if (isset($_POST['featured_product_title'])) update_post_meta($post_id, 'featured_product_title', $_POST['featured_product_title']);
//    if (isset($_POST['news_title'])) update_post_meta($post_id, 'news_title', $_POST['news_title']);
//    if (isset($_POST['find_dealer_btn'])) update_post_meta($post_id, 'find_dealer_btn', $_POST['find_dealer_btn']);
//    if (isset($_POST['find_dealer_btn_link'])) update_post_meta($post_id, 'find_dealer_btn_link', $_POST['find_dealer_btn_link']);
//    if (isset($_POST['contact_us_btn'])) update_post_meta($post_id, 'contact_us_btn', $_POST['contact_us_btn']);
//    if (isset($_POST['contact_us_btn_link'])) update_post_meta($post_id, 'contact_us_btn_link', $_POST['contact_us_btn_link']);
//}


/*********************************************************************************************************************************************************************/


function chama_galeria() {
    $id = get_the_ID();

    if (get_post_meta($id, 'galeria', true)) :
        $img = get_post_meta($id, 'galeria', true);

        $imagens = explode(',', $img);
        $total = count($imagens);
        $texto = '';

        for ($i = 0; $i < $total; $i++) {
            $args = array(
                'include' => $imagens[$i],
                'post_type' => 'attachment',
                'post_status' => null,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            );

            $attachments = get_posts($args);
            $bloginfo = get_bloginfo('template_url');

            if ($attachments) {
                foreach ($attachments as $attachment) {
                    $src_img = wp_get_attachment_image_src($attachment->ID, 'large');

                    echo '	<a href="javascript:void(0);">
							<img src="' . $bloginfo . '/timthumb.php?src=' . $src_img[0] . '&amp;h=372&amp;w=584&amp;zc=1" title="' . $attachment->post_title . '" alt="' . $attachment->post_title . '" /><span>' . $attachment->post_title . '</span>
						</a>';
                }
            }
        }
    endif;
}

function chama_galeria_url($page_id) {
    $id = $page_id;

    if (get_post_meta($id, 'galeria', true)) :
        $img = get_post_meta($id, 'galeria', true);

        $imagens = explode(',', $img);
        $total = count($imagens);
        $texto = '';
        $_slider_array = array();
        for ($i = 0; $i < $total; $i++) {
            $args = array(
                'include' => $imagens[$i],
                'post_type' => 'attachment',
                'post_status' => null,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            );

            $attachments = get_posts($args);
            $bloginfo = get_bloginfo('template_url');

            if ($attachments) {
                foreach ($attachments as $attachment) {
                    $src_img = wp_get_attachment_image_src($attachment->ID, 'large');
                    $_slider_array[$i] = $src_img;
                }
            }
        }
        return $_slider_array;
    endif;
}

function chama_plantas() {
    $id = get_the_ID();
//	$id = $c;

    if (get_post_meta($id, 'plantas', true)) :
        $img = get_post_meta($id, 'plantas', true);

        $imagens = explode(',', $img);
        $total = count($imagens);
        $texto = '';

        for ($i = 0; $i < $total; $i++) {
            $args = array(
                'include' => $imagens[$i],
                'post_type' => 'attachment',
                'post_status' => null,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            );

            $attachments = get_posts($args);
            $bloginfo = get_bloginfo('template_url');

            if ($attachments) {
                foreach ($attachments as $attachment) {
                    $src_img = wp_get_attachment_image_src($attachment->ID, 'large');
                    echo '	<a href="javascript:void(0);">
							<img src="' . $bloginfo . '/timthumb.php?src=' . $src_img[0] . '&amp;h=372&amp;w=584&amp;zc=1" title="' . $attachment->post_title . '" alt="' . $attachment->post_title . '" /><span>' . $attachment->post_title . '</span>
						</a>';
                }
            }
        }
    endif;
}

//create img sources
function chama_plantas_url($page_id) {
    $id = $page_id;

    if (get_post_meta($id, 'plantas', true)) :
        $img = get_post_meta($id, 'plantas', true);

        $imagens = explode(',', $img);
        $total = count($imagens);
        $texto = '';
        $_return_array = array();
        for ($i = 0; $i < $total; $i++) {
            $args = array(
                'include' => $imagens[$i],
                'post_type' => 'attachment',
                'post_status' => null,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            );

            $attachments = get_posts($args);
//		  $bloginfo = get_bloginfo('template_url');

            if ($attachments) {
                foreach ($attachments as $attachment) {
                    $src_img = wp_get_attachment_image_src($attachment->ID, 'large');
                    $_return_array[$i] = $src_img;
                }
            }
        }
        return $_return_array;
    endif;
}

function chama_perspectiva() {
    $id = get_the_ID();

    if (get_post_meta($id, 'Perspectiva', true)) :
        $img = get_post_meta($id, 'Perspectiva', true);

        $imagens = explode(',', $img);
        $total = count($imagens);
        $texto = '';
        $bloginfo = get_bloginfo('template_url');

        for ($i = 0; $i < $total; $i++) {
            $args = array(
                'include' => $imagens[$i],
                'post_type' => 'attachment',
                'post_status' => null,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            );

            $attachments = get_posts($args);

            if ($attachments) {
                foreach ($attachments as $attachment) {
                    $src_img = wp_get_attachment_image_src($attachment->ID, 'large');

                    echo '<li><a href="' . $src_img[0] . '" style="background-image:url(' . $bloginfo . '/timthumb.php?src=' . $src_img[0] . '&amp;h=100&amp;w=126&amp;zc=1)">' . apply_filters('the_title', $attachment->post_title) . '</a></li>';
                }
            }
        }
    endif;
}