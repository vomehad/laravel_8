const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js/')
    .js('resources/js/find-pairs.js', 'public/js/')
    .sass('resources/css/scss/app.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [])
    .version()
    .sourceMaps();

if (mix.inProduction()) {
    mix.minify();
}

mix.browserSync('http://backend.family.local/');
