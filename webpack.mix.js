const mix = require('laravel-mix');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .extract(['tui-calendar', 'moment', 'jquery','pikaday','datatables','jquery-modal','fullcalendar','magnific-popup'])
    .postCss('resources/css/app.css', 'public/css', [
        require("@tailwindcss/jit"),
    ]);

mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');

//mix.browserSync('localhost:8000');

