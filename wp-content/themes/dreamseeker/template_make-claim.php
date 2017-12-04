  <?php
/*
  Template Name: Make clam
 */
get_header();
global $post;
?> 
<script type="text/javascript">
//   jQuery( "#datepicker" ).datepicker({
//	inline: true
//});
$(document).ready(function(){
      $('#datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
}); 
//$('.datepicker').datepicker()

// $('.multi').MultiFile({
//    accept:'gif|jpg|png', 
//    max:5, 
//    STRING: { 
//      remove:'Remover', 
//      selected:'Selecionado: $file', 
//      denied:'Invalido arquivo de tipo $ext!', 
//      duplicate:'Arquivo ja selecionado:\n$file!'
//    }
//  });
  
  var btnUpload=$('#upload');
		var status=$('#status');
                  var link = '<?php echo get_template_directory_uri() ?>'+ '/upload-file.php';
//                  console.log(link);
		new AjaxUpload(btnUpload, {                  
			action: link,
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
					status.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
                             response=response.split('//==//');
                            console.log(response[0]);
                            console.log(response[1]);
				status.text('');
				if(response[0]==="success"){
					$('<li></li>').appendTo('#files').html('<img src="<?php echo get_template_directory_uri() ?>/claime_uploads/'+response[1]+'" alt="" /><span class="remove_up">X</span>').addClass('success');
				  
var optionTexts = [];
$(".upload_imgs li img").each(function() { optionTexts.push($(this).attr('src')) });
var quotedimages = '"' + optionTexts.join('", "') + '"';
jQuery('.uploaded_path').val(quotedimages);
jQuery('.remove_up').live('click', function(){
    var rm_link = '"'+jQuery(this).parent().find('img').attr('src')+'"';  
   var ff_pth = jQuery('.uploaded_path').val();
   var k = ff_pth.replace(rm_link, '');
   jQuery('.uploaded_path').val('');
   jQuery('.uploaded_path').val(k);
  var thd_im  = jQuery(this);
   setTimeout(function(){ 
      console.log(thd_im.parent());
    thd_im.parent().remove();   
    }, 600);
  
});
} else{
$('<li></li>').appendTo('#files').text(file).addClass('error');
				}
			}
                        
		});
		

}); 

</script>

  <!-- make a claim Hero Image
    ================================================== -->
    <div class="range-heroimg" style="background-image:url('<?php echo get_template_directory_uri() ?>/img/range-heroimg.jpg');">
        <div class="container ">
            <div class="row">
                <h1>make a claim</h1>
            </div>
        </div> 
    </div>
    
    <div class="make-claim">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 contact-left">
                    <div class="col-md-12">
                        <h2>Make a claim</h2>
                    </div>
                   <form action="" method="post" enctype="multipart/form-data" class="clm_frm">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control claim_f_name input_val" id="claim_f_name" placeholder="First Name">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control claim_l_name input_val" id="claim_l_name" placeholder="Last Name">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control claim_email input_val" id="claim_email" placeholder="Email">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control claim_phone input_val" id="claim_phone" placeholder="Phone">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control claim_postal_code input_val" id="claim_postal_code" placeholder="Postcode">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control claim_sate input_val" id="claim_sate" placeholder="State">
                        </div>
                        
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control datepicker input_val" id="datepicker" placeholder="Date of Purchase" />
                            <!--<input type="text" class="form-control datepicker input_val" id="datepicker" placeholder="  Date of Purchase" data-provide="datepicker">-->
                        </div>
