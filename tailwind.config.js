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
                sans: ['"Noto Sans JP"', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                //　メイン配色
                'brand-500' : '#98D996',

                //　以下、メイン配色補欠
                'brand-100' : '#E9F2A7',
                'brand-200' : '#E4F279',
                'brand-300' : '#CFF250',
                'brand-400' : '#98D90D',
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

                //　管理者用メイン
                'blue-soft-100' : '#63A1F2',
                'blue-soft-200' : '#056CF2',

                //　管理者用補欠
                'sky-500 ' : '#3D9DD9',
                'sky-400' : '#55B3D9',
                'aqua-300 ': '#5EF2F2',
                'sky-700' : '#2477BF',
                'aqua-400 ' : '#41CAD9',
                'abyss-400' : '#4B75F2',
                'abyss-300' : '#B6C5F2',
                'abyss-200' : '#456EBF',
            
            },
        },
    },

    plugins: [forms],
};
