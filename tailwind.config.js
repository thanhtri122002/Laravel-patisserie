import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/sass/**/*.scss'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            screens: {       // Extra small (mobile)
                'sm': '576px',     // Small (mobile)
                'md': '768px',     // Medium (tablet)
                'lg': '992px',     // Large (desktop)
                'xl': '1200px',    // Extra large (large desktop)
                'xxl': '1400px', 
            },

            fontSize: {
                
            },

            
        },
    },

    plugins: [forms],
};
