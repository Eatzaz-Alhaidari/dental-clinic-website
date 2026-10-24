/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/Filament/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        gold: {
          DEFAULT: '#D4AF37',
          light: '#F0DDA8',
          50: '#FDFBF7',
          100: '#FAF4E7',
          200: '#F0DDA8',
          300: '#E5C669',
          400: '#DCB848',
          500: '#D4AF37',
          600: '#B89326',
          700: '#8E7019',
          800: '#644E11',
          900: '#3D2F0A',
        },
        'gold-light': '#F0DDA8',
        cream: '#FFF9EC',
        brown: {
          DEFAULT: '#3B2A1E',
          50: '#F7F4F1',
          100: '#EBE3DC',
          200: '#D4C1B3',
          300: '#BC9F8A',
          400: '#A47D61',
          500: '#7B563B',
          600: '#5F402B',
          700: '#4D3423',
          800: '#3B2A1E',
          900: '#261A13',
        },
        orange: '#F39200',
      },
      fontFamily: {
        tajawal: ['Tajawal', 'Cairo', 'sans-serif'],
        cairo: ['Cairo', 'Tajawal', 'sans-serif'],
        sans: ['Tajawal', 'Cairo', 'system-ui', 'sans-serif'],
      },
      boxShadow: {
        'card': '0 4px 20px -2px rgba(59, 42, 30, 0.06), 0 2px 6px -1px rgba(59, 42, 30, 0.04)',
        'card-hover': '0 10px 25px -3px rgba(212, 175, 55, 0.15), 0 4px 10px -2px rgba(59, 42, 30, 0.08)',
      },
    },
  },
  plugins: [],
}
