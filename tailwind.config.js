/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
      ],
  theme: {
    colors: {
        'primary': '#352F44',
        'secondary': '#5C5470',
        'tertiary': '#B9B4C7',
        'light': '#FAF0E6',
    },
    extend: {},
  },
  plugins: [],
}

