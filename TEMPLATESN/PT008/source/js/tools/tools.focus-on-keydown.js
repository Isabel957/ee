/**
 * Focus on keydown
 */

var keyboardNavigation = false;

$(document).on('keydown', function (e) {
    if (e.key == 'Tab') {
        $('body').addClass('is-keyboard-pressed');
        keyboardNavigation = true;
    }
});

$(document).on('click mousedown', function (e) {
    var $target = $(e.target);
    if ($target.is(':radio, :checkbox, :button, a[href="#"]')) {
        if (keyboardNavigation == false) {
            $('body').removeClass('is-keyboard-pressed');
            keyboardNavigation = false;
        } 
    } else {
        $('body').removeClass('is-keyboard-pressed');
        keyboardNavigation = false;
    }
});
$('input[type=radio], input[type=checkbox], button[type="button"], a[href="#"]').on('keydown', function (e) {
    $('body').addClass('is-keyboard-pressed');
    keyboardNavigation = true;
}); 