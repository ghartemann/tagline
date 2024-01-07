/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./assets/**/*.js",
        "./assets/**/*.vue",
        "./templates/**/*.html.twig",
    ],
    prefix: "tw-",
    theme: {
        extend: {
            fontFamily: {
                viga: ['Viga', 'Arial'],
            },
            colors: {
                lemony: "#FCFF5B",
                azulero: "#451FDF",
                'azulero-dark': "#1F009C",
                'azulero-darker': "#1b007c",
                rose: "#FFE8FD",
                'rose-dark': "#FFD6FB",
                'rose-darker': "#FFA2F6"
            }
        }
    },
    plugins: [],
};
