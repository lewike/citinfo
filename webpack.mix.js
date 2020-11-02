const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/admin.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css');

mix.js('resources/js/website.js', 'public/js')
    .sass('resources/sass/website.scss', 'public/css');

mix.js('resources/js/wed.js', 'public/js')
    .sass('resources/sass/wed.scss', 'public/css');

mix.combine(['./node_modules/blueimp-file-upload/js/vendor/jquery.ui.widget.js', './node_modules/blueimp-file-upload/js/jquery.iframe-transport.js', './node_modules/blueimp-file-upload/js/jquery.fileupload.js'], 'public/js/uploadfile.js');


if (mix.inProduction()) {
    mix.version();
}

mix.browserSync('citinfo.test');
