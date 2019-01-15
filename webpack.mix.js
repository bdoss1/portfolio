const mix = require('laravel-mix');
const publicDir = 'public';

mix.setPublicPath(publicDir + '/');

mix.js('resources/js/app.js', 'js')
    .js('resources/js/custom.js', 'js')
    .sass('resources/sass/app.scss', 'css')
    .sass('resources/sass/custom.scss', 'css');

mix.copyDirectory('resources/template/css', publicDir + '/template/css');
mix.copyDirectory('resources/template/cubeportfolio', publicDir + '/template/cubeportfolio');
mix.copyDirectory('resources/template/fontawesome', publicDir + '/template/fontawesome');
mix.copyDirectory('resources/template/images', publicDir + '/template/images');
mix.copyDirectory('resources/template/js', publicDir + '/template/js');

mix.styles([
    publicDir + '/css/app.css',
    publicDir + '/template/cubeportfolio/css/cubeportfolio.min.css',
    publicDir + '/template/css/colors/red.css',
    publicDir + '/template/css/style.css',
    publicDir + '/template/fontawesome/css/all.css',
    publicDir + '/css/custom.css',
], publicDir + '/css/combine.css');

mix.scripts([
    publicDir + '/js/app.js',
    publicDir + '/template/cubeportfolio/js/jquery.cubeportfolio.min.js',
    publicDir + '/template/js/typed.js',
    publicDir + '/template/js/particles.js',
    publicDir + '/template/js/app.js',
    publicDir + '/template/js/jquery.hover3d.js',
    publicDir + '/template/js/main.js',
    publicDir + '/js/custom.js'
], publicDir + '/js/combine.js');

mix.version();
