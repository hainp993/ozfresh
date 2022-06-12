const mix = require('laravel-mix');
// const MonacoWebpackPlugin = require('monaco-editor-webpack-plugin');
const NodePolyfillPlugin = require("node-polyfill-webpack-plugin")

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


mix.js('resources/js/admin/start.js', 'public/js/admin.js')
    .webpackConfig({
        resolve: {
            fallback: {
                "fs": false
            },
        },
        plugins: [
            new NodePolyfillPlugin(),
            // new MonacoWebpackPlugin({
            //     languages: ['handlebars', 'html'],
            //     features: ['accessibilityHelp', 'anchorSelect', 'bracketMatching', 'caretOperations', 'folding', 'format'],
            //     globalAPI: true,
            // }),
        ],
    })
    .react()
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        legacyNodePolyfills: true,
        watchOptions: {
            ignored: /node_modules/
        },
        processCssUrls: false
    }).sourceMaps(false);


