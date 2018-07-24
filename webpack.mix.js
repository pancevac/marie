let mix = require('laravel-mix');
require('dotenv').config();

const DEFAULT_PROXY_ULR = 'localhost/';
const proxy_url = process.env.BROWSERSYNC_PROXY_URL || DEFAULT_PROXY_ULR;

mix.browserSync({
  proxy: proxy_url,
  files: [
    'resources/**/*.*',
  ],
  notify: false,
});

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

// webpack.mix.js
mix.autoload({
    'jquery': ['$', 'window.jQuery', 'jQuery'],
    'vue': ['Vue','window.Vue'],
    'moment': ['moment','window.moment'],
});

mix.options({
    processCssUrls: false // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
});

// server side.
mix.js('resources/assets/js/app.js', 'public/js')  

// client side.
mix.js('resources/assets/client/scripts/main.js', 'public/client/scripts')
  .extract(['vue']);

// style bundler.
mix.sass('resources/assets/sass/app.scss', 'public/css')
.sass('resources/assets/client/styles/main.scss', 'public/client/styles');
