jQuery(document).ready(function() {
       
    jQuery(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390}); 
       jQuery('#news_share').click(function(){
       jQuery('.addthis_sharing_toolbox').slideToggle( "slow" );
});

    jQuery( ".news_video_image" ).click(function() {
    jQuery( ".youtube" ).trigger( "click" );
});
  
function equalHeight(group) {
    tallest = 0;
    group.each(function() {
        thisHeight = jQuery(this).height();
        if(thisHeight > tallest) {
            tallest = thisHeight;
        }
    });
    group.height(tallest);
}
  equalHeight(jQuery(".EqHeightDiv"));
        
//    });   

  jQuery(".search-icon").live('click',function(e) {
      e.preventDefault();
    jQuery('.search_big.mk-fullscreen-search-overlay').fadeIn();
  });
  jQuery(".mk-fullscreen-close").live('click',function() {
    jQuery('.search_big.mk-fullscreen-search-overlay').fadeOut();
  });
  
  var parentHeight = jQuery('.search_big').height();
var childHeight = jQuery('#mk-fullscreen-search-wrapper').height();
var height_sc = (parentHeight - childHeight) / 2 -80;
jQuery('#mk-fullscreen-search-wrapper').css('margin-top', height_sc);
 
    jQuery('.filter_pro').change(function() {
       jQuery('#view_more_count').attr("data_count","0");
        var price_value = jQuery('.product_price').val();
        var price_key = jQuery('#product_priceSelectBoxIt').attr('data_val');
        var length_value = jQuery('.product_length').val();
        var length_key = jQuery('#product_lengthSelectBoxIt').attr('data_val');
        var dealer_value = jQuery('.product_dealer').val();
        var dealer_key = jQuery('.product_dealer').attr('data_val');
        var product_category = jQuery('.product_category').val();
//      console.log(product_category);
        jQuery.ajax({
            type: 'POST',
            url: wpdrm.ajaxurl,
            data: {
                pgnonce: wpdrm.PGNonce,
                'action': 'filter_price',
                'price_value': price_value,
                'price_key': price_key,
                'length_value': length_value,
                'length_key': length_key,
                'dealer_value': dealer_value,
                'dealer_key': dealer_key,
                'product_category': product_category

            },
            beforeSend: function() {

            },
            success: function(responce) {
                jQuery('.hide_load').show();
                if (responce) {
                    jQuery('.append_res').empty();
                    jQuery('.append_res').append(responce);
                    jQuery('.hide_load').hide();
                } else {

                }
            }
        });
    });
    
    jQuery('.filter_view_more').click(function(e) {
         e.preventDefault();
        var product_count = Number(jQuery(this).attr('data_count'));
        product_count = product_count + 3
        var price_value = jQuery('.product_price').val();
        var price_key = jQuery('#product_priceSelectBoxIt').attr('data_val');
        var length_value = jQuery('.product_length').val();
        var length_key = jQuery('#product_lengthSelectBoxIt').attr('data_val');
        var dealer_value = jQuery('.product_dealer').val();
        var dealer_key = jQuery('.product_dealer').attr('data_val');
        var product_category = jQuery('.product_category').val();
     console.log(product_count);
        jQuery.ajax({
            type: 'POST',
            url: wpdrm.ajaxurl,
            data: {
                pgnonce: wpdrm.PGNonce,
                'action': 'filter_view_more',
                'price_value': price_value,
                'price_key': price_key,
                'length_value': length_value,
                'length_key': length_key,
                'dealer_value': dealer_value,
                'dealer_key': dealer_key,
                'product_category': product_category,
                'product_count': product_count

            },
            beforeSend: function() {
           jQuery('#view_more_count').hide();
           jQuery('.view_more_wrp').hide();
           jQuery('.jscroll-added').show();
            },
            success: function(responce) {
                jQuery('.view_more_count').hide();
                jQuery('.jscroll-added').show();
                if (responce) {
                   // jQuery('.append_res').empty();
                    jQuery('.append_res').append(responce);
                    jQuery('.hide_load').hide();
                    jQuery('#view_more_count').attr("data_count",product_count);
                    jQuery('.jscroll-added').hide();
                    jQuery('.jscroll-next-parent').show();
                    jQuery('#view_more_count').show();
                    jQuery('.view_more_wrp').show();
                } else {

                }
            }
        });
    });
    jQuery('.filter_upcomings').click(function() {
        var ustae_value = jQuery('.upcoming_sate').val();
        var ustae_key = jQuery('#up_stateSelectBoxIt').attr('data_val');
        var umoth_value = jQuery('.upcoming_months').val();
        var umoth_key = jQuery('#up_monthSelectBoxIt').attr('data_val');
//      console.log(product_category);
        jQuery.ajax({
            type: 'POST',
            url: wpdrm.ajaxurl,
            data: {
                pgnonce: wpdrm.PGNonce,
                'action': 'filter_up',
                'ustae_value': ustae_value,
                'ustae_key': ustae_key,
                'umoth_value': umoth_value,
                'umoth_key': umoth_key,

            },
            beforeSend: function() {

            },
            success: function(responce) {
                jQuery('.hide_load').show();
                if (responce) {
                    jQuery('.append_res').empty();
                    jQuery('.append_res').append(responce);
                    jQuery('.hide_load').hide();
                } else {

                }
            }
        });
    });
    
   
      jQuery('.show_deal').live('click', function(e) {
        e.preventDefault();
        var searchTextField = jQuery('.searchTextField').val();
        var prod_filt = jQuery('.prod_filt').val();

                jQuery.ajax({
                    type: 'POST',
                    url: wpdrm.ajaxurl,
                    data: {
                        pgnonce: wpdrm.PGNonce,
                        searchTextField: searchTextField,                       
                        prod_filt: prod_filt,                       
                        action: 'show_dealers'
                    },
                    beforeSend: function() {
                        if(searchTextField != ''){
                             jQuery('.searched-for .bold').text(searchTextField);
                        }else{
                             jQuery('.searched-for .bold').text(prod_filt);
                        }                       
                        jQuery('.searched-for .pull-left').css('display', 'none');
                        jQuery('.searched-for .bold').css('display', 'none');
                        jQuery('.loading_btn1').css('display', 'block')
                    },
                    success: function(responce) {
                        jQuery('.hide_load').show();
                if (responce) {
                    responce=responce.split('(%=200=%)');
                    jQuery('.append_search').empty();
                    jQuery('.append_search').append(responce[0]);
                    jQuery('.hide_load').hide();                  
                    load_map_a(JSON.parse(responce[1]));
                } else {

                }
                        jQuery('.loading_btn1').css('display', 'none');
                         jQuery('.searched-for .pull-left').css('display', 'block');
                        jQuery('.searched-for .bold').css('display', 'block');
                    }
                });
    });
    
    

    jQuery('.send_mail').live('click', function(e) {
        e.preventDefault();
        var f_name = jQuery('.f_name').val();
        var l_name = jQuery('.l_name').val();
        var email1 = jQuery('.email1').val();
        var phone = jQuery(".phone").val();
        var p_code = jQuery(".p_code").val();
        var chasy_no = jQuery(".chasy_no").val();
        var dealer = jQuery('.dealer').val();
        var hereus1 = jQuery('.hereus1').val();
        var hereus2 = jQuery('.hereus2').val();
        has_error = false;
        jQuery.each(jQuery('.input_val'), function() {
            if (jQuery(this).val() === '') {
                jQuery(this).addClass('error').focus();
                has_error = true;
                return false;
            } else if (!jQuery(this).val()) {
                jQuery(this).addClass('error').focus();
                has_error = true;
                return false;
            }
        });
        if (!has_error) {
            if (validateEmail(email1)) {
                jQuery('.email1').removeClass('error');
                jQuery('.loading').show();

                jQuery.ajax({
                    type: 'POST',
                    url: wpdrm.ajaxurl,
                    data: {
                        pgnonce: wpdrm.PGNonce,
                        f_name: f_name,
                        l_name: l_name,
                        email1: email1,
                        phone: phone,
                        p_code: p_code,
                        chasy_no: chasy_no,
                        dealer: dealer,
                        hereus1: hereus1,
                        hereus2: hereus2,
                        action: 'send_mail_from_contact_page'
                    },
                    beforeSend: function() {
                        jQuery('.loading_btn').css('display', 'block')
                        jQuery('.loaded_btn').css('display', 'none')
                    },
                    success: function(responce) {
                        jQuery('.loading_btn').css('display', 'none')
                        jQuery('.loaded_btn').css('display', 'block')
                        jQuery('.load_cont_btn').append('<div class="mail_msg">Email Sent Successfully!</div>')
                    }
                });
            }
            else {
                jQuery('.email1').addClass('error');
                jQuery("html, body").animate({scrollTop: jQuery('.cont_frm').offset().top}, 1000);
            }
        }
        if (has_error) {
            return true;
        }
    });
    jQuery('.input_val').on('keyup', function() {
        if (jQuery(this).val() != '') {
            jQuery(this).removeClass('error');
        }
    });
    jQuery('.input_val').on('change', function() {
        if (jQuery(this).val()) {
            jQuery(this).removeClass('error');
        }
    });


});

function validateEmail(semail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(semail)) {
        return true;
    }
    else {
        return false;
    }
}