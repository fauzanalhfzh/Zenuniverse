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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                display: ['Lexend', 'sans-serif'],
            },
            colors: {
                "primary": "#13ec5b",
                "primary-dark": "#0ea842",
                "background-light": "#f6f8f6",
                "background-dark": "#102216",
                "card-light": "#ffffff",
                "card-dark": "#1c3024",
                "gray-750": "#2d3748", // Custom dark gray
            },
        },
    },

    plugins: [forms],
};
