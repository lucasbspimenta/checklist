module.exports = {
    purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    fontSize: {
        'xs': '.65rem',
        'sm': '.75rem',
        'base': '.875rem',
        'md': '.875rem',
         'lg': '1rem',
         'lgg': '1.125rem',
         'xl': '1.25rem',
         '2xl': '1.5rem',
        '3xl': '1.875rem',
        '4xl': '2.25rem',
         '5xl': '3rem',
         '6xl': '4rem',
        '7xl': '5rem',
       },
    fontFamily: {
        sans: ['Helvetica','helveticaregularregular', 'Arial', 'sans-serif'],
        serif: ['serif'],
        'futura': ['Futura-lt-book'],
        'futurabold': ['Futura-lt-bold'],
      },
    extend: {
        colors: {
            'caixaAzul': 'rgb(0,92,169)',
            'caixaLaranja': 'rgb(243,146,0)',
            'caixaTurquesa': 'rgb(84,187,171)',
            'caixaCinza': 'rgb(208,224,227)',
            'caixaCeu': 'rgb(0,181,229)',
            'caixaUva': 'rgb(178,111,155)',
            'caixaLimao': 'rgb(175,202,11)',
            'caixaTangerina': 'rgb(249,176,0)',
            'caixaGoiaba': 'rgb(239,118,94)',
          }
    },
  },
  variants: {
    display: ['responsive', 'group-hover', 'group-focus'],
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
