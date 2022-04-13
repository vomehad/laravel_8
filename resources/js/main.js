import $ from './jquery-3.6.0.min';

const deleteButton = $('.js-delete');
const route = deleteButton.attr('href');

deleteButton.on('click', (e) => {
    e.preventDefault();
    $.ajax({url: route, method: "DELETE"})
        .done(() => {console.log('deleted')});
});
