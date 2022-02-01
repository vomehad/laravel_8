const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/css/scss/app.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [])
    .version();
