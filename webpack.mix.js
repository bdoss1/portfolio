const mix = require('laravel-mix');
const publicDir = 'public';

mix.setPublicPath(publicDir + '/');

mix.js('resources/js/app.js', 'js')
    .sass('resources/sass/app.scss', 'css');

mix.version();
