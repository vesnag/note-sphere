import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                gray: {
                    100: '#f0f0f0',
                    200: '#e0e0e0',
                    300: '#d1d1d1',
                    400: '#bdbdbd',
                    500: '#a8a8a8',
                    600: '#7d7d7d',
                    700: '#555555',
                    800: '#2D2D2D',
                    900: '#1a1a1a',
                },
                lavenderPurple: '#9151b0',
                lightPink: '#cb90d2',
                deepLavender: '#7260c3',
                royalPurple: '#6930a1',
                brightMagenta: '#8f49bb',
                softPink: '#efa1cb',
                darkPurple: '#863591',
                violet: '#623eaa',
                rosePink: '#f774aa',
                deepRed: '#8f2968',
                darkRed: '#98254c',
                white: '#FFFFFF',
            },
        },
    },

    plugins: [forms],
};
