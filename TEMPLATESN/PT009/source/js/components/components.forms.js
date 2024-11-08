/**
 * Forms
 */

// translation variables

if ($('html').attr('lang') == 'en-US') {

    var messages = {
        search: {
            required: 'Please enter a topic or question'
        },
        zipcode: {
            valid: '"Please enter a valid zip code"',
            required: 'Please enter your zip code'
        },
        over18: {
            valid: 'The person\'s age must be 18 or over',
            required: 'Please enter an age over 18'
        },
        over16: {
            valid: 'The person\'s age must be 16 or over',
            required: 'Please enter an age over 16'
        },
        under100: {
            valid: 'Please enter a valid date'
        },
        min19: {
            required: 'Please enter an age over 18'
        },
        date: {
            valid: 'Please enter a valid date'
        },
        address: {
            required: 'Please enter your zip code, city or state'
        },
        lastName: {
            required: 'Please enter your last name'
        },
        firstName: {
            required: 'Please enter your first name'
        },
        email: {
            required: 'Please enter your email'
        },
        phone: {
            required: 'Please enter your phone number',
            minlength: 'Please enter 10 digits',
            maxlength: 'Please enter 10 digits'
        },
        gender: {
            required: 'Please select your gender'
        },
        maritalStatus: {
            required: 'Please select your marital status'
        },
        city: {
            required: 'Please enter your city/state'
        },
        birth: {
            required: 'Please enter your date of birth'
        },
        licenseStatus: {
            required: 'Please enter your license status'
        },
        aptSuite: {
            required: 'Please enter your apt/suite'
        },
        yearExperience: {
            required: 'Please enter your years of driving experience'
        },
        numberIncidents: {
            required: 'Please select your number of incidents'
        },
        yearVehicle: {
            required: 'Please enter your vehicle year'
        },
        makeVehicle: {
            required: 'Please enter your vehicle make'
        },
        modelVehicle: {
            required: 'Please enter your vehicle model'
        },
        modificationVehicle: {
            required: 'Please enter your vehicle modification'
        },
        mileageVehicle: {
            required: 'Please enter your vehicle annual mileage'
        },
        useVehicle: {
            required: 'Please enter your vehicle use'
        },
        textarea: {
            required: 'Please enter your description of the issue'
        },
        select: {
            required: 'Please select an option'
        },
        required: {
            required: 'This field is required.'
        }
    };

} else if ($('html').attr('lang') == 'es-US') {


    $.extend($.validator.messages, {
        required: "Este campo es obligatorio.",
        remote: "Por favor, rellena este campo.",
        email: "Por favor, escribe una dirección de correo válida.",
        url: "Por favor, escribe una URL válida.",
        date: "Por favor, escribe una fecha válida.",
        dateISO: "Por favor, escribe una fecha (ISO) válida.",
        number: "Por favor, escribe un número válido.",
        digits: "Por favor, escribe sólo dígitos.",
        creditcard: "Por favor, escribe un número de tarjeta válido.",
        equalTo: "Por favor, escribe el mismo valor de nuevo.",
        extension: "Por favor, escribe un valor con una extensión aceptada.",
        maxlength: $.validator.format("Por favor, no escribas más de {0} caracteres."),
        minlength: $.validator.format("Por favor, no escribas menos de {0} caracteres."),
        rangelength: $.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
        range: $.validator.format("Por favor, escribe un valor entre {0} y {1}."),
        max: $.validator.format("Por favor, escribe un valor menor o igual a {0}."),
        min: $.validator.format("Por favor, escribe un valor mayor o igual a {0}."),
        nifES: "Por favor, escribe un NIF válido.",
        nieES: "Por favor, escribe un NIE válido.",
        cifES: "Por favor, escribe un CIF válido."
    });

    var messages = {
        search: {
            required: 'Por favor, ingrese un tema o pregunta'
        },
        zipcode: {
            valid: '"Por favor, ingrese un código postal válido"',
            required: 'Por favor, ingrese su código postal'
        },
        over18: {
            valid: 'La edad de la persona debe ser mayor a 18 años',
            required: 'Por favor, ingrese una edad mayor a 18'
        },
        over16: {
            valid: 'La edad de la persona debe ser mayor a 16 años',
            required: 'Por favor, ingrese una edad mayor a 16'
        },
        under100: {
            valid: 'Por favor, introduzca una fecha valida'
        },
        min19: {
            required: 'Por favor, ingrese una edad mayor a 18'
        },
        date: {
            valid: 'Por favor, introduzca una fecha valida'
        },
        address: {
            required: 'Por favor, ingrese su código postal, ciudad o estado'
        },
        lastName: {
            required: 'Por favor, introduzca su apellido'
        },
        firstName: {
            required: 'Por favor, introduzca su nombre'
        },
        email: {
            required: 'Por favor, introduzca su correo electrónico'
        },
        phone: {
            required: 'Por favor, introduzca su número de teléfono',
            minlength: 'Por favor, ingrese 10 dígitos',
            maxlength: 'Por favor, ingrese 10 dígitos'
        },
        gender: {
            required: 'Por favor, seleccione su género'
        },
        maritalStatus: {
            required: 'Por favor, seleccione su estado civil'
        },
        city: {
            required: 'Por favor, introduzca su ciudad / estado'
        },
        birth: {
            required: 'Por favor, introduzca su fecha de nacimiento'
        },
        licenseStatus: {
            required: 'Por favor, ingrese el estado de su licencia'
        },
        aptSuite: {
            required: 'Por favor, ingrese su apartamento / suite'
        },
        yearExperience: {
            required: 'Por favor, ingrese sus años de experiencia conduciendo'
        },
        numberIncidents: {
            required: 'Por favor, seleccione su número de incidentes'
        },
        yearVehicle: {
            required: 'Por favor, ingrese el año de su vehículo'
        },
        makeVehicle: {
            required: 'Por favor, ingrese la marca de su vehículo'
        },
        modelVehicle: {
            required: 'Por favor, ingrese el modelo de su vehículo'
        },
        modificationVehicle: {
            required: 'Por favor, ingrese la modificación de su vehículo'
        },
        mileageVehicle: {
            required: 'Por favor, ingrese el kilometraje anual de su vehículo'
        },
        useVehicle: {
            required: 'Por favor, ingrese el uso de su vehículo'
        },
        textarea: {
            required: 'Por favor, ingrese su descripción del problema'
        },
        select: {
            required: 'Por favor, selecciona una opción'
        }
    };
}

