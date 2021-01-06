const darkmode = require('tailwindcss-dark-mode');

module.exports = {
  theme: {
    extend: {
      screens: {
        "print": {"raw": "print"},
      }
    }
  },
  variants: {
    backgroundColor: ['dark', 'dark-hover', 'dark-group-hover', 'dark-even', 'dark-odd'],
    borderColor: ['dark', 'dark-disabled', 'dark-focus', 'dark-focus-within'],
    textColor: ['dark', 'dark-hover', 'dark-active', 'dark-placeholder']
  },
  plugins: [
      darkmode()
  ]
}
