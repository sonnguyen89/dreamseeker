jQuery(document).ready(function() {
jQuery(window).scroll(function() {
     if(jQuery(document).scrollTop() > 90){
    jQuery('.navbar-primary .navbar-nav li a').css({
        "padding-top":"7px",
        "padding-bottom":"5px"
    });
    jQuery('.navbar-secondary .navbar-nav li a').css({
        "padding-bottom":"5px",
        "padding-top":"10px"
    });
    jQuery('.logo').css({
        "margin-top":"7px",
        "margin-bottom":"7px"
    });
    jQuery('.second_main_navbar .navbar-secondary').css({
        "height":"19px",
        "padding-bottom":"7px"
    });
    jQuery('#navbar').css({
        "margin-top":"7px"
    });
    jQuery('#navbar li a').css({
         "padding-top":"12px",
         "padding-bottom":"12px",
    });
    jQuery('.second-navbar').css({
        "margin-top":"75px"
//        "margin-top":"64px"
    });
    jQuery('.navbar').css({
        "min-height":"34px"
    });
    jQuery('.search_inpu').css({
        "top":"30px",
//        "padding":"2px",
//        "min-width":"273px"
    });
}else{
     jQuery('.navbar-primary .navbar-nav  li a').css({
        "padding-top":"15px",
        "padding-bottom":"15px"
    });
       jQuery('.navbar-secondary .navbar-nav li a').css({
        "padding-bottom":"10px",
        "padding-top":"14px"
    });
    jQuery('.logo').css({
        "margin-top":"22px",
        "margin-bottom":"22px"
    }); 
    jQuery('.second_main_navbar .navbar-secondary').css({
        "height":"50px",
        "padding-bottom":"15px"
    });
     jQuery('#navbar').css({
        "margin-top":"15px"
    });
     jQuery('#navbar a').css({
        "padding-top":"15px",
        "padding-bottom":"15px"
    });
    jQuery('.second-navbar').css({
        "margin-top":"91px"
    });
     jQuery('.navbar').css({
        "min-height":"50px"
    });
       jQuery('.search_inpu').css({
        "top":"40px",
//        "padding":"11px",
//        "min-width":"300px"
    });
}
    
});
    jQuery('.ytcmore').html('READ ALL');
setTimeout(function(){
      jQuery('table.uiGrid._51mz').css('display', 'none');
  
}, 1600);

jQuery('.result_pn').live('click', function() {
    init();
});
jQuery('.directions-tab').live('click', function() {
    init();
});

//jQuery('.bx-wrapper .slide').live('click', function() {
//    setTimeout(function(){  
////    var thum_wth = jQuery('#fancybox-thumbs ul').width();    
////var thum_marg = jQuery('#fancybox-thumbs ul').css("margin-left").replace('px', '');
//
//
//
//        jQuery('.right_click').live('click', function() {
//              var thum_marg1 = jQuery('#fancybox-thumbs ul').css("margin-left").replace('px', '');
//              var thum_marg11 = thum_marg1.replace('-', '');
//              var thum_marg22 = '435';
//              var thumb_all = parseInt(thum_marg1, 10) + parseInt(thum_marg22, 10);
//              console.log(thum_wth);
//              console.log(thumb_all);    
//               if(thumb_all > 0){
//        jQuery('#fancybox-thumbs ul').animate({
//            marginLeft: "-=145px"
//        }, "fast");
//               }else{
//                  jQuery('.right_click').live('click', function(e) {
//      e.preventDefault();
//      });
//               }
//    });
//
////if(thum_marg < 0){
//    jQuery('.left_click').live('click', function() {
//      var thum_marg2 = jQuery('#fancybox-thumbs ul').css("margin-left").replace('px', '');
////      console.log(thum_marg2);
//         if(thum_marg2 < 0){
//        jQuery('#fancybox-thumbs ul').animate({
//            marginLeft: "+=145px"
//        }, "fast");    
//}else{
//     jQuery('.left_click').live('click', function(e) {
//      e.preventDefault();
//      });
//}
//});
//}, 600);

//});

    jQuery(".youtube").colorbox({iframe: true, innerWidth: 640, innerHeight: 390});
    jQuery('#news_share').click(function() {
        jQuery('.addthis_sharing_toolbox.art').slideToggle("slow");
    });
    jQuery('#news_share2').click(function() {
        jQuery('.addthis_sharing_toolbox.galo').slideToggle("slow");
    });

    jQuery(".news_video_image").click(function() {
        jQuery(".youtube").trigger("click");
    });

    jQuery("#searchTextField").click(function() {
        jQuery('#prod_filt').val('');
//    jQuery('#prod_filt').css('background-color', '#9A9999');
//     jQuery('#searchTextField').css('background-color', '#dfe0df');
    });
    jQuery("#prod_filt").click(function() {
        jQuery('#searchTextField').val('');
//     jQuery('#searchTextField').css('background-color', '#9A9999');
//      jQuery('#prod_filt').css('background-color', '#dfe0df');
    });

    function equalHeight(group) {
        tallest = 0;
        group.each(function() {
            thisHeight = jQuery(this).height();
            if (thisHeight > tallest) {
                tallest = thisHeight;
            }
        });
        group.height(tallest);
    }
    equalHeight(jQuery(".EqHeightDiv"));

//    });   

    jQuery(".search-icon").live('click', function(e) {
        e.preventDefault();
//        jQuery('.search_big.mk-fullscreen-search-overlay').fadeIn();
        jQuery('.search_inpu').fadeToggle();

    });
//    jQuery(".mk-fullscreen-close").live('click', function() {
//        jQuery('.search_inpu').fadeOut();
//    });

    jQuery('.range-disoption .colicon').click(function() {
        jQuery(".current").removeClass("current");
        jQuery(this).addClass("current");
    });

//    jQuery('.sub-menu-range li a').click(function(){
//       var ttl =  jQuery(this).text();
//       jQuery('.range-heroimg h1').val(ttl);
//  });
//  
    var parentHeight = jQuery('.search_big').height();
    var childHeight = jQuery('#mk-fullscreen-search-wrapper').height();
    var height_sc = (parentHeight - childHeight) / 2 - 80;
    jQuery('#mk-fullscreen-search-wrapper').css('margin-top', height_sc);

    jQuery('.filter_pro').change(function() {
        jQuery('#view_more_count').attr("data_count", "0");
        var price_value = jQuery('.product_price').val();
        var price_key = jQuery('#product_priceSelectBoxIt').attr('data_val');
        var length_value = jQuery('.product_length').val();
        var length_key = jQuery('#product_lengthSelectBoxIt').attr('data_val');
        var dealer_value = jQuery('.product_dealer').val();
        var dealer_key = jQuery('.product_dealer').attr('data_val');
        var product_category = jQuery('.product_category').val();
//      console.log(product_category);
        jQuery('.range-heroimg h1').text(product_category);
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
                    equalHeight(jQuery(".EqHeightDiv"));
                } else {

                }
            }
        });
    });
    jQuery('.range-disoption.range_op .colicon.col4').click(function(e) {
        e.preventDefault();
        jQuery('#view_more_count').attr("data_count", "0");
        var price_value = jQuery('.product_price').val();
        var price_key = jQuery('#product_priceSelectBoxIt').attr('data_val');
        var length_value = jQuery('.product_length').val();
        var length_key = jQuery('#product_lengthSelectBoxIt').attr('data_val');
        var dealer_value = jQuery('.product_dealer').val();
        var dealer_key = jQuery('.product_dealer').attr('data_val');
        var product_category = jQuery('.product_category').val();
//      console.log(product_category);
        jQuery('.range-heroimg h1').text(product_category);
        jQuery.ajax({
            type: 'POST',
            url: wpdrm.ajaxurl,
            data: {
                pgnonce: wpdrm.PGNonce,
                'action': 'filter_price_4',
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
                    equalHeight(jQuery(".EqHeightDiv"));
                } else {

                }
            }
        });
    });
    jQuery('.range-disoption.range_op .colicon.col3').click(function(e) {
        e.preventDefault();
        jQuery('#view_more_count').attr("data_count", "0");
        var price_value = jQuery('.product_price').val();
        var price_key = jQuery('#product_priceSelectBoxIt').attr('data_val');
        var length_value = jQuery('.product_length').val();
        var length_key = jQuery('#product_lengthSelectBoxIt').attr('data_val');
        var dealer_value = jQuery('.product_dealer').val();
        var dealer_key = jQuery('.product_dealer').attr('data_val');
        var product_category = jQuery('.product_category').val();
//      console.log(product_category);
        jQuery('.range-heroimg h1').text(product_category);
        jQuery.ajax({
            type: 'POST',
            url: wpdrm.ajaxurl,
            data: {
                pgnonce: wpdrm.PGNonce,
                'action': 'filter_price_3',
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
                    equalHeight(jQuery(".EqHeightDiv"));
                    jQuery('#view_more_count').attr("data_count", 0);
                } else {

                }
            }
        });
    });
    jQuery('.range-disoption.range_op .colicon.col1').click(function(e) {
        e.preventDefault();
        jQuery('#view_more_count').attr("data_count", "0");
        var price_value = jQuery('.product_price').val();
        var price_key = jQuery('#product_priceSelectBoxIt').attr('data_val');
        var length_value = jQuery('.product_length').val();
        var length_key = jQuery('#product_lengthSelectBoxIt').attr('data_val');
        var dealer_value = jQuery('.product_dealer').val();
        var dealer_key = jQuery('.product_dealer').attr('data_val');
        var product_category = jQuery('.product_category').val();
//      console.log(product_category);
        jQuery('.range-heroimg h1').text(product_category);
        jQuery.ajax({
            type: 'POST',
            url: wpdrm.ajaxurl,
            data: {
                pgnonce: wpdrm.PGNonce,
                'action': 'filter_price_full',
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
                    equalHeight(jQuery(".EqHeightDiv"));
                    jQuery('#view_more_count').attr("data_count", 0);
                } else {

                }
            }
        });
    });

    jQuery('.filter_view_more').click(function(e) {
        e.preventDefault();

        if (jQuery('.range-disoption.range_op .colicon.col4').hasClass('current')) {
            var product_count = Number(jQuery(this).attr('data_count'));
            product_count = product_count + 4
            var price_value = jQuery('.product_price').val();
            var price_key = jQuery('#product_priceSelectBoxIt').attr('data_val');
            var length_value = jQuery('.product_length').val();
            var length_key = jQuery('#product_lengthSelectBoxIt').attr('data_val');
            var dealer_value = jQuery('.product_dealer').val();
            var dealer_key = jQuery('.product_dealer').attr('data_val');
            var product_category = jQuery('.product_category').val();
//     console.log(product_count);
            jQuery.ajax({
                type: 'POST',
                url: wpdrm.ajaxurl,
                data: {
                    pgnonce: wpdrm.PGNonce,
                    'action': 'filter_view_more_4',
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
                        jQuery('#view_more_count').attr("data_count", product_count);
                        jQuery('.jscroll-added').hide();
                        jQuery('.jscroll-next-parent').show();
                        jQuery('#view_more_count').show();
                        jQuery('.view_more_wrp').show();
                        equalHeight(jQuery(".EqHeightDiv"));
                    } else {

                    }
                }
            });
        } else if (jQuery('.range-disoption.range_op .colicon.col3').hasClass('current')) {
            var product_count = Number(jQuery(this).attr('data_count'));
            product_count = product_count + 3
            var price_value = jQuery('.product_price').val();
            var price_key = jQuery('#product_priceSelectBoxIt').attr('data_val');
            var length_value = jQuery('.product_length').val();
            var length_key = jQuery('#product_lengthSelectBoxIt').attr('data_val');
            var dealer_value = jQuery('.product_dealer').val();
            var dealer_key = jQuery('.product_dealer').attr('data_val');
            var product_category = jQuery('.product_category').val();
//     console.log(product_count);
            jQuery.ajax({
                type: 'POST',
                url: wpdrm.ajaxurl,
                data: {
                    pgnonce: wpdrm.PGNonce,
                    'action': 'filter_view_more_3',
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
                        jQuery('#view_more_count').attr("data_count", product_count);
                        jQuery('.jscroll-added').hide();
                        jQuery('.jscroll-next-parent').show();
                        jQuery('#view_more_count').show();
                        jQuery('.view_more_wrp').show();
                        equalHeight(jQuery(".EqHeightDiv"));
                    } else {

                    }
                }
            });
        } else {
            var product_count = Number(jQuery(this).attr('data_count'));
            product_count = product_count + 2;
            var price_value = jQuery('.product_price').val();
            var price_key = jQuery('#product_priceSelectBoxIt').attr('data_val');
            var length_value = jQuery('.product_length').val();
            var length_key = jQuery('#product_lengthSelectBoxIt').attr('data_val');
            var dealer_value = jQuery('.product_dealer').val();
            var dealer_key = jQuery('.product_dealer').attr('data_val');
            var product_category = jQuery('.product_category').val();
//     console.log(product_count);
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
                        jQuery('#view_more_count').attr("data_count", product_count);
                        jQuery('.jscroll-added').hide();
                        jQuery('.jscroll-next-parent').show();
                        jQuery('#view_more_count').show();
                        jQuery('.view_more_wrp').show();
                        equalHeight(jQuery(".EqHeightDiv"));
                    } else {

                    }
                }
            });
        }

    });



    jQuery('.filter_upcomings').click(function() {
        var product_count = Number(jQuery(this).attr('data_count'));
        product_count = product_count + 2
        var ustae_value = jQuery('.upcoming_sate').val();
        var umoth_value = jQuery('.upcoming_months').val();
        jQuery.ajax({
            type: 'POST',
            url: wpdrm.ajaxurl,
            data: {
                pgnonce: wpdrm.PGNonce,
                'action': 'filter_up',
                'ustae_value': ustae_value,
                'umoth_value': umoth_value,
                'product_count': product_count

            },
            beforeSend: function() {

            },
            success: function(responce) {
                jQuery('.hide_load').show();
                if (responce) {
                    jQuery('.append_res').empty();
                    jQuery('.append_res').append(responce);
                    jQuery('.hide_load').hide();
//                    jQuery('.range-viewmore').hide();
                    equalHeight(jQuery(".EqHeightDiv"));
                } else {

                }
            }
        });
    });

    jQuery('.range-disoption.upcome_opt .colicon.col4').click(function() {
        var product_count = 0;
        var ustae_value = jQuery('.upcoming_sate').val();
        var umoth_value = jQuery('.upcoming_months').val();
        jQuery.ajax({
            type: 'POST',
            url: wpdrm.ajaxurl,
            data: {
                pgnonce: wpdrm.PGNonce,
                'action': 'filter_up_4',
                'ustae_value': ustae_value,
                'umoth_value': umoth_value,
                'product_count': product_count

            },
            beforeSend: function() {

            },
            success: function(responce) {
                jQuery('.hide_load').show();
                if (responce) {
                    jQuery('.append_res').empty();
                    jQuery('.append_res').append(responce);
                    jQuery('.hide_load').hide();
                    jQuery('#view_more_count').attr("data_count", 0);
                    equalHeight(jQuery(".EqHeightDiv"));
                } else {

                }
            }
        });
    });
    jQuery('.range-disoption.upcome_opt .colicon.col3').click(function() {
        var product_count = 0;
        var ustae_value = jQuery('.upcoming_sate').val();
        var umoth_value = jQuery('.upcoming_months').val();
        jQuery.ajax({
            type: 'POST',
            url: wpdrm.ajaxurl,
            data: {
                pgnonce: wpdrm.PGNonce,
                'action': 'filter_up_3',
                'ustae_value': ustae_value,
                'umoth_value': umoth_value,
                'product_count': product_count

            },
            beforeSend: function() {

            },
            success: function(responce) {
                jQuery('.hide_load').show();
                if (responce) {
                    jQuery('.append_res').empty();
                    jQuery('.append_res').append(responce);
                    jQuery('.hide_load').hide();
                    jQuery('#view_more_count').attr("data_count", 0);
                    equalHeight(jQuery(".EqHeightDiv"));
                } else {

                }
            }
        });
    });

    jQuery('.range-disoption.upcome_opt .colicon.col1').click(function() {
        var product_count = 0;
        var ustae_value = jQuery('.upcoming_sate').val();
        var umoth_value = jQuery('.upcoming_months').val();
        jQuery.ajax({
            type: 'POST',
            url: wpdrm.ajaxurl,
            data: {
                pgnonce: wpdrm.PGNonce,
                'action': 'filter_up',
                'ustae_value': ustae_value,
                'umoth_value': umoth_value,
                'product_count': product_count

            },
            beforeSend: function() {

            },
            success: function(responce) {
                jQuery('.hide_load').show();
                if (responce) {
                    jQuery('.append_res').empty();
                    jQuery('.append_res').append(responce);
                    jQuery('.hide_load').hide();
                    jQuery('#view_more_count').attr("data_count", 0);
                    equalHeight(jQuery(".EqHeightDiv"));
                } else {

                }
            }
        });
    });



    jQuery('.filter_view_more_upcmng').click(function(e) {
        e.preventDefault();
        if (jQuery('.range-disoption.upcome_opt .colicon.col4').hasClass('current')) {
//                       jQuery('#view_more_count').attr("data_count",'');
            var product_count = Number(jQuery(this).attr('data_count'));
            product_count = product_count + 4
            var ustae_value = jQuery('.upcoming_sate').val();
            var umoth_value = jQuery('.upcoming_months').val();
            jQuery.ajax({
                type: 'POST',
                url: wpdrm.ajaxurl,
                data: {
                    pgnonce: wpdrm.PGNonce,
                    'action': 'filter_view_more_up_4',
                    'ustae_value': ustae_value,
                    'umoth_value': umoth_value,
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
                        jQuery('#view_more_count').attr("data_count", product_count);
                        jQuery('.jscroll-added').hide();
                        jQuery('.jscroll-next-parent').show();
                        jQuery('#view_more_count').show();
                        jQuery('.view_more_wrp').show();
                        equalHeight(jQuery(".EqHeightDiv"));
                    } else {

                    }
                }
            });
        } else if (jQuery('.range-disoption.upcome_opt .colicon.col3').hasClass('current')) {

            var product_count = Number(jQuery(this).attr('data_count'));
            product_count = product_count + 3
            var ustae_value = jQuery('.upcoming_sate').val();
            var umoth_value = jQuery('.upcoming_months').val();
            jQuery.ajax({
                type: 'POST',
                url: wpdrm.ajaxurl,
                data: {
                    pgnonce: wpdrm.PGNonce,
                    'action': 'filter_view_more_up_3',
                    'ustae_value': ustae_value,
                    'umoth_value': umoth_value,
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
                        jQuery('#view_more_count').attr("data_count", product_count);
                        jQuery('.jscroll-added').hide();
                        jQuery('.jscroll-next-parent').show();
                        jQuery('#view_more_count').show();
                        jQuery('.view_more_wrp').show();
                        equalHeight(jQuery(".EqHeightDiv"));
                    } else {

                    }
                }
            });
        } else {

            var product_count = Number(jQuery(this).attr('data_count'));
            product_count = product_count + 2
            var ustae_value = jQuery('.upcoming_sate').val();
            var umoth_value = jQuery('.upcoming_months').val();
            jQuery.ajax({
                type: 'POST',
                url: wpdrm.ajaxurl,
                data: {
                    pgnonce: wpdrm.PGNonce,
                    'action': 'filter_view_more_up',
                    'ustae_value': ustae_value,
                    'umoth_value': umoth_value,
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
                        jQuery('#view_more_count').attr("data_count", product_count);
                        jQuery('.jscroll-added').hide();
                        jQuery('.jscroll-next-parent').show();
                        jQuery('#view_more_count').show();
                        jQuery('.view_more_wrp').show();
//                      equalHeight(jQuery(".EqHeightDiv"));
                    } else {

                    }
                }
            });
        }

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
                if (searchTextField != '') {
                    jQuery('.searched-for .bold').text(searchTextField);
                } else {
                    jQuery('.searched-for .bold').text(prod_filt);
                }
                jQuery('.searched-for .pull-left').css('display', 'none');
                jQuery('.searched-for .bold').css('display', 'none');
                jQuery('.loading_btn1').css('display', 'block')
            },
            success: function(responce) {
                jQuery('.hide_load').show();
                if (responce) {
                    responce = responce.split('(%=200=%)');
                    jQuery('.append_search').empty();
                    jQuery('.append_search').append(responce[0]);
                    jQuery('.hide_load').hide();
                    load_map_a(JSON.parse(responce[1]));
                } else {

                }
                jQuery('.loading_btn1').css('display', 'none');
                jQuery('.searched-for .pull-left').css('display', 'block');
                jQuery('.searched-for .bold').css('display', 'block');
                jQuery('#results .searched-for .pull-left').css('visibility', 'visible');
            }
        });
    });
