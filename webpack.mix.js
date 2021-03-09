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

mix.js('resources/js/app.js', 'public/js/app.js')
    .sass('resources/sass/app.scss', 'public/css/app.css')

    .js('resources/js/custom.js', 'public/js/custom.js')
    .sass('resources/sass/custom.scss', 'public/css/custom.css')

    .sourceMaps(true, 'source-map')
    .options({
        processCssUrls: false
    });

mix.browserSync({
    proxy: 'localhost',
    port: 8000
});
