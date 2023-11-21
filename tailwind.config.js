/** @type {import('tailwindcss').Config} */
export default {
  content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
      ],
  theme: {
    // colors: { OVERWRIDE DEFAULT COLOURS
    //     'primary': '#352F44',
    //     'secondary': '#5C5470',
    //     'secondarylighter': '#6e6585',
    //     'tertiary': '#B9B4C7',
    //     'light': '#FAF0E6',
    //     'white': '#FFF'
    // },
  extend: {
    colors: {
        'primary': '#352F44',
        'secondary': '#5C5470',
        'secondarylighter': '#6e6585',
        'tertiary': '#B9B4C7',
        'light': '#FAF0E6',
        'white': '#FFF'
    }
  },
  },
  plugins: [],
}

