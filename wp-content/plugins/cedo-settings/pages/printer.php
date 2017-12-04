<?php
function drawInputfeild($type, $id, $name, $dval, $value = array()) {
    switch ($type) {
        case 'Text': ?>
            <input type="<?php echo $type; ?>" style="font: 12px arial; margin-bottom: 5px; width: 400px; margin-left: 4px;" class="iflext_sms_subs_senders_name" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $dval; ?>">
            <?php if(isset($value['edit']) && $value['edit'] === '1') { ?><span><a href="<?php echo get_edit_post_link( $dval ); ?>" target="_blank">Edit</a></span><?php } ?>
        <?php
            break;
        case 'Textarea': ?>
            <textarea name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="get_character_count" style="width: 400px;float: left;" ><?php echo $dval; ?></textarea>
            <?php 
            break;
        case 'Radio': ?>
            <?php 
            break;
        case 'Date': ?>
            <div style="float: left; width:170px;"><input style="float:left;width:81px ! important;" type="text" class="datepicker required start_date" name="supportstartdate" value="<?php echo (isset($row['sdate'])) ? $row['sdate'] : ""; ?>" id=""><div class="vaid_datepicker"></div></div>
            <?php
            break;
        case 'Select': ?>
            <?php 
            break;
        case 'Checkbox': ?>
            <?php 
            break;
        case 'Upload': ?>
            <table class="image_attr" style="float:left;">
                <tr><td><input class="upload_image bimage" type="text" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $dval; ?>" style="float:left;width:396px"/>
                        <input class="upload_image_button" type="button" value="Upload Image" style="float:left;width:100px;"/><div class="help_box" title="*important:Default selected image size Thumbnail (150 Ãƒâ€?? 150)&#10;&#10;-Set appropiate image size you want to apply.&#10;&#10;-If you want to get image  default size, &#10;please put tick on FULL SIZE in pop-up image uploader."></div>
                    </td>
                </tr>
            </table>
        <?php
            break;
    }
}