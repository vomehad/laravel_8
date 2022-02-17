import $ from './jquery-3.6.0.min'

const getCookieUrl = '/test/get-cookie';
const form = $('.js-send-form');
const button = $('.js-send-form button');
const inputHourly = $('.js-send-form input[name="numberHourly"]');
const inputForever = $('.js-send-form input[name="numberForever"]');
const messageHourly = $('.cookie_hourly');
const messageForever = $('.cookie_forever');
const showNewCookie = (numbers) => {
    const {cookie_hourly, cookie_forever} = numbers;

    if (cookie_hourly) {
        messageHourly.text(`Cookie set by 1 hour is "${cookie_hourly.toString()}"`);
    }
    if (cookie_forever) {
        messageForever.text(`Cookie set forever is "${cookie_forever.toString()}"`);
    }

    cleanForm();
    button.prop('disabled', false);
}
const alertErrorMessages = (json) => {
    if (!json.hasOwnProperty('errors')) {
        return
    }

    Object.keys(json.errors).forEach((input) => {
        if (input === 'numberHourly') {
            inputHourly.addClass('border-danger');
            messageHourly.removeClass('alert-success').addClass('alert-danger');
            messageHourly.text(json.errors[input].shift());
        }

        if (input === 'numberForever') {
            inputForever.addClass('border-danger');
            messageForever.removeClass('alert-success').addClass('alert-danger');
            messageForever.text(json.errors[input].shift());
        }
    });

    button.prop('disabled', false);
}
const cleanForm = () => {
    form[0].reset();
    inputHourly.removeClass('border-danger');
    inputForever.removeClass('border-danger');
    messageHourly.removeClass('alert-danger').addClass('alert-success');
    messageForever.removeClass('alert-danger').addClass('alert-success');
}

form.on('submit', (event) => {
    event.preventDefault();
    button.prop('disabled', true);

    const data = form.serializeArray();

    $.ajax({url: form.attr('action'), method: "POST", data})
        .done(() => $.ajax(getCookieUrl).done((cookies) => showNewCookie(cookies)))
        .fail((error) => alertErrorMessages(error.responseJSON));
});

inputHourly.on('input', () => {
    if (messageHourly.hasClass('alert-danger')) {
        inputHourly.removeClass('border-danger');
        messageHourly.removeClass('alert-danger').addClass('alert-success');
        messageHourly.text(' ');
    }
});

inputForever.on('input', () => {
    if (messageForever.hasClass('alert-danger')) {
        inputForever.removeClass('border-danger');
        messageForever.removeClass('alert-danger').addClass('alert-success');
        messageForever.text(' ');
    }
});

cleanForm();
