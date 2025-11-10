import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: 'media',
    theme: {
        extend: {
            fontFamily: {
                system: ['Manrope', 'Figtree', ...defaultTheme.fontFamily.sans],
                text: ['Newsreader', ...defaultTheme.fontFamily.serif],
                heading: ['Archivo Narrow', 'sans-serif'],
            },
            colors: {
                primary: '#627254',
                primaryLight: '#76885B',
                secondary: '#ECA013',
                tertiary: '#FAF1DD',
                ...defaultTheme.colors,
            },
        },
        screens: {
            sm: '640px',
            md: '768px',
            lg: '1024px',
        },
        container: {
            center: true
        }
    },
    plugins: [],
};
