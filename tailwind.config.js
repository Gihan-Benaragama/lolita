import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*.php',
    ],

    theme: {
        extend: {
            colors: {
                ivory: '#FDFBF7',
                wine: '#4A1521',
                rose: '#C86D7C',
                ink: '#2C2224',
                sage: '#7A8B7B',
            },
            fontFamily: {
                sans: ['Jost', ...defaultTheme.fontFamily.sans],
                display: ['Cormorant Garamond', 'serif'],
            },
        },
    },

    plugins: [forms],
};
