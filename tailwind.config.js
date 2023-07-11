module.exports = {
    content: require('fast-glob').sync([
        'config.php',
        'commonmark.php',
        'source/**/*.{blade.php,blade.md,md,html,vue}',
        '!source/**/_tmp/*' // exclude temporary files
    ], {dot: true}),
    darkMode: 'media',
    theme: {
        extend: {},
        screens: {
            sm: '640px',
            md: '768px',
            lg: '1024px',
        },
    },
    plugins: [],
};
