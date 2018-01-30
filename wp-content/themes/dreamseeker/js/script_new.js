jQuery(document).ready(function() {

    

    function callPlayer(frame_id, func, args) {

        if (window.jQuery && frame_id instanceof jQuery) frame_id = frame_id.get(0).id;

        var iframe = document.getElementById(frame_id);

        if (iframe && iframe.tagName.toUpperCase() != 'IFRAME') {

            iframe = iframe.getElementsByTagName('iframe')[0];

        }



        // When the player is not ready yet, add the event to a queue

        // Each frame_id is associated with an own queue.

        // Each queue has three possible states:

        //  undefined = uninitialised / array = queue / 0 = ready

        if (!callPlayer.queue) callPlayer.queue = {};

        var queue = callPlayer.queue[frame_id],

        domReady = document.readyState == 'complete';



        if (domReady && !iframe) {

            // DOM is ready and iframe does not exist. Log a message

            window.console && console.log('callPlayer: Frame not found; id=' + frame_id);

            if (queue) clearInterval(queue.poller);

        } else if (func === 'listening') {

            // Sending the "listener" message to the frame, to request status updates

            if (iframe && iframe.contentWindow) {

                func = '{"event":"listening","id":' + JSON.stringify(''+frame_id) + '}';

                iframe.contentWindow.postMessage(func, '*');

            }

        } else if (!domReady ||

            iframe && (!iframe.contentWindow || queue && !queue.ready) ||

            (!queue || !queue.ready) && typeof func === 'function') {

            if (!queue) queue = callPlayer.queue[frame_id] = [];

            queue.push([func, args]);

            if (!('poller' in queue)) {

                // keep polling until the document and frame is ready

                queue.poller = setInterval(function() {

                    callPlayer(frame_id, 'listening');

                }, 250);

                // Add a global "message" event listener, to catch status updates:

                messageEvent(1, function runOnceReady(e) {

                    if (!iframe) {

                        iframe = document.getElementById(frame_id);

                        if (!iframe) return;

                        if (iframe.tagName.toUpperCase() != 'IFRAME') {

                            iframe = iframe.getElementsByTagName('iframe')[0];

                            if (!iframe) return;

                        }

                    }

                    if (e.source === iframe.contentWindow) {

                        // Assume that the player is ready if we receive a

                        // message from the iframe

                        clearInterval(queue.poller);

                        queue.ready = true;

                        messageEvent(0, runOnceReady);

                        // .. and release the queue:

                        while (tmp = queue.shift()) {

                            callPlayer(frame_id, tmp[0], tmp[1]);

                        }

                    }

                }, false);

            }

        } else if (iframe && iframe.contentWindow) {

            // When a function is supplied, just call it (like "onYouTubePlayerReady")

            if (func.call) return func();

            // Frame exists, send message

            iframe.contentWindow.postMessage(JSON.stringify({

                "event": "command",

                "func": func,

                "args": args || [],

                "id": frame_id

            }), "*");

        }

        /* IE8 does not support addEventListener... */

        function messageEvent(add, listener) {

            var w3 = add ? window.addEventListener : window.removeEventListener;

            w3 ?

            w3('message', listener, !1)

            :

            (add ? window.attachEvent : window.detachEvent)('onmessage', listener);

        }

    }     

    

    jQuery('.close').click(function(){    

        callPlayer('yt-player', 'stopVideo');

    });



    jQuery('.news_shr').live('click',function(){  

        jQuery('.share_icons_wrapper .galo').slideToggle();

    });



    jQuery(".search").keyup(function()

    { 

        var searchid = jQuery(this).val();

        var search_text = searchid;

        //var dataString = 'search='+ searchid;

        if(searchid!='')

        {

            jQuery.ajax({

                type: 'POST',

                url: wpdrm.ajaxurl,

                data: {

                    pgnonce: wpdrm.PGNonce,

                    'action': 'show_search_result',

                    'search_text': search_text

                },

                beforeSend: function() {



                },

                success: function(responce) {       

                    jQuery('.hide_load').show();

                    if (responce) {

                        jQuery('#result_sc').css('display', 'block');

                        jQuery('#result_sc').empty();

                        jQuery('#result_sc').append(responce);

                        jQuery('.hide_load').hide();

                    } else {



                    }

                }

               

            });   



        }

        return false;    

    });



    jQuery("#result").live("click",function(e){ 

        var $clicked = jQuery(e.target);

        var $name = $clicked.find('.name').html();

        var decoded = jQuery("<div/>").html($name).text();

        jQuery('#searchid').val(decoded);

    });

    jQuery(document).live("click", function(e) { 

        var $clicked = $(e.target);

        if (! $clicked.hasClass("search")){

            jQuery("#result").fadeOut(); 

        }

    });

    jQuery('#searchid').click(function(){

        jQuery("#result").fadeIn();

    });



    jQuery("div.spec_cont_tab-tab-menu>div.list-group>a").click(function(e) {

        e.preventDefault();

        jQuery(this).siblings('a.active').removeClass("active");

        jQuery(this).addClass("active");

        var index = $(this).index();

        jQuery("div.spec_cont_tab-tab>div.spec_cont_tab-tab-content").removeClass("active");

        jQuery("div.spec_cont_tab-tab>div.spec_cont_tab-tab-content").eq(index).addClass("active");

    });





    /*jQuery(window).scroll(function() {

        if(jQuery(document).scrollTop() > 90){

            jQuery('.navbar-primary .navbar-nav li a').css({

                "padding-top":"7px",

                "padding-bottom":"5px"

            });

          /!*  jQuery('.navbar-secondary .navbar-nav li a').css({

                "padding-bottom":"5px",

                "padding-top":"15px"

            });*!/

           /!* jQuery('.logo').css({

                "margin-top":"12px",

                "margin-bottom":"12px"

            });*!/

          /!*  jQuery('.second_main_navbar .navbar-secondary').css({

                "height":"19px",

                "padding-bottom":"7px"

            });*!/

           /!* jQuery('#navbar').css({

                "margin-top":"7px"

            });*!/

            jQuery('.second_main_navbar #navbar li a').css({

                "padding-top":"10px",

                "padding-bottom":"10px",

            });

            jQuery('#navbar .second_main_navbar li a').css({

                "padding-top":"15px",

                "padding-bottom":"15px",

            });

            jQuery('.search-icon.dropdown a').css({

                "padding-top":"11px",

                "padding-bottom":"6px",

            });

            jQuery('.second-navbar').css({

                "margin-top":"73px",

                "height":"50px"

            });

          /!*  jQuery('.second_main_navbar .navbar-secondary').css({

                "height":"50px"

            });*!/

          /!*  jQuery('.navbar').css({

                "min-height":"34px"

            });*!/

            jQuery('.search_inpu').css({

                //     "top":"30px"

            //        "padding":"2px",

            //        "min-width":"273px"

            });

           /!* jQuery('.search_inpu').css({

                "height":"43px"

            });

            jQuery('.search_input').css({

                "height":"30px"

            });*!/

            jQuery('.search_btn').css({

                "height":"30"

            });

            jQuery('.serch_close_sec img').css({

                "height":"40px"

            });

        //    jQuery('.search_inpu .ui-widget').css({

        //        "width":"96.8%"

        //    });

        }else{

            //    jQuery('.search_inpu .ui-widget').css({

            //        "width":"96%"

            //    });

            jQuery('.navbar-primary .navbar-nav  li a').css({

                "padding-top":"15px",

                "padding-bottom":"15px"

            });

         /!*   jQuery('.navbar-secondary .navbar-nav li a').css({

                "padding-bottom":"10px",

                "padding-top":"18px"

            });*!/

          /!*  jQuery('.logo').css({

                "margin-top":"22px",

                "margin-bottom":"22px"

            }); *!/

           /!* jQuery('.second_main_navbar .navbar-secondary').css({

                "height":"50px",

                "padding-bottom":"15px"

            });*!/

            jQuery('#navbar').css({

                "margin-top":"15px"

            });

            jQuery('.second_main_navbar #navbar a').css({

                "padding-top":"15px",

                "padding-bottom":"15px"

            });

            jQuery('.second-navbar').css({

                "margin-top":"90px"

            });

            jQuery('.navbar').css({

                "min-height":"50px"

            });

            jQuery('.search_inpu').css({

                "top":"40px",

            //        "padding":"11px",

            //        "min-width":"300px"

            });

            jQuery('.search_inpu').css({

                "height":"51px"

            });

            jQuery('.search_input').css({

                "height":"40px"

            });

            jQuery('.search_btn').css({

                "height":"40px"

            });

            jQuery('.serch_close_sec img').css({

                "height":"50px"

            });

        }



    });*/

    jQuery('.ytcmore').html('READ ALL');

    setTimeout(function(){

        jQuery('table.uiGrid._51mz').css('display', 'none');

  

    }, 1600);



    jQuery.fn.center = function () {

        this.parent().css("position","absolute");

        var t = this.parent().css("top");

        var l = this.parent().css("left");

    

        this.css("position","absolute");

        this.css("top", ((this.parent().height() - this.outerHeight()) / 2) + this.parent().scrollTop() + "px");

        this.css("left", ((this.parent().width() - this.outerWidth()) / 2) + this.parent().scrollLeft() + "px");

        return this;

    }



    //jQuery('.col-sm-8 .feature_desc_wrpper').center();



    jQuery( ".hm_col_3_ul li" ).each(function() {

        jQuery(this).text(jQuery(this).text());

    });



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



    jQuery(".youtube").colorbox({

        iframe: true, 

        innerWidth: 640, 

        innerHeight: 390

    });

    jQuery('#news_share').click(function() {

        jQuery('.addthis_sharing_toolbox.art').slideToggle("slow");

    });

    jQuery('#news_share2').click(function() {

        jQuery('.addthis_sharing_toolbox.galo').slideToggle("slow");

    });



    jQuery(".news_video_image").click(function() {

        jQuery(".youtube").trigger("click");

    });



    //    jQuery("#searchTextField").click(function() {

    //        jQuery('#prod_filt').val('');

    //    });

    //    jQuery("#prod_filt").click(function() {

    //        jQuery('#searchTextField').val('');

    //    });



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

    equalHeight(jQuery(".EqHeightDiv1"));

    equalHeight(jQuery(".EqHeightDiv2"));





    jQuery(window).resize(function(){

        var wdt_w = jQuery(window).width();

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

        equalHeight(jQuery(".EqHeightDiv1"));

        if(wdt_w > '740px'){

            equalHeight(jQuery(".EqHeightDiv2"));  

        }

    });







    jQuery('.range-disoption .colicon').click(function() {

        jQuery(".current").removeClass("current");

        jQuery(this).addClass("current");

        jQuery('.results-items').css('height', 'auto');

        if(jQuery(this).hasClass('col1')){

            jQuery(".feature_desc_wrpper").css('height', 'auto');

            jQuery(".feature_desc_wrpper").css('min-height', 'auto');

            //            var childHeight1 = jQuery(".feature_desc_wrpper").height();

            //            var parentHeight1 = jQuery('.fl_rng').height();

            //    var height_sc1 = (parentHeight1 - childHeight1) / 2 ;

            jQuery('.feature_desc_wrpper').css('margin-top', '5.5%');

            

        }else{

            equalHeight(jQuery(".EqHeightDiv4"));

            jQuery('.feature_desc_wrpper').css('margin-top', '10px');

        }

    //       

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

                //                    equalHeight(jQuery(".EqHeightDiv"));

                } else {



                }

            }

        });

    });

    //    jQuery('.range-disoption.range_op .colicon.col4').click(function(e) {

    //        e.preventDefault();

    //        jQuery('#view_more_count').attr("data_count", "0");

    //        var price_value = jQuery('.product_price').val();

    //        var price_key = jQuery('#product_priceSelectBoxIt').attr('data_val');

    //        var length_value = jQuery('.product_length').val();

    //        var length_key = jQuery('#product_lengthSelectBoxIt').attr('data_val');

    //        var dealer_value = jQuery('.product_dealer').val();

    //        var dealer_key = jQuery('.product_dealer').attr('data_val');

    //        var product_category = jQuery('.product_category').val();

    ////      console.log(product_category);

    //        jQuery('.range-heroimg h1').text(product_category);

    //        jQuery.ajax({

    //            type: 'POST',

    //            url: wpdrm.ajaxurl,

    //            data: {

    //                pgnonce: wpdrm.PGNonce,

    //                'action': 'filter_price_4',

    //                'price_value': price_value,

    //                'price_key': price_key,

    //                'length_value': length_value,

    //                'length_key': length_key,

    //                'dealer_value': dealer_value,

    //                'dealer_key': dealer_key,

    //                'product_category': product_category

    //

    //            },

    //            beforeSend: function() {

    //

    //            },

    //            success: function(responce) {

    //                jQuery('.hide_load').show();

    //                if (responce) {

    //                    jQuery('.append_res').empty();

    //                    jQuery('.append_res').append(responce);

    //                    jQuery('.hide_load').hide();

    //                    equalHeight(jQuery(".EqHeightDiv"));

    //                } else {

    //

    //                }

    //            }

    //        });

    //    });

    //    jQuery('.range-disoption.range_op .colicon.col3').click(function(e) {

    //        e.preventDefault();

    //        jQuery('#view_more_count').attr("data_count", "0");

    //        var price_value = jQuery('.product_price').val();

    //        var price_key = jQuery('#product_priceSelectBoxIt').attr('data_val');

    //        var length_value = jQuery('.product_length').val();

    //        var length_key = jQuery('#product_lengthSelectBoxIt').attr('data_val');

    //        var dealer_value = jQuery('.product_dealer').val();

    //        var dealer_key = jQuery('.product_dealer').attr('data_val');

    //        var product_category = jQuery('.product_category').val();

    ////      console.log(product_category);

    //        jQuery('.range-heroimg h1').text(product_category);

    //        jQuery.ajax({

    //            type: 'POST',

    //            url: wpdrm.ajaxurl,

    //            data: {

    //                pgnonce: wpdrm.PGNonce,

    //                'action': 'filter_price_3',

    //                'price_value': price_value,

    //                'price_key': price_key,

    //                'length_value': length_value,

    //                'length_key': length_key,

    //                'dealer_value': dealer_value,

    //                'dealer_key': dealer_key,

    //                'product_category': product_category

    //

    //            },

    //            beforeSend: function() {

    //

    //            },

    //            success: function(responce) {

    //                jQuery('.hide_load').show();

    //                if (responce) {

    //                    jQuery('.append_res').empty();

    //                    jQuery('.append_res').append(responce);

    //                    jQuery('.hide_load').hide();

    //                    equalHeight(jQuery(".EqHeightDiv"));

    //                    jQuery('#view_more_count').attr("data_count", 0);

    //                } else {

    //

    //                }

    //            }

    //        });

    //    });

    jQuery('.fl_rng').removeClass('col-sm-8');

    jQuery('.range-disoption.range_op .colicon.col1').click(function(e) {

        e.preventDefault();

        jQuery('.fl_rng').addClass('col-sm-8');

        jQuery('.results-items').addClass('min_hh');

    //         jQuery('.results-items').removeClass('EqHeightDiv');

    //         jQuery('.results-items').css('height', 'auto');

    });

    jQuery('.range-disoption.range_op .colicon.col3').click(function(e) {

        e.preventDefault();

        jQuery('.results-items').removeClass('min_hh');

        jQuery('.fl_rng').removeClass('col-sm-8');

    //         jQuery('.results-items').addClass('EqHeightDiv');

    //         equalHeight(jQuery(".EqHeightDiv"));

    });

    jQuery('.range-disoption.range_op .colicon.col4').click(function(e) {

        e.preventDefault();

        jQuery('.fl_rng').removeClass('col-sm-8');

        jQuery('.results-items').removeClass('min_hh');

    //        jQuery('.results-items').addClass('EqHeightDiv');

    //          equalHeight(jQuery(".EqHeightDiv"));

    });

    //        jQuery('#view_more_count').attr("data_count", "0");

    //        var price_value = jQuery('.product_price').val();

    //        var price_key = jQuery('#product_priceSelectBoxIt').attr('data_val');

    //        var length_value = jQuery('.product_length').val();

    //        var length_key = jQuery('#product_lengthSelectBoxIt').attr('data_val');

    //        var dealer_value = jQuery('.product_dealer').val();

    //        var dealer_key = jQuery('.product_dealer').attr('data_val');

    //        var product_category = jQuery('.product_category').val();

    ////      console.log(product_category);

    //        jQuery('.range-heroimg h1').text(product_category);

    //        jQuery.ajax({

    //            type: 'POST',

    //            url: wpdrm.ajaxurl,

    //            data: {

    //                pgnonce: wpdrm.PGNonce,

    //                'action': 'filter_price_full',

    //                'price_value': price_value,

    //                'price_key': price_key,

    //                'length_value': length_value,

    //                'length_key': length_key,

    //                'dealer_value': dealer_value,

    //                'dealer_key': dealer_key,

    //                'product_category': product_category

    //

    //            },

    //            beforeSend: function() {

    //

    //            },

    //            success: function(responce) {

    //                jQuery('.hide_load').show();

    //                if (responce) {

    //                    jQuery('.append_res').empty();

    //                    jQuery('.append_res').append(responce);

    //                    jQuery('.hide_load').hide();

    //                    equalHeight(jQuery(".EqHeightDiv"));

    //                    jQuery('#view_more_count').attr("data_count", 0);

    //                } else {

    //

    //                }

    //            }

    //        });

    //    });



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



    //    jQuery('.range-disoption.upcome_opt .colicon.col4').click(function() {

    //        var product_count = 0;

    //        var ustae_value = jQuery('.upcoming_sate').val();

    //        var umoth_value = jQuery('.upcoming_months').val();

    //        jQuery.ajax({

    //            type: 'POST',

    //            url: wpdrm.ajaxurl,

    //            data: {

    //                pgnonce: wpdrm.PGNonce,

    //                'action': 'filter_up_4',

    //                'ustae_value': ustae_value,

    //                'umoth_value': umoth_value,

    //                'product_count': product_count

    //

    //            },

    //            beforeSend: function() {

    //

    //            },

    //            success: function(responce) {

    //                jQuery('.hide_load').show();

    //                if (responce) {

    //                    jQuery('.append_res').empty();

    //                    jQuery('.append_res').append(responce);

    //                    jQuery('.hide_load').hide();

    //                    jQuery('#view_more_count').attr("data_count", 0);

    //                    equalHeight(jQuery(".EqHeightDiv"));

    //                } else {

    //

    //                }

    //            }

    //        });

    //    });

    //    jQuery('.range-disoption.upcome_opt .colicon.col3').click(function() {

    //        var product_count = 0;

    //        var ustae_value = jQuery('.upcoming_sate').val();

    //        var umoth_value = jQuery('.upcoming_months').val();

    //        jQuery.ajax({

    //            type: 'POST',

    //            url: wpdrm.ajaxurl,

    //            data: {

    //                pgnonce: wpdrm.PGNonce,

    //                'action': 'filter_up_3',

    //                'ustae_value': ustae_value,

    //                'umoth_value': umoth_value,

    //                'product_count': product_count

    //

    //            },

    //            beforeSend: function() {

    //

    //            },

    //            success: function(responce) {

    //                jQuery('.hide_load').show();

    //                if (responce) {

    //                    jQuery('.append_res').empty();

    //                    jQuery('.append_res').append(responce);

    //                    jQuery('.hide_load').hide();

    //                    jQuery('#view_more_count').attr("data_count", 0);

    //                    equalHeight(jQuery(".EqHeightDiv"));

    //                } else {

    //

    //                }

    //            }

    //        });

    //    });



    //    jQuery('.range-disoption.upcome_opt .colicon.col1').click(function() {

    //        var product_count = 0;

    //        var ustae_value = jQuery('.upcoming_sate').val();

    //        var umoth_value = jQuery('.upcoming_months').val();

    //        jQuery.ajax({

    //            type: 'POST',

    //            url: wpdrm.ajaxurl,

    //            data: {

    //                pgnonce: wpdrm.PGNonce,

    //                'action': 'filter_up',

    //                'ustae_value': ustae_value,

    //                'umoth_value': umoth_value,

    //                'product_count': product_count

    //

    //            },

    //            beforeSend: function() {

    //

    //            },

    //            success: function(responce) {

    //                jQuery('.hide_load').show();

    //                if (responce) {

    //                    jQuery('.append_res').empty();

    //                    jQuery('.append_res').append(responce);

    //                    jQuery('.hide_load').hide();

    //                    jQuery('#view_more_count').attr("data_count", 0);

    //                    equalHeight(jQuery(".EqHeightDiv"));

    //                } else {

    //

    //                }

    //            }

    //        });

    //    });







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

            timeout: 172800,

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

                

                

                jQuery('.dl_ulli').live('click',function(event){

                    event.preventDefault() 

                    var lat = jQuery(this).attr('data-lat');

                    var lng = jQuery(this).attr('data-lang');      

                    jQuery.each(locations,function(index,marker){   

                        if(marker[1] == lat && marker[2] == lng){ 

                            google.maps.event.trigger(marker[9], 'click' );

                            return false;

                        }

                    });

                });

                

                

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

                jQuery("html, body").animate({

                    scrollTop: jQuery('.cont_frm').offset().top

                }, 1000);

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

                jQuery("html, body").animate({

                    scrollTop: jQuery('.cont_frm').offset().top

                }, 1000);

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

        jQuery.each(jQuery('input.input_val,select.input_val,textarea.input_val'), function() {

            if ((jQuery(this).val() === '') ) {

                jQuery(this).addClass('error').focus();

                has_error = true;

                console.log('iyyuyu');

                return false;

            } else if (!jQuery(this).val() ) {

                jQuery(this).addClass('error').focus();

                has_error = true;

                return false;

                console.log('dsjdshdgsd');

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

                jQuery("html, body").animate({

                    scrollTop: jQuery('.cont_frm').offset().top

                }, 1000);

            }

        }

        if (has_error) {

            return true;

        }

    });



    jQuery('.input_val').on('keyup', function() {

        if (jQuery(this).val() != '' || jQuery(this).find('option:selected').val() != '' || jQuery('#datepicker').datepicker().val() != '') {

            jQuery(this).removeClass('error');

            console.log('ttrrt');

        }

    });



    jQuery('.input_val').on('change', function() {

        //        console.log(jQuery(this).val());

        //        if (jQuery(this).val() || jQuery(this).val()!='') {

        jQuery(this).removeClass('error');

    //               console.log('yuyuy');

    //        }

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

    //jQuery(".index_scroller_dwn").click(function() {

    //    jQuery('html, body').animate({

    //        scrollTop: jQuery("#featured-products").offset().top

    //    }, 2000);

    //});

    jQuery('.upcoming-results .events_sec_main .append_res .items-right').last().removeClass('jscroll-next-parent');



    //jQuery('.upcome_opt .colicon.col3').click(function(){

    //   jQuery(this).parents.find('.upcoming_tb_row').removeClass('upcoming_tb_row'); 

    jQuery('.upcome_opt .colicon.col3').click(function(){

        jQuery(this).parents().find('.results-items').children().removeClass('upcoming_tb_row'); 

        jQuery(this).parents().find('.results-items .left-col').removeClass('upcoming_tb_left'); 

        jQuery(this).parents().find('.results-items .items-right').removeClass('upcoming_tb_right'); 

        jQuery('.upcoming_tb_right_iner').css('margin-top','20px');

    //  jQuery('.calendar').css('top','23px');

  

    });



    jQuery('.upcome_opt .colicon.col1').click(function(){

        jQuery(this).parents().find('.results-items').children().addClass('upcoming_tb_row'); 

        jQuery(this).parents().find('.results-items .left-col').addClass('upcoming_tb_left'); 

        jQuery(this).parents().find('.results-items .items-right').addClass('upcoming_tb_right'); 

        //   jQuery('.calendar').css('margin-top','-30px');

        //  jQuery('.calendar').css('top','unset');

        jQuery('.upcoming_tb_right_iner').css('margin-top','0px');

  

    });



    jQuery('.upcome_opt .colicon.col4').click(function(){

        jQuery(this).parents().find('.results-items').children().removeClass('upcoming_tb_row'); 

        jQuery(this).parents().find('.results-items .left-col').removeClass('upcoming_tb_left'); 

        jQuery(this).parents().find('.results-items .items-right').removeClass('upcoming_tb_right'); 

        //   jQuery('.calendar').css('margin-top','0');

        //  jQuery('.calendar').css('top','23px');

        jQuery('.upcoming_tb_right_iner').css('margin-top','20px');

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



jQuery(window).resize(function(){

    var newHeight2 = jQuery(window).height() -90;

    //console.log(newHeight);

    jQuery(".html * .ls-container img, body * .ls-container img, #ls-global * .ls-container img").css("height", newHeight2);

});