$(function () {

    if ($('.js-form').length) {
        $.validator.methods.email = function (value, element) {
            return this.optional(element) || /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\b$/i.test(value);
        };

        $.validator.addMethod('date', function (value, element) {
            return this.optional(element) || /^((0?[1-9])|1[012])\/(([0-2][0-9])|([1-9])|(3[0-1]))\/(19|20)[0-9]{2}$/.test(value);
        }, messages.date.valid);

        $.validator.addMethod('over18', function (value, element) {
            var splitUserDOB = value.split('/');
            var DOB = new Date(splitUserDOB[0] + '/' + splitUserDOB[1] + '/' + splitUserDOB[2]);
            currentDate = new Date();

            if (currentDate.getFullYear() - DOB.getFullYear() < 18) {
                return false;
            } else if (currentDate.getFullYear() - DOB.getFullYear() == 18) {
                if (currentDate.getMonth() < DOB.getMonth()) {
                    return false;
                } else if (currentDate.getMonth() == DOB.getMonth()) {
                    if (currentDate.getDate() < DOB.getDate()) {
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    return true;
                }
            } else {
                return true;
            }
        }, messages.over18.valid);

        $.validator.addMethod('over16', function (value, element) {
            var splitUserDOB = value.split('/');
            var DOB = new Date(splitUserDOB[0] + '/' + splitUserDOB[1] + '/' + splitUserDOB[2]);
            currentDate = new Date();
            if (currentDate.getFullYear() - DOB.getFullYear() < 16) {
                return false;
            } else if (currentDate.getFullYear() - DOB.getFullYear() == 16) {
                if (currentDate.getMonth() < DOB.getMonth()) {
                    return false;
                } else if (currentDate.getMonth() == DOB.getMonth()) {
                    if (currentDate.getDate() < DOB.getDate()) {
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    return true;
                }
            } else {
                return true;
            }
        }, messages.over16.valid);

        $.validator.addMethod('under100', function (value, element) {
            currentYear = new Date().getFullYear();
            value = currentYear - (value.substr(value.length - 4));
            if (value <= 100) {
                return true;
            } else {
                return false;
            }
        }, messages.under100.valid);

        $('.js-form').each(function () {
            $(this).validate({
                errorClass: 'js-form-error',
                validClass: 'js-form-valid',
                errorPlacement: function (error, element) {
                    if ($(element).hasClass('c-hero-form__radio-input')) {
                        $('.c-hero-form__radio-error').append(error);
                    } else if ($(element).hasClass('js-valid-checkboxes')){
                        $('.js-valid-checkboxes-error').append(error);
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form) {
                    //$('.js-submit-button').addClass('is-disabled');
                    //$('.js-submit-button img').show();
                    $(form).addClass('js-form--loading');
                    form.submit();
                }
            });
        });


        if ($('.c-hero-form__radio-input').length) {
            $('.c-hero-form__radio-input').rules('add', {
                required: true,
                messages: {
                    required: '* Please select a product to continue'
                }
            });
        }

        if ($('.js-valid-checkboxes').length) {
            $('.js-valid-checkboxes').rules('add', {
                required: true,
                messages: {
                    required: 'Please at least select one type of insurance'
                }
            });

        }

        if ($('.js-valid-zipcode').length) {
            $('.js-valid-zipcode').each(function (index, value) {
                $(this).rules('add', {
                    required: true,
                    minlength: 3,
                    maxlength: 5,
                    remote: {
                        url: 'https://www.confiejarvis.com/thor/javascript',
                        data: {
                            zipcode: function () {
                                return $(value).val();
                            }
                        },
                        dataFilter: function (data) {
                            if (data === "1") {
                                return '"true"';
                            }
                            return messages.zipcode.valid;
                        }
                    },
                    messages: {
                        required: messages.required.required
                    }
                });
            });
        }

        if ($('.js-valid-select').length) {
            $('.js-valid-select').each(function () {
                $(this).rules('add', {
                    messages: {
                        required: messages.select.required
                    }
                });
            });
        }

        if ($('.js-valid-marital-status').length) {
            $('.js-valid-marital-status').each(function () {
                $(this).rules('add', {
                    messages: {
                        required: messages.required.required
                    }
                });
            });
        }

        if ($('.js-valid-dob').length) {
            $('.js-valid-dob').each(function () {
                $(this).rules('add', {
                    date: true,
                    over16: true,
                    under100: true,
                    messages: {
                        required: messages.required.required
                    }
                });
            });
        }

        if ($('.js-valid-first-name').length) {
            $('.js-valid-first-name').each(function () {
                $(this).rules('add', {
                    required: true,
                    minlength: 2,
                    maxlength: 50,
                    messages: {
                        required: messages.required.required
                    }
                });
            });
        }

        if ($('.js-valid-last-name').length) {
            $('.js-valid-last-name').each(function () {
                $(this).rules('add', {
                    required: true,
                    minlength: 2,
                    maxlength: 50,
                    messages: {
                        required: messages.required.required
                    }
                });
            });
        }

        if ($('.js-valid-email').length) {
            $('.js-valid-email').each(function () {
                $(this).rules('add', {
                    required: true,
                    minlength: 3,
                    maxlength: 120,
                    messages: {
                        required: messages.required.required
                    }
                });
            });
        }

        if ($('.js-valid-phone').length) {
            $('.js-valid-phone').each(function () {
                $(this).rules('add', {
                    required: true,
                    minlength: 12,
                    maxlength: 12,
                    messages: {
                        required: messages.required.required,
                        minlength: messages.phone.minlength,
                        maxlength: messages.phone.maxlength
                    }
                });
            });
        }

        if ($('.js-valid-address').length) {
            $('.js-valid-address').each(function () {
                $(this).rules('add', {
                    required: true,
                    minlength: 2,
                    messages: {
                        required: messages.required.required
                    }
                });
            });
        }

        if ($('.js-valid-city').length) {
            $('.js-valid-city').each(function () {
                $(this).rules('add', {
                    required: true,
                    minlength: 2,
                    messages: {
                        required: messages.required.required
                    }
                });
            });
        }
        if ($('.js-valid-state').length) {
            $('.js-valid-state').each(function () {
                $(this).rules('add', {
                    required: true,
                    minlength: 2,
                    messages: {
                        required: messages.required.required
                    }
                });
            });
        }
        if ($('.js-valid-select').length) {
            $('.js-valid-select').each(function () {
                $(this).rules('add', {
                    required: true,
                    messages: {
                        required: messages.required.required
                    }
                });
            });
        }

        if ($('.js-valid-organization').length) {
            $('.js-valid-organization').each(function () {
                $(this).rules('add', {
                    required: true,
                    minlength: 2,
                    messages: {
                        required: messages.required.required
                    }
                });
            });
        }
        if ($('.js-valid-referred').length) {
            $('.js-valid-referred').each(function () {
                $(this).rules('add', {
                    required: true,
                    minlength: 2,
                    messages: {
                        required: messages.required.required
                    }
                });
            });
        }
        if ($('.js-valid-age').length) {
            $('.js-valid-age').each(function () {
                $(this).rules('add', {
                    required: true,
                    minlength: 2,
                    maxlength: 2,
                    min: 18,
                    max: 99,
                    messages: {
                        required: messages.required.required,
                        minlength: messages.over18.required,
                        maxlength: messages.over18.required,
                        min: messages.over18.required,
                        max: messages.over18.required
                    }
                });
            });
        }
    }
});
$(window).on('pageshow', function () {
    let formLoading = $('.js-form');

    if (formLoading.length) {
        formLoading.removeClass('js-form--loading');
    }
})