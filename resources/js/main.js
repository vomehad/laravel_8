import $ from './jquery-3.6.0.min';

const deleteButton = $('.js-delete');
const route = deleteButton.attr('href');

$.ajax({url: route, method: "DELETE"});
