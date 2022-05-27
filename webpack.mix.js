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

const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss'); /* Add this line at the top */

mix.js('resources/js/app.js', 'public/js').vue()
    .sass('resources/sass/app.scss', 'public/css')
    .postCss("resources/css/app.css", "public/css", [
        require("tailwindcss"),
    ])
    // .options({
//     postCss: [tailwindcss('./tailwind.config.js')],
// })
    .version();

// mix.js("resources/js/app.js", "public/js")
//     .postCss("resources/css/app.css", "public/css", [
//         require("tailwindcss"),
//     ]);
// .options({
//     postCss: [tailwindcss('./tailwind.config.js')],
// })
// .version();
