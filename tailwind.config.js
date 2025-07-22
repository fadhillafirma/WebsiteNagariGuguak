/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        greenVill: '#DEE791',
        greenDark: '#004225',
        olive: '#034b2cff',
        khaki: '#dfd7abff',



        cream: '#F2F1EB'
      },
    },
  },
  plugins: [],
}
