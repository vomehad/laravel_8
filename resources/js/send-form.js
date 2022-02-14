import $ from './jquery-3.6.0.min'

const form = $('#cookie-form');

form.on('submit', (event) => {
    event.preventDefault();

    const number = $('#int').val();
    console.log(number);

    $.ajax({
        url: "/test/add-cookie",
        method: "POST",
        data: {
            // "_token": "{{ csrf_token() }}",
            number
        },
        success: (response) => {
            console.log(response);
        },
        fail: (error) => {
            console.log(error);
        }
    })
})
