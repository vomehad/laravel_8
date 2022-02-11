$('.js-ajax-send-form').on('submit', (event) => {
    event.preventDefault();

    const number = $('#int').val();
console.log(number)
    $.post({
        url: "/test/add-cookie",
        data: {
            "_token": "{{ csrf_token() }}",
            number
        },
        success: (response) => {
            console.log(response);
        },
        error: (error) => {
            console.log(error);
        }
    })
})
