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
        fontFamily: {
            sans: 'Montserrat, montserrat, "Source Sans", "Helvetica Neue", "Helvetica", "Arial Black", Arial, sans-serif',
            serif: '"Source Serif 4", "Lucida Serif", Georgia, serif',
            mono: '"JetBrains Mono", Courier, monospace',
        },
        container: {
            center: true
        }
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
};
