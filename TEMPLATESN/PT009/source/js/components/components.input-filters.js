/**
 * Filter inputs
 */

$(function () {

    if ($('.js-only-numbers').length) {
        $('.js-only-numbers').each(function () {
            setInputFilter(this, function (value) {
                return /^[0-9]*$/.test(value);
            });
        });
    }
    if ($('.js-only-letters').length) {
        $('.js-only-letters').each(function () {
            setInputFilter(this, function (value) {
                return /^[a-zA-ZáéíóúÁÉÍÓÚ\'´ñÑäëïöüÄËÏÖÜ \-]*$/.test(value);
            });
        });
    }
    if ($('.js-only-alpha-numeric').length) {
        $('.js-only-alpha-numeric').each(function () {
            setInputFilter(this, function (value) {
                return /^[0-9a-zA-Z]*$/.test(value);
            });
        });
    }
    if ($('.js-only-phone').length) {
        $('.js-only-phone').each(function () {
            setInputFilter(this, function (value) {
                return /^[0-9\-]*$/.test(value);
            });
        });
        $('.js-only-phone').mask('000-000-0000');
    }
    if ($('.js-only-date').length) {
        $('.js-only-date').each(function () {
            setInputFilter(this, function (value) {
                return /^[0-9\/]*$/.test(value);
            });
        });
        $('.js-only-date').mask('99/99/0000');
    }
});