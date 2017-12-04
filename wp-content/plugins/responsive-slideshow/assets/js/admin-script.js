jQuery( document ).ready(function() {
    jQuery("#caption_bg_colour").spectrum({
        showAlpha:true,
        showInput: false,
        preferredFormat: "rgb",
        move: function(c) {
        jQuery(this).val(c.toRgbString())
        }
    });
    jQuery("#caption_font_colour").spectrum({
        showAlpha:true,
        showInput: false,
        preferredFormat: "rgb",
        move: function(c) {
        jQuery(this).val(c.toRgbString())
          }
    });
});