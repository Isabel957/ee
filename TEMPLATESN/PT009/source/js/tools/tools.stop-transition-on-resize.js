/**
 * Site Header
 */

var resizeTimer;

jQuery(function() {
    jQuery(window).on('resize', function() {
        jQuery('body').addClass('u-resize-animation-stopper');
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            jQuery('body').removeClass('u-resize-animation-stopper');
        }, 400);
    });

});