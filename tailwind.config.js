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
                azulejo: "#451FDF",
                'azulejo-dark': "#1F009C",
                'azulejo-darker': "#1b007c",
                rose: "#FFE8FD",
                'rose-dark': "#FFD6FB",
                'rose-darker': "#ff6ff3"
            }
        }
    },
    plugins: [],
};
