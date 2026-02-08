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
                sans: ['Fredoka', 'Figtree', ...defaultTheme.fontFamily.sans],
                display: ['Fredoka', 'Lexend', 'sans-serif'],
            },
            colors: {
                "primary": "#ff8a3d",
                "secondary": "#6366f1",
                "sky-base": "#e0f2fe",
                "soft-text": "#334155",
                "sky-blue": "#e0f2fe",
                "soft-white": "#ffffff",
                "accent-orange": "#ff8a3d",
                "cloud-white": "#f8fafc",
                "planet-purple": "#c084fc",
                "planet-green": "#4ade80",
                "primary-dark": "#0ea842",
                "background-light": "#f6f8f6",
                "background-dark": "#102216",
                "card-light": "#ffffff",
                "card-dark": "#1c3024",
                "gray-750": "#2d3748", // Custom dark gray
            },
            borderRadius: {
                "lg": "2.5rem",
                "xl": "4rem",
            },
        },
    },

    plugins: [forms],
};
