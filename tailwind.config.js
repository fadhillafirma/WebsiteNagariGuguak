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
        greenOlive: '#a6b14aff',

        greenDark: '#004225',

        green1: '#04b569ff',
        green2: '#35e79aff',
        green3: '#DEE791',




        olive: '#034b2cff',
        khaki: '#dfd7abff',



        cream: '#F2F1EB'
      },
      keyframes: {
        spinSlow: {
          '0%': { transform: 'rotate(0deg)' },
          '100%': { transform: 'rotate(360deg)' },
        },
      },
      animation: {
        spinSlow: 'spinSlow 8s linear infinite',
      },
    },
  },
  plugins: [],
}
