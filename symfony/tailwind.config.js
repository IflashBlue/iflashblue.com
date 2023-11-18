/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./assets/**/*.js",
        "./templates/**/*.html.twig",
        "./node_modules/tw-elements/dist/js/**/*.js"
    ],
    plugins: [
        require("@tailwindcss/forms"),
        require("tw-elements/dist/plugin.cjs"),
    ],
}
