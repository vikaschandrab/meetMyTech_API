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

// Main application files
mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

// Page-specific CSS files
mix.postCss('resources/css/pages/dashboard.css', 'public/css/pages')
    .postCss('resources/css/pages/profile.css', 'public/css/pages')
    .postCss('resources/css/pages/experience.css', 'public/css/pages');

// Component CSS files
mix.postCss('resources/css/components/modals.css', 'public/css/components');

// Page-specific JS files
mix.js('resources/js/pages/dashboard.js', 'public/js/pages')
    .js('resources/js/pages/profile.js', 'public/js/pages')
    .js('resources/js/pages/experience.js', 'public/js/pages');

// Component JS files
mix.js('resources/js/components/modals.js', 'public/js/components');

// Enable versioning for cache busting in production
if (mix.inProduction()) {
    mix.version();
}
