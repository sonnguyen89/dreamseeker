<?php
include CEDO_OPTIONS_PATH_FULL . '/pages/options.php';
include CEDO_OPTIONS_PATH_FULL . '/pages/printer.php';

global $wpdb;

//save on button press
if (isset($_POST['save_options'])) {
    $options = array();
    foreach ($_POST as $key => $val) {
        if (substr($key, 0, 5) !== "cedo_") {
            continue;
        }
        cedo_set_option($key, (isset($_POST[$key]) && $_POST[$key] !== "") ? $_POST[$key] : "");
    }
}
?>

<div class="plugin-settings-block wrap iflext_admin_subscriber wchk" id="iflext_news_subs_sms_send" style="margin-top:0;">
    <form method="POST" action="">

        <div style="float:left;width: 880px;margin-top:0;" class="wrap iopt_settings" id="poststuff">
            <div style="border: 1px solid #D5D2D2;" id="app_settings" class="postbox">
                <h3 style="margin:0px 0px 20px 0px; " class="hndle"><span style="font: 13px arial,times new roman,sans-serif,serif;">Page Setting</span></h3>
                <table style="padding:0px 5px;">
                    <tbody>
                        <?php
                        if (isset($settings) && !empty($settings)) {
                            foreach ($settings as $key => $value) {

                                if (!isset($value['suboption'])) {
                                    ?>

                                    <tr>
                                        <td style="float:left;margin-top: 5px;margin-left:15px;font: 13px arial,sanfserif,serif,Times New Roman;color: #636363;"><span style="float: left; width: 201px;"><?php echo $value['labelname']; ?>:</span></td>
                                        <td><?php
                                            $key = $value['name'];
                                            (cedo_get_option($key) == '' ? $value['dvalue'] : $value['dvalue'] = cedo_get_option($key));

                                            echo drawInputfeild($value['type'], $value['id'], $value['name'], $value['dvalue'], $value);
                                            ?>
                                        </td>
                                        <td style="float:left;margin-right:15px;color:#919090;"><?php echo $value['labeldesc'] ?></td>
                                    </tr>

        <?php } else { ?>
                                    <tr> 
                                        <td style="float:left;margin-top: 5px;margin-left:15px;font: 13px arial,sanfserif,serif,Times New Roman;color: #636363;"><span><?php echo $value['labelname']; ?>:</span></td>
                                        <td>
                                        </td>
                                        <td style="float:left;margin-right:15px;color:#919090;"><?php echo $value['labeldesc'] ?></td>
                                    </tr>
            <?php foreach ($value['suboption'] as $__value) { ?>
                                        <tr>
                                            <td style="float:left;margin-right:15px;">&nbsp;</td>
                                            <td style="float:left;margin-top: 5px;margin-left:15px;font: 13px arial,sanfserif,serif,Times New Roman;color: #636363;"><span><?php echo $__value['suboption']; ?>:</span></td>
                                            <td><?php
                                                $key = $__value['name'];
                                                (cedo_get_option($key) == '' ? $__value['dvalue'] : $__value['dvalue'] = cedo_get_option($key));
                                                echo drawInputfeild($__value['type'], $__value['id'], $__value['name'], $__value['dvalue']);
                                                ?>
                                            </td>
                                            <td style="float:left;margin-right:15px;color:#919090;"><?php echo $__value['labeldesc'] ?></td>
                                        </tr><?php
                                    }
                                }
                            }
                        }
                        ?> 
                        <tr>
                            <td style="float:left;margin-left:15px;"></td>
                            <td>
                                <input type="submit" class="button" name="save_options" value="Save" style="width:70px;float:right;margin:10px 0px 5px 0;border-radius: 3px 3px 3px 3px;"><span style="font: 12px arial,times new roman,sans-serif,serif;float: right; margin: 13px;"></span>
                                <div class="loading_icon" style="display: none; margin: 14px 15px;"></div>
                            </td>
                            <td style="float:right;margin-right:15px;">
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
            <div style="border: 1px solid #D5D2D2;" id="app_settings" class="postbox">
                <h3 style="margin:0px 0px 20px 0px; " class="hndle"><span style="font: 13px arial,times new roman,sans-serif,serif;">Social Media Setting</span></h3>
                <table style="padding:0px 5px;">
                    <tbody>
                        <?php
                        if (isset($smo) && !empty($smo)) {
                            foreach ($smo as $key => $value) {

                                if (!isset($value['suboption'])) {
                                    ?>

                                    <tr>
                                        <td style="float:left;margin-top: 5px;margin-left:15px;font: 13px arial,sanfserif,serif,Times New Roman;color: #636363;"><span style="float: left; width: 201px;"><?php echo $value['labelname']; ?>:</span></td>
                                        <td><?php
                                            $key = $value['name'];
                                            (cedo_get_option($key) == '' ? $value['dvalue'] : $value['dvalue'] = cedo_get_option($key));

                                            echo drawInputfeild($value['type'], $value['id'], $value['name'], $value['dvalue'], $value);
                                            ?>
                                        </td>
                                        <td style="float:left;margin-right:15px;color:#919090;"><?php echo $value['labeldesc'] ?></td>
                                    </tr>

        <?php } else { ?>
                                    <tr> 
                                        <td style="float:left;margin-top: 5px;margin-left:15px;font: 13px arial,sanfserif,serif,Times New Roman;color: #636363;"><span><?php echo $value['labelname']; ?>:</span></td>
                                        <td>
                                        </td>
                                        <td style="float:left;margin-right:15px;color:#919090;"><?php echo $value['labeldesc'] ?></td>
                                    </tr>
            <?php foreach ($value['suboption'] as $__value) { ?>
                                        <tr>
                                            <td style="float:left;margin-right:15px;">&nbsp;</td>
                                            <td style="float:left;margin-top: 5px;margin-left:15px;font: 13px arial,sanfserif,serif,Times New Roman;color: #636363;"><span><?php echo $__value['suboption']; ?>:</span></td>
                                            <td><?php
                                                $key = $__value['name'];
                                                (cedo_get_option($key) == '' ? $__value['dvalue'] : $__value['dvalue'] = cedo_get_option($key));
                                                echo drawInputfeild($__value['type'], $__value['id'], $__value['name'], $__value['dvalue']);
                                                ?>
                                            </td>
                                            <td style="float:left;margin-right:15px;color:#919090;"><?php echo $__value['labeldesc'] ?></td>
                                        </tr><?php
                                    }
                                }
                            }
                        }
                        ?> 
                        <tr>
                            <td style="float:left;margin-left:15px;"></td>
                            <td>
                                <input type="submit" class="button" name="save_options" value="Save" style="width:70px;float:right;margin:10px 0px 5px 0;border-radius: 3px 3px 3px 3px;"><span style="font: 12px arial,times new roman,sans-serif,serif;float: right; margin: 13px;"></span>
                                <div class="loading_icon" style="display: none; margin: 14px 15px;"></div>
                            </td>
                            <td style="float:right;margin-right:15px;">
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
            <div style="border: 1px solid #D5D2D2;" id="app_settings" class="postbox">
                <h3 style="margin:0px 0px 20px 0px; " class="hndle"><span style="font: 13px arial,times new roman,sans-serif,serif;">Range Setting</span></h3>
                <table style="padding:0px 5px;">
                    <tbody>
                        <?php
                        if (isset($range) && !empty($range)) {
                            foreach ($range as $key => $value) {

                                if (!isset($value['suboption'])) {
                                    ?>

                                    <tr>
                                        <td style="float:left;margin-top: 5px;margin-left:15px;font: 13px arial,sanfserif,serif,Times New Roman;color: #636363;"><span style="float: left; width: 201px;"><?php echo $value['labelname']; ?>:</span></td>
                                        <td><?php
                                            $key = $value['name'];
                                            (cedo_get_option($key) == '' ? $value['dvalue'] : $value['dvalue'] = cedo_get_option($key));

                                            echo drawInputfeild($value['type'], $value['id'], $value['name'], $value['dvalue'], $value);
                                            ?>
                                        </td>
                                        <td style="float:left;margin-right:15px;color:#919090;"><?php echo $value['labeldesc'] ?></td>
                                    </tr>

        <?php } else { ?>
                                    <tr> 
                                        <td style="float:left;margin-top: 5px;margin-left:15px;font: 13px arial,sanfserif,serif,Times New Roman;color: #636363;"><span><?php echo $value['labelname']; ?>:</span></td>
                                        <td>
                                        </td>
                                        <td style="float:left;margin-right:15px;color:#919090;"><?php echo $value['labeldesc'] ?></td>
                                    </tr>
            <?php foreach ($value['suboption'] as $__value) { ?>
                                        <tr>
                                            <td style="float:left;margin-right:15px;">&nbsp;</td>
                                            <td style="float:left;margin-top: 5px;margin-left:15px;font: 13px arial,sanfserif,serif,Times New Roman;color: #636363;"><span><?php echo $__value['suboption']; ?>:</span></td>
                                            <td><?php
                                                $key = $__value['name'];
                                                (cedo_get_option($key) == '' ? $__value['dvalue'] : $__value['dvalue'] = cedo_get_option($key));
                                                echo drawInputfeild($__value['type'], $__value['id'], $__value['name'], $__value['dvalue']);
                                                ?>
                                            </td>
                                            <td style="float:left;margin-right:15px;color:#919090;"><?php echo $__value['labeldesc'] ?></td>
                                        </tr><?php
                                    }
                                }
                            }
                        }
                        ?> 
                        <tr>
                            <td style="float:left;margin-left:15px;"></td>
                            <td>
                                <input type="submit" class="button" name="save_options" value="Save" style="width:70px;float:right;margin:10px 0px 5px 0;border-radius: 3px 3px 3px 3px;"><span style="font: 12px arial,times new roman,sans-serif,serif;float: right; margin: 13px;"></span>
                                <div class="loading_icon" style="display: none; margin: 14px 15px;"></div>
                            </td>
                            <td style="float:right;margin-right:15px;">
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
            
        </div>

    </form>
</div>

<script type="text/javascript">
    var img_uploadPath = '<?php echo trailingslashit(get_bloginfo('wpurl')) . 'wp-admin/' ?>';
    var slider_img_url_ui = null;
    var slider_input_url_ui = null;

    jQuery(document).ready(function() {
        jQuery('.upload_image_button').live('click', function() {
            slider_input_url_ui = jQuery(this).parent().find('.upload_image.bimage');
            jQuery(this).removeClass('error');
            jQuery(this).attr('title', '');
            tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
            return false;
        });

        window.send_to_editor = function(html) {
            imgurl = jQuery('img', html).attr('src');
            if (typeof imgurl === 'undefined') {
                imgurl = jQuery(html).attr('href');
            }
            slider_input_url_ui.val(imgurl);
            tb_remove();
        };
    });
</script>