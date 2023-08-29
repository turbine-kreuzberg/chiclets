/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
  ],
  theme: {
    extend: {
        spacing: {
            '0': '0',
            '0.5em': '0.5em',
            '1em': '1em',
            '2em': '2em',
        }
    },
  },
  plugins: [],
}

