/** 
 * Trap focus
 */


const htmlTag = $('html');
var lastFocused, focusedActivator;

function trapFocus(elem) {
    let tabbable = $(elem).find('select, input, textarea, button, a').filter(':visible');

    let firstTabbable = tabbable.first();
    let lastTabbable = tabbable.last();
    /*set focus on first input*/
    setTimeout(function () {
        firstTabbable[0].focus();
    }, 200);

    htmlTag.addClass('no-scroll');


    /*redirect last tab to first input*/

    lastTabbable.on('keydown', function (e) {
        if ((e.key === 'Tab' && !e.shiftKey)) {
            e.preventDefault();
            firstTabbable[0].focus();
        }
    });

    /*redirect first shift+tab to last input*/
    firstTabbable.on('keydown', function (e) {
        if ((e.key === 'Tab' && e.shiftKey)) {
            e.preventDefault();
            lastTabbable[0].focus();
        }
    });

    focusedActivator = lastFocused;
}

function unTrapFocus() {
    setTimeout(function () {

        focusedActivator.focus();
    }, 200);
    htmlTag.removeClass('no-scroll');
    //console.log(focusedActivator);

}

$('[aria-controls]').on('focus', function () {
    lastFocused = $(this);
    //console.log(lastFocused);
});