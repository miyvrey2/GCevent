let mix = require('laravel-mix');

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
mix.setPublicPath('public_html/');
mix.js('resources/assets/js/app.js', 'js/app.js').version();
//mix.js('resources/assets/js/slider.js', 'js/slider.js');
mix.sass('resources/assets/sass/app.scss', 'css/').version();
mix.sass('resources/assets/sass/backend-app.scss', 'css/').version();
