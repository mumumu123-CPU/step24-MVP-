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
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                //　割とスタンダードな緑
                'brand-100' : '#E9F2A7',
                'brand-200' : '#E4F279',
                'brand-300' : '#CFF250',
                'brand-400' : '#98D90D',
                'brand-500' : '#55A603',
                
                // 暗め、フォレスト系
                'green-forest': '#4D7343',
                'green-olive': '#618C56',
                'green-leaf': '#7AA66D',
                'green-mist': '#AFBFAA',
                'green-moss': '#415936',

                // 明るめ、パステル系な緑
                'lime-punch': '#B5F230',
                'lemon-zing': '#ECF22E',
                'lemon-milk': '#EFF285',
                'vanilla-haze': '#F0F2B3',
                'cloud-white': '#F2F2F2',
            },
        },
    },

    plugins: [forms],
};
