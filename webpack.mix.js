const mix = require('laravel-mix');
const publicDir = 'public';

mix.setPublicPath(publicDir + '/');

mix.js('resources/js/app.js', 'js')
    .js('resources/js/portfolio.js', 'js')
    .js('resources/js/blog.js', 'js')
    .js('resources/js/main.js', 'js')
    .js('resources/js/custom.js', 'js')
    .sass('resources/sass/app.scss', 'css')
    .sass('resources/sass/bootstrap.scss', 'css');

mix.scripts([
    'public/js/app.js',
    'public/js/tpl/js/particles.js',
    'public/js/tpl/js/owl.carousel.min.js',
    'public/js/tpl/js/lazyload.min.js',
    'public/js/custom.js'
], 'public/js/combine.js');

mix.styles([
    'public/css/bootstrap.css',
    'public/css/app.css'
], 'public/css/combine.css');

mix.options({
    cssNano: {
        discardComments: {
            removeAll: true
        }
    }
});

mix.version();