//jQuery('#searchTextField').keydown(function (e){
   jQuery(document).on("keypress", "#searchTextField", function (e) {
  if (e.keyCode == 13){
      e.preventDefault();
      jQuery('.show_deal').trigger('submit');
  } 

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

    jQuery('.send_ns').live('click', function(e) {
        e.preventDefault();
        var f_name = jQuery('.f_name').val();
        var email1 = jQuery('.email1').val();
        has_error = false;
        jQuery.each(jQuery('.input_val_1'), function() {
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
                        email1: email1,
                        action: 'send_mail_from_ns'
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


    //for make a claim 
    jQuery('.send_claim').live('click', function(e) {
        e.preventDefault();
        jQuery('.send_claim_img').trigger('click');
        var claim_f_name = jQuery('.claim_f_name').val();
        var claim_l_name = jQuery('.claim_l_name').val();
        var claim_email = jQuery('.claim_email').val();
        var claim_phone = jQuery(".claim_phone").val();
        var claim_postal_code = jQuery(".claim_postal_code").val();
        var claim_sate = jQuery(".claim_sate").val();
        var datepicker = jQuery('.datepicker').val();
        var claim_product = jQuery('.claim_product').val();
        var claim_model = jQuery('.claim_model').val();
        var claim_chassis_number = jQuery('.claim_chassis_number').val();
        var claim_vin_number = jQuery('.claim_vin_number').val();
        var claim_comments = jQuery('.claim_comments').val();
        var claim_dealer = jQuery('.claim_dealer').val();
        var uploaded_path = jQuery('.uploaded_path').val();

        has_error = false;
        jQuery.each(jQuery('.input_val'), function() {
            if ((jQuery(this).val() === '') || jQuery(this).find('option:selected').val() === '') {
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
            if (validateEmail(claim_email)) {
                jQuery('.claim_email').removeClass('error');
                jQuery('.loading').show();

                jQuery.ajax({
                    type: 'POST',
                    url: wpdrm.ajaxurl,
                    data: {
                        pgnonce: wpdrm.PGNonce,
                        claim_f_name: claim_f_name,
                        claim_l_name: claim_l_name,
                        claim_email: claim_email,
                        claim_phone: claim_phone,
                        claim_postal_code: claim_postal_code,
                        claim_sate: claim_sate,
                        datepicker: datepicker,
                        claim_product: claim_product,
                        claim_model: claim_model,
                        claim_chassis_number: claim_chassis_number,
                        claim_vin_number: claim_vin_number,
                        claim_comments: claim_comments,
                        claim_dealer: claim_dealer,
                        uploaded_path: uploaded_path,
                        action: 'send_make_a_disclaimer'
                    },
                    beforeSend: function() {
                        jQuery('.loading_btn').css('display', 'block');
                        jQuery('.loaded_btn').css('display', 'none');
                    },
                    success: function(responce) {
                        jQuery('.loading_btn').css('display', 'none')
                        jQuery('.loaded_btn').css('display', 'block')
                        jQuery('.load_cont_btn').append('<div class="mail_msg">You Made a Claim Successfully!</div>');
//                        jQuery(".clm_frm")[0].reset(); 
//                        jQuery(".upload_imgs").childrens().remove(); 
                    }
                });
            }
            else {
                jQuery('.claim_email').addClass('error');
                jQuery("html, body").animate({scrollTop: jQuery('.cont_frm').offset().top}, 1000);
            }
        }
        if (has_error) {
            return true;
        }
    });

    jQuery('.input_val').on('keyup', function() {
        if (jQuery(this).val() != '' || jQuery(this).find('option:selected').val() != '' || jQuery('#datepicker').datepicker().val() != '') {
            jQuery(this).removeClass('error');
        }
    });

    jQuery('.input_val').on('change', function() {
        if (jQuery(this).val()) {
            jQuery(this).removeClass('error');
        }
    });
    jQuery('.input_val_1').on('keyup', function() {
        if (jQuery(this).val() != '' || jQuery(this).find('option:selected').val() != '' || jQuery('#datepicker').datepicker().val() != '') {
            jQuery(this).removeClass('error');
        }
    });

    jQuery('.input_val_1').on('change', function() {
        if (jQuery(this).val()) {
            jQuery(this).removeClass('error');
        }
    });

//    index page scroller dwn
jQuery(".index_scroller_dwn").click(function() {
    jQuery('html, body').animate({
        scrollTop: jQuery("#featured-products").offset().top
    }, 2000);
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