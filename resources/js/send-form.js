import $ from './jquery-3.6.0.min'

const getCookieUrl = '/test/get-cookie';
const contentBlock = $('.test-content');
const splitForm = $('#split-form');
const textForm = $('#text-form');

// function
const showNewCookie = (numbers, form) => {
    for (const [className, value] of Object.entries(numbers)) {
        let period = '';

        if (className === 'cookie_hourly') {
            period = 'by 1 hour';
        }

        if (className === 'cookie_forever') {
            period = 'forever';
        }

        $(`.js-cookies .${className}`).text(`Cookie set ${period} is "${value.toString()}"`);
    }

    cleanForm(form);
    form.children('button').prop('disabled', false);
};
const alertErrorMessages = (json, form) => {
    if (!json.hasOwnProperty('errors')) {
        return;
    }

    Object.keys(json.errors).forEach((inputName) => {
        const message = json.errors[inputName].shift();
        let messageClass;

        if (inputName === 'numberHourly') {
            messageClass = 'cookie_hourly';
        }
        if (inputName === 'numberForever') {
            messageClass = 'cookie_forever';
        }

        showErrors(message, form, inputName, messageClass);
    });

    form.children('button').prop('disabled', false);
};
const showErrors = (errorMessage, form, inputName, messageClass) => {
    const message = contentBlock.find(`div.${messageClass}`);
    const input = form.find(`input[name="${inputName}"]`);

    form.find(`input[name="${inputName}"]`).addClass('border-danger');
    message.removeClass('alert-success').addClass('alert-danger');
    message.text(errorMessage);

    input.on('input', () => restore(input, message));
};
const cleanForm = (form) => {
    form[0].reset();

    form.find('.border-danger').removeClass('border-danger');
    $('.test-content__cookie').each(function() {
        $(this).removeClass('alert-danger').addClass('alert-success');
    });
};
const restore = (input, message) => {
    if (message.hasClass('alert-danger')) {
        message.removeClass('alert-danger').addClass('alert-success');
        message.text(' ');
    }

    input.removeClass('border-danger');
};

// ----------- cookie form ---------------------------------

const cookieForm = contentBlock.find('form#cookie-form');

cookieForm.on('submit', (event) => {
    event.preventDefault();
    cookieForm.children('button').prop('disabled', true);

    $.ajax({url: cookieForm.attr('action'), method: "POST", data: cookieForm.serializeArray()})
        .done(() => $.ajax(getCookieUrl).done((cookies) => showNewCookie(cookies, cookieForm)))
        .fail((error) => alertErrorMessages(error.responseJSON, cookieForm));
});
