import $ from './jquery-3.6.0.min'

const form = $('#cookie-form');

form.on('submit', (event) => {
    event.preventDefault();

    const data = {
        _token: $('input[name="_token"]').val(),
        number: $('input[name="int"]').val(),
    };

    $.ajax({
        url: "/test/add-cookie",
        method: "POST",
        data,
    }).done((response) => {
        console.log('response', response);
    }).fail((error) => {
        console.log('error', error);
    })
})
