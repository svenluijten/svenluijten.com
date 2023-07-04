const mix = require('laravel-mix');
require('laravel-mix-jigsaw');

mix.disableSuccessNotifications();
mix.setPublicPath('source/assets/build');

mix.jigsaw({
    watch: {
        dirs: ['app/*/']
    },
});

mix.jigsaw()
    .js('source/_assets/js/main.js', 'js')
    .css('source/_assets/css/main.css', 'css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .css('source/_assets/css/hljs-light.css', 'css', [
        require('postcss-import'),
    ])
    .css('source/_assets/css/hljs-dark.css', 'css', [
        require('postcss-import'),
    ])
    .options({
        processCssUrls: false,
    })
    .version();
