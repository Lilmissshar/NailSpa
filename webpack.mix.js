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

mix.js('resources/assets/js/app/client.js', 'public/js')
	 .js('resources/assets/js/app/admin.js', 'public/js')
   .sass('resources/assets/sass/app/client.scss', 'public/css')
	 .sass('resources/assets/sass/app/admin.scss', 'public/css');

if (mix.inProduction()) {
  mix.version();
}
