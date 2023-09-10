const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                headings: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors:
                {
                    'olive': {
                        DEFAULT: '#34372E',
                        '50': '#B9BEB1',
                        '100': '#AFB4A6',
                        '200': '#9CA28F',
                        '300': '#888F79',
                        '400': '#737A66',
                        '500': '#5E6353',
                        '600': '#494D41',
                        '700': '#34372E',
                        '800': '#171814',
                        '900': '#000000'
                    },
                    'apple': {
                        DEFAULT: '#53B748',
                        '50': '#CFEBCC',
                        '100': '#C1E5BD',
                        '200': '#A6DAA0',
                        '300': '#8ACE83',
                        '400': '#6FC365',
                        '500': '#53B748',
                        '600': '#418F38',
                        '700': '#2E6628',
                        '800': '#1C3E18',
                        '900': '#0A1609'
                    },
                }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
