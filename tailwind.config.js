const colors = require('tailwindcss/colors');

module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        teal: colors.teal,
        indigo: colors.indigo,
        orange: colors.orange,
        yellow: colors.yellow,
        purple: colors.purple,
        red: colors.red,
        green: colors.green,
        blue: colors.blue,
        gray: colors.gray,
        fuchsia: colors.fuchsia,
      },
    },
  },
  plugins: [],
}
