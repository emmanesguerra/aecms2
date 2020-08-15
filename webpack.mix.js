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

/*
 * CORE Layout
 */
mix.js('core/Layouts/assets/js/app.js', 'public/js/admin')
    .sass('core/Layouts/assets/sass/app.scss', 'public/css/admin');