<!--                        <div class="form-group col-md-6">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Date of Purchase">
                        </div>-->
                        <?php 
                        $args = array(
                        'posts_per_page' => -1,
                        'offset' => 0,
                        'orderby' => 'post_date',
                        'category' => '',
                        'post_type' => 'products',
                        'post_status' => 'publish',       
                        'order' => 'DESC'
                            ); 
                        $loop1 = get_posts($args);
                        ?>
 <div class="form-group col-md-6">
                            <select name="test1" class="form-control claim_product input_val select_val" id="claim_product">
                                   <option value="">Model Name</option>
                                <?php  foreach($loop1 as $loop3){
                                $product_title = $loop3->post_title;
                                $product_title2 = str_replace(' ', '_', $product_title);
                                ?>
                                <option value="<?php echo $product_title2; ?>"><?php echo $product_title; ?></option>
                                <?php } ?>
                            </select>
                        </div>
 <div class="form-group col-md-6">
                           <select name="test2" class="form-control claim_model input_val select_val" id="claim_model">
                                   <option value="">Model Type</option>
                                       <?php  $taxonomy = 'products_category';
                                     $terms = get_terms($taxonomy);
                                     foreach ( $terms as $term ) {
                                     $model_name = $term->name;
                                     $model_name2 = str_replace(' ', '_', $model_name);
                                    ?>
                                
                                <option value="<?php echo $model_name2; ?>"><?php echo $model_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
<!--                        <div class="form-group col-md-6">
                              <div class="dealer_select_wraper">
                            <select name="test1" class="form-control claim_product select_val input_val" id="claim_product">
                                 <option value="" >Model Name</option>
                                <?php  
//                                foreach($loop1 as $loop3){
//                                $product_title = $loop3->post_title;
//                                $product_title2 = str_replace(' ', '_', $product_title);
                                ?>
                                <option value="<?php // echo $product_title2; ?>"><?php // echo $product_title; ?></option>
                                <?php // } ?>
                            </select>
                        </div>
                        </div>-->
<!--                        <div class="form-group col-md-6">
                              <div class="dealer_select_wraper">
                            <select name="test2" class="form-control claim_model select_val input_val" id="claim_model">
                                <option value="" >Model Type</option>
                              <?php //  $taxonomy = 'products_category';
//                                     $terms = get_terms($taxonomy);
//                                     foreach ( $terms as $term ) {
//                                     $model_name = $term->name;
//                                     $model_name2 = str_replace(' ', '_', $model_name);
                                   ?>
                                
                                <option value="<?php // echo $model_name2; ?>"><?php // echo $model_name; ?></option>
                                <?php // } ?>
                            </select>
                        </div>
                        </div>-->
                         <div class="form-group col-md-6">
                            <input type="text" class="form-control claim_chassis_number input_val" id="claim_chassis_number" placeholder="Chassis Number">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control claim_vin_number input_val" id="claim_vin_number" placeholder="VIN Number">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control claim_comments input_val" id="claim_comments" placeholder="Comments">
                        </div>
                        <div class="form-group col-md-6">
                            <?php 
                        $args2 = array(
                        'posts_per_page' => -1,
                        'offset' => 0,
                        'orderby' => 'post_date',
                        'category' => '',
                        'post_type' => 'dealer',
                        'post_status' => 'publish',       
                        'order' => 'DESC'
                            ); 
                        $loopdealer = get_posts($args2);
                        ?>
<!--                              <div class="dealer_select_wraper">
                            <select name="test" class="form-control  claim_dealer input_val" id="claim_dealer">
                                 <option value="" >Dealership</option>
                                <?php 
//                                foreach($loopdealer as $loopdealer2){
//                                $dealer_name = $loopdealer2->post_title;
//                                $dealer_name2 = str_replace(' ', '_', $dealer_name);
                                 ?>
                                <option value="<?php // echo $dealer_name2; ?>"><?php // echo $dealer_name ?></option>
                                <?php // } ?>
                            </select>
                        </div>-->
                        <div class="form-group col-md-12" style="padding-left:0;padding-right:0;">
                           <select name="test" class="form-control claim_dealer input_val select_val" required="required" id="claim_dealer">
                                   <option value="">Dealership</option>
                                       <?php   foreach($loopdealer as $loopdealer2){
                                $dealer_name = $loopdealer2->post_title;
                                $dealer_name2 = str_replace(' ', '_', $dealer_name);
                                    ?>
                               <option value="<?php echo $dealer_name2; ?>"><?php echo $dealer_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                               <div class="form-group sub_clim">
                            <button type="submit" class="btn btn-default send_claim" style="float:right;">Submit</button>
                        </div> 
                            <div class="load_cont_btn">
                            <div class="loading_btn"></div>
                            <div class="loaded_btn"></div>
                        </div>
                        </div> 
                        <div class="form-group col-md-6">
                            <div id="upload" class="claim_up"><span>Upload Images<span></div><span id="status" ></span>		
                                <ul class="upload_imgs" id="files" ></ul>
                            <!--<span class="file-input btn btn-primary btn-file">-->
                                <!--<input multiple class="multi with-preview claim_dream_img" maxlength="10" accept="gif|jpg|png" type="file" id="file" name="files[]"/>-->
                            <!--</span>-->
                        </div>
<!--                        <div class="form-group col-md-6">
                            <span class="file-input btn btn-primary btn-file">
                                Upload Images <input type="file" multiple></span>
                        </div>-->
<input class="uploaded_path" value="" type="hidden">                     
                    </form>
                </div>
                <div class="col-md-4 contact-right">
                    <h2>CONTACT US</h2>
                    <?php
                        $cont_id = cedo_get_option('cus');
                        $rows4 = get_field('contact_us_section', 15 );                       
                        ?>
                    <div class="contact-itm">                        
                        <h5><?php echo $rows4[0]['section_title']; ?></h5>
                        <?php echo $rows4[0]['section_content']; ?>
                    </div>
<!--                    <div class="contact-itm">
                        <h5><?php // echo $rows[1]['section_title']; ?></h5>
                         <?php // echo $rows[1]['section_content']; ?>
                    </div>-->
                    <div class="contact-itm">
                         <h5><?php echo $rows4[2]['section_title']; ?></h5>
                        <?php echo $rows4[2]['section_content']; ?>
                    </div>
                </div>
             </div>
        </div>
    </div>
      
    
<?php
get_footer();
?>