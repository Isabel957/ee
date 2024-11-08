var links = $('a[href^="#"]:not(.has-dropdown)');
var siteHeader = $('.c-site-header');
var urlPage = window.location.href;
var idLink = $('#'+urlPage.split('#')[1]);


if (links.length) {
    $('.o-wrapper-body').on('click', 'a[href^="#"]:not(.has-dropdown)', function () {
        var targetLink = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(targetLink).offset().top - siteHeader.outerHeight() - 10
        });
    });
}

if (idLink.length) {
    $(window).on('load', function () {
        $('html, body').animate({
            scrollTop: idLink.offset().top - siteHeader.outerHeight() - 10
        });
    });
}