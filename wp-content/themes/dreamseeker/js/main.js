var step = 25;
var scrolling = false;
/*product page*/
var step2 = 130;
var scrolling2 = false;

$(document).ready(function(){
    $(".carousel-indicators li:first").addClass("active");
    $(".carousel-inner .item:first").addClass("active");
    $('.carousel').carousel({
        interval: 1000 * 10
    })

    //auto scroll on find a dealer page

    jQuery(".searched-for").bind("click", function(event) {
        event.preventDefault();
        // Animates the scrollTop property by the specified
        // step.
        jQuery("#dvPanel2").animate({
            scrollTop: "+=" + step + "px"
        });
        
    }).bind("mouseover", function(event) {
        scrolling = true;
        scrollContent("down");
    }).bind("mouseout", function(event) {
        scrolling = false;
    });

    /*jQuery(".dealer_tab_main").bind("click", function(event) {
    event.preventDefault();
    // Animates the scrollTop property by the specified
    // step.
    jQuery("#dvPanel2").animate({
        scrollTop: "-=" + step + "px"
    });
}).bind("mouseover", function(event) {
    scrolling = true;
    scrollContent("up");
}).bind("mouseout", function(event) {
    scrolling = false;
});*/

    //auto scroll on a product page

    jQuery(".down_dealers_arrw").bind("click", function(event) {
        event.preventDefault();
        // Animates the scrollTop property by the specified
        // step.
        jQuery(".all_cmpny_info").animate({
            scrollTop: "+=" + step2 + "px"
        });
        
    }).bind("mouseover", function(event) {
        scrolling2 = true;
        scrollContentP("down");
    }).bind("mouseout", function(event) {
        scrolling2 = false;
    });
    jQuery(".up_dealers_arrw").bind("click", function(event) {
        event.preventDefault();
        // Animates the scrollTop property by the specified
        // step.
        jQuery(".all_cmpny_info").animate({
            scrollTop: "-=" + step2 + "px"
        });
        
    }).bind("mouseover", function(event) {
        scrolling2 = true;
        scrollContentP("up");
    }).bind("mouseout", function(event) {
        scrolling2 = false;
    });
    
    jQuery(function()
    {
        jQuery('.all_cmpny_info').jScrollPane({
            showArrows: true
        });
    });


});

/* find a dealer */
function scrollContent(direction) {
    var amount = (direction === "up" ? "-=1px" : "+=1px");
    jQuery("#dvPanel2").animate({
        scrollTop: amount
    }, 1, function() {
        if (scrolling) {
            scrollContent(direction);
        }
    });
}
/* product page */
function scrollContentP(direction) {
    var amount = (direction === "up" ? "-=1px" : "+=1px");
    jQuery(".all_cmpny_info").animate({
        scrollTop: amount
    }, 1, function() {
        if (scrolling2) {
            scrollContentP(direction);
        }
    });
}

