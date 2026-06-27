import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', 'Figtree', ...defaultTheme.fontFamily.sans],
                serif: ['Merriweather', 'Georgia', ...defaultTheme.fontFamily.serif],
                heading: ['Poppins', 'Figtree', ...defaultTheme.fontFamily.sans],
                body: ['Merriweather', 'Georgia', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                vnn: {
                    red: '#8B0000',
                    'red-dark': '#5C0000',
                    'red-light': '#B22222',
                    navy: '#1a1a2e',
                    dark: '#1a1a1a',
                    'dark-light': '#2d2d2d',
                    gray: '#f5f5f5',
                    'gray-dark': '#e8e8e8',
                },
            },
        },
    },

    plugins: [forms],
};
