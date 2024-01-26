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
            },
            fontFamily: {
                mulish: ['Mulish', 'sans-serif'],
            },
        },
    },
    plugins: [],
}