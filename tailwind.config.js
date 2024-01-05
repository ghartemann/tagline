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
        },
    },
    plugins: [],
};