$(document).ready(function () {  
    if(jQuery(window).width() <= 480){
        $('.product-slider').bxSlider({
            minSlides: 1,
            maxSlides: 12,
            slideWidth: 530,
            slideMargin: 0,
            //        slideMargin: 10,
            infiniteLoop: false,
            autoHidePager: true
        });
    }else{
        $('.product-slider').bxSlider({
            minSlides: 3,
            maxSlides: 12,
            slideWidth: 530,
            slideMargin: 0,
            //        slideMargin: 10,
            infiniteLoop: false,
            autoHidePager: true
        });
    }
    
    
    var owl = $("#owl-demo");
    $(".owl-pre-g").click(function(){
        owl.trigger('owl.prev');
    });
    $(".owl-nex-g").click(function(){
        owl.trigger('owl.next');
    });        

    $(function() {
        var header = $(".navbar-top");
        var secodheader = $(".second-navbar");
    
        $(window).scroll(function() {    
            var scroll = $(window).scrollTop();
        
            if (scroll >= 300) {
                header.addClass("short-nav");
                secodheader.addClass("short-nav-second");
                
            } else {
                header.removeClass("short-nav");
                secodheader.removeClass("short-nav-second");
            }
        });
    });

    $('.col3').on('click', function () {
        /* Product Range View Change */
        $('.range-results .results-items').removeClass('col-sm-12');
        $('.range-results .results-items').removeClass('col-sm-3');
        $('.range-results .left-col').removeClass('col-sm-4');
        $('.range-results .results-items').addClass('col-sm-4');
        
        /* Upcoming View Change */
        $('.upcoming-results .results-items').removeClass('col-sm-12 col-sm-3');
        $('.upcoming-results .results-items').addClass('col-sm-4');
        $('.upcoming-results .left-col').removeClass('col-sm-6 col-md-4');
        $('.upcoming-results .left-col').addClass('col-sm-12');
        $('.upcoming-results .items-right').removeClass('col-sm-6');
    });
    
    
    $('.col4').on('click', function () {
        /* Product Range View Change */
        $('.range-results .results-items').removeClass('col-sm-12 col-sm-4');
        $('.range-results .results-items').addClass('col-sm-3');
        $('.range-results .left-col').removeClass('col-sm-4');
        
        /* Upcoming View Change */
        $('.upcoming-results .results-items').removeClass('col-sm-12 col-sm-4');
        $('.upcoming-results .results-items').addClass('col-sm-3');
        $('.upcoming-results .left-col').removeClass('col-sm-6 col-md-4');
        $('.upcoming-results .left-col').addClass('col-sm-12');
        $('.upcoming-results .items-right').removeClass('col-sm-6');
    });
    
    $('.col1').on('click', function () {
        /* Product Range View Change */
        $('.range-results .results-items').removeClass('col-sm-3 col-sm-4');
        $('.range-results .results-items').addClass('col-sm-12');
        $('.range-results .left-col').addClass('col-sm-4');
        
        /* Upcoming View Change */
        $('.upcoming-results .results-items').removeClass('col-sm-3 col-sm-4');
        $('.upcoming-results .results-items').addClass('col-sm-12');
        $('.upcoming-results .left-col').addClass('col-sm-6 col-md-4');
        $('.upcoming-results .left-col').removeClass('col-sm-12');
    });
    
    $('.direction-toggle').on('click', function () {
        $(this).toggleClass("closedp");
        $('#leftp').toggleClass("col-md-4 hide");
        $('#rightp').toggleClass("col-md-8 col-md-12");
        google.maps.event.trigger(map, "resize");
    });
    
    $('.scroll').jscroll({
        autoTrigger: false
    });
    
    $(".searchclear").click(function () {
        $(".form-control").val('');
    });
    
    
    
    /* Scroll to top */
    var offset = 300,
    offset_opacity = 1200,
    scroll_top_duration = 700,
    $back_to_top = $('.cd-top');
    $(window).scroll(function () {
        ($(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
        if( $(this).scrollTop() > offset_opacity ) { 
            $back_to_top.addClass('cd-fade-out');
        }
    });
    $back_to_top.on('click', function(event){
        event.preventDefault();
        $('body,html').animate({
            scrollTop: 0 ,
        }, scroll_top_duration
        );
    });

});

$(function() {

    var selectBox = $(".select_style").selectBoxIt(
    {
        downArrowIcon:"dropdownicon"
    }
    );
    var selectBox = $(".select_style1").selectBoxIt(
    {
        downArrowIcon:"dropdownicon",
        defaultText: "Sample text here"
    }
    );
    var selectBox = $(".select_style2").selectBoxIt(
    {
        downArrowIcon:"dropdownicon",
        defaultText: "Model Name"
    }
    );
    var selectBox = $(".select_style3").selectBoxIt(
    {
        downArrowIcon:"dropdownicon",
        defaultText: "Model Type"
    }
    );
    var selectBox = $(".select_style4").selectBoxIt(
    {
        downArrowIcon:"dropdownicon",
        defaultText: "Dealership"
    }
    );
    var selectBox = $(".claim_product").selectBoxIt(
    {
        downArrowIcon:"dropdownicon",
    //       defaultText: "Model Name"
    }
    );
    var selectBox = $(".claim_model").selectBoxIt(
    {
        downArrowIcon:"dropdownicon",
    //       defaultText: "Model Type"
    }
    );
    var selectBox = $(".claim_dealer").selectBoxIt(
    {
        downArrowIcon:"dropdownicon",
    //       defaultText: "Model Type"
    }
    );
    var selectBox = $(".hereus1").selectBoxIt(
    {
        downArrowIcon:"dropdownicon"
    }
    );
    var selectBox = $(".hereus2").selectBoxIt(
    {
        downArrowIcon:"dropdownicon"
    }
    );
    
});

//$("#hereus").selectBoxIt({
//    defaultText: "Sample text here",
//    downArrowIcon:"dropdownicon"
//});
//$("#hereus").selectBoxIt({
//    defaultText: "Sample text here",
//    downArrowIcon:"dropdownicon"
//});
//$("#mname").selectBoxIt({
//    defaultText: "Model Name",
//    downArrowIcon:"dropdownicon"
//});
//$("#mnumber").selectBoxIt({
//    defaultText: "Model Type",
//    downArrowIcon:"dropdownicon"
//});

/* Slow Scroll */
$(function() {
    $('#wonderpluginslider-container-1').append('<div class="scroll-down scroll-slow"><a href="#featured-products">scroll down <i class="fa fa-angle-down"></i></a></div>');   
    $('.scroll-slow a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top-120
                }, 1000);
                //console.log(top);
                return false;
            }
        }
    });
});

/* Bootstrap Light Box */
$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
}); 