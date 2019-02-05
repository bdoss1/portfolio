const mix = require('laravel-mix');
const publicDir = 'public';

mix.setPublicPath(publicDir + '/');

mix.js('resources/js/app.js', 'js')
    .js('resources/js/portfolio.js', 'js')
    .js('resources/js/blog.js', 'js')
    .js('resources/js/main.js', 'js')
    .js('resources/js/custom.js', 'js')
    .sass('resources/sass/app.scss', 'css');

mix.scripts([
    'public/js/tpl/cubeportfolio/js/jquery.cubeportfolio.min.js',
    'public/js/tpl/js/typed.js',
    'public/js/tpl/js/particles.js',
    'public/js/tpl/js/jquery.hover3d.js',
    'public/js/tpl/js/owl.carousel.min.js',
    'public/js/tpl/js/lazyload.min.js',
    'public/js/custom.js'
], 'public/js/combine.js');

mix.version();
