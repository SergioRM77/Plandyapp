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
  variants: {
    scrollbar: ['rounded']
},
  theme: {
    container: {
      center: true,
      padding: '2rem',
    },
    borderRadius: {
      'none': '0',
      'sm': '0.125rem',
      DEFAULT: '0.25rem',
      DEFAULT: '4px',
      'md': '0.375rem',
      'lg': '0.5rem',
      'full': '9999px',
      'large': '12px',
    },
    extend: {

    },
  },
  plugins: [
    require("daisyui"),
    require('tailwind-scrollbar')({ nocompatible: true }),
  ],
}