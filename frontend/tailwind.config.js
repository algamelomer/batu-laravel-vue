/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./index.html",
        "./src/**/*.{vue,js,ts,jsx,tsx}",
    ],
    theme: {
        extend: {
            colors: {
                primary_green: "#1B4A4B",
                main_title: "#2E6B6B",
                card_gray: "#EDF0F8",
                gray_text: "#AEB1B5",
                par: "#99D9DB"
            },
            fontFamily: {
                mulish: ['Mulish', 'sans-serif'],
            },
            animation: {
                loading_bar: "bluebar 1.5s infinite ease",
            },
            keyframes: {
                bluebar: {
                    '0%': {
                        left: '0%',
                    },
                    '50%': {
                        left: '100%',
                    },
                    '100%': {
                        left: '0%',
                    },
                },
            },
        },
    },
    plugins: [],
};