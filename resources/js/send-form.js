import $ from './jquery-3.6.0.min'

const form = $('.js-send-form');
const button = $('.js-send-form button');
const showNewCookie = (number) => $('.php').text('Cookie: test php cookie = ' + number);

form.on('submit', (event) => {
    event.preventDefault();

    button.prop('disabled', true);

    const data = form.serializeArray();

    $.ajax({
        url: form.attr('action'),
        method: "POST",
        data,
    }).done(() => {
        button.prop('disabled', false);

        $.ajax('/test/get-cookie').done((cookieNumber) => showNewCookie(cookieNumber));
    }).fail((error) => {
        button.prop('disabled', false);

        console.log('error', error);
    })
});
