/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  daisyui: {
    themes: [false],
  },
  theme: {
    container: {
      center: true,
      padding: '2rem',
    },
    extend: {

    },
  },
  plugins: [require("daisyui")],
}