jQuery('.carousel').carousel();

jQuery(document).ready(function(){
  
    jQuery('.product-slider').bxSlider({
        minSlides: 1,
        maxSlides: 12,
        slideWidth: 300,
        slideMargin: 10,
        infiniteLoop: false,
        autoHidePager: true
    });
     
      
    jQuery('.col3').on('click', function () {
        /* Product Range View Change */
        jQuery('.range-results .results-items').removeClass('col-sm-12');
        jQuery('.range-results .results-items').removeClass('col-sm-3');
        jQuery('.range-results .left-col').removeClass('col-sm-4');
        jQuery('.range-results .results-items').addClass('col-sm-4');
        
        /* Upcoming View Change */
        jQuery('.upcoming-results .results-items').removeClass('col-sm-12 col-sm-3');
        jQuery('.upcoming-results .results-items').addClass('col-sm-4');
        jQuery('.upcoming-results .left-col').removeClass('col-sm-6 col-md-4');
        jQuery('.upcoming-results .left-col').addClass('col-sm-12');
        jQuery('.upcoming-results .items-right').removeClass('col-sm-6');
    });
    
    
    
    
    jQuery('.col4').on('click', function () {
        /* Product Range View Change */
        jQuery('.range-results .results-items').removeClass('col-sm-12 col-sm-4');
        jQuery('.range-results .results-items').addClass('col-sm-3');
        jQuery('.range-results .left-col').removeClass('col-sm-4');
        
        /* Upcoming View Change */
        jQuery('.upcoming-results .results-items').removeClass('col-sm-12 col-sm-4');
        jQuery('.upcoming-results .results-items').addClass('col-sm-3');
        jQuery('.upcoming-results .left-col').removeClass('col-sm-6 col-md-4');
        jQuery('.upcoming-results .left-col').addClass('col-sm-12');
        jQuery('.upcoming-results .items-right').removeClass('col-sm-6'); 
    });   
    
    jQuery('.col1').on('click', function () {
        /* Product Range View Change */
        jQuery('.range-results .results-items').removeClass('col-sm-3 col-sm-4');
        jQuery('.range-results .results-items').addClass('col-sm-12');
        jQuery('.range-results .left-col').addClass('col-sm-4');
        
        /* Upcoming View Change */
        jQuery('.upcoming-results .results-items').removeClass('col-sm-3 col-sm-4');
        jQuery('.upcoming-results .results-items').addClass('col-sm-12');
        jQuery('.upcoming-results .left-col').addClass('col-sm-6 col-md-4');
        jQuery('.upcoming-results .left-col').removeClass('col-sm-12');
    });
    
    jQuery('.scroll').jscroll({
        autoTrigger: false
    });
    
    jQuery(".searchclear").click(function(){
        jQuery(".form-control").val('');
    });
    
      
    window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')
    
});

jQuery(function() {

  var selectBox = jQuery("select").selectBoxIt(
      {downArrowIcon:"dropdownicon"}
  );
    
});
if(jQuery("#hereus").length > 0){
jQuery("#hereus").selectBoxIt({
    defaultText: "Sample text here",
    downArrowIcon:"dropdownicon"
});
}
if(jQuery("#mname").length > 0){
jQuery("#mname").selectBoxIt({
    defaultText: "Model Name",
    downArrowIcon:"dropdownicon"
});
}

if(jQuery("#mnumber").length > 0){
jQuery("#mnumber").selectBoxIt({
    defaultText: "Model Type",
    downArrowIcon:"dropdownicon"
});
}