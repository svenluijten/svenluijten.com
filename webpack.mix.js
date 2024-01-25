const mix = require('laravel-mix');
require('laravel-mix-jigsaw');

mix.disableSuccessNotifications();
mix.setPublicPath('source/assets/build');

mix.jigsaw({
    watch: {
        dirs: ['app/*/'],
        files: ['config.php', 'commonmark.php'],
    },
});

mix.jigsaw()
    .js('source/_assets/js/hljs.js', 'js')
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
