const mix = require('laravel-mix');
// webpack.mix.js
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
