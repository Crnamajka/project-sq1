import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        fontFamily: {
            sans: ['Roboto', 'sans-serif'],
            poppins: ['Poppins', 'sans-serif'],
            volkhov: ['Volkhov', 'serif'],
            jost: ['Jost', 'sans-serif'],
        },
        extend: {
            colors: {
                black: '#191919',
                primary: '#ED1C24',
                panel: {
                    DEFAULT: 'rgba(50, 51, 52, 1)',
                    back: '#dbd0cc',
                    first: 'rgba(168, 106, 61, 1)',
                    second: 'rgba(50, 51, 52, 1)'
                },
            },
            screens: {
                'xs': '375px'
            },
            keyframes: {
                "full-tl": {
                    "0%": { transform: "translateX(0)" },
                    "100%": { transform: "translateX(-100%)" },
                },
                "full-tr": {
                    "0%": { transform: "translateX(0)" },
                    "100%": { transform: "translateX(100%)" },
                },
            },
            animation: {
                "full-tl": "full-tl 25s linear infinite",
                "full-tr": "full-tr 25s linear infinite",
            },
        },
    },

    plugins: [forms],

    safelist:[
        "bg-red-500",
        "bg-orange-500",
        "bg-yellow-500",
        "bg-green-500",
        "bg-blue-500",
        "bg-purple-500",
        "bg-pink-500"
    ]
};
