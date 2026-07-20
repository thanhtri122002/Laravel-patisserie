import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/sass/**/*.scss',
        './resources/js/**/*.jsx',
    ],

    theme: {
        extend: {
            fontFamily: {
                mer: ['var(--merriweather-sans)', 'sans-serif']
            },
            fontSize :{
                'h1': ['3rem', {lineHeight: '1.2', letterSpacing: '-0.02rem', fontWeight: '900', }],
                'h2': ['2.5rem', {lineHeight: '1.25',letterSpacing: '-0.015rem', fontWeight: '700', }],
                'h3': ['2rem', {lineHeight: '1.3',letterSpacing: '-0.01rem', fontWeight: '700', }],
                'body': ['1rem', {lineHeight: '1.5',letterSpacing: '0rem', fontWeight: '400', }],
                'emphasized': ['1.125rem', {lineHeight: '1.4', letterSpacing: '0.005rem',fontWeight: '700', }],
                },

            screens: {       // Extra small (mobile)
                'sm': '576px',     // Small (mobile)
                'md': '768px',     // Medium (tablet)
                'lg': '992px',     // Large (desktop)
                'xl': '1200px',    // Extra large (large desktop)
                'xxl': '1400px', 
            },            
        },
    },

    plugins: [forms],
};
