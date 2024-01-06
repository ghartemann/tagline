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
                'azulero-dark': "#1F009C"
            }
        }
    },
    plugins: [],
};
