import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import flowbite from "flowbite/plugin";

/** @type {import('tailwindcss').Config} */
export default {
     presets: [ 
        require('./vendor/tallstackui/tallstackui/tailwind.config.js') 
    ],
    darkMode: 'media', // ou 'media' si tu veux que ça suive les préférences système
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
         "./node_modules/flowbite/**/*.js",
        './vendor/tallstackui/tallstackui/src/**/*.php', 
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#1E40AF',
                secondary: '#9333EA',
            },
        },
    },

    plugins: [forms, typography, flowbite],
};
