let modalQuoteButton = $('.js-modal-products-open');
let modalQuote = $('.js-products-modal');
let modalQuoteClose = $('.js-modal-products-close');
let modalQuoteOverlay = $('.js-products-modal-overlay');

function openModalQuote() {
    $(this).attr('aria-expanded', 'true');
    modalQuote.addClass('is-open');
    modalQuote.show();
    modalQuoteClose.attr('aria-expanded', 'true');
    trapFocus(modalQuote);
}

function closeModalQuote() {
    modalQuoteButton.attr('aria-expanded', 'false');
    modalQuote.removeClass('is-open');
    modalQuote.hide();
    modalQuoteClose.attr('aria-expanded', 'false');
    unTrapFocus();
}

if (modalQuoteButton.length) {
    modalQuoteButton.on('click', openModalQuote);
    modalQuoteClose.on('click', closeModalQuote);
    modalQuoteOverlay.on('click', closeModalQuote);

    $(document).on('keydown', function (e) {
        if (e.key == 'Escape') {
            closeModalQuote();
        }
    });


}