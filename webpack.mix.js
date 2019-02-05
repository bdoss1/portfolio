const mix = require('laravel-mix');
const publicDir = 'public';

mix.setPublicPath(publicDir + '/');

mix.js('resources/js/app.js', 'js')
    .js('resources/js/portfolio.js', 'js')
    .js('resources/js/blog.js', 'js')
    .js('resources/js/main.js', 'js')
    .sass('resources/sass/app.scss', 'css');

mix.version();
