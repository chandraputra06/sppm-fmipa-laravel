import tailwindcss from 'tailwindcss'
import tailwindcssPostcss from '@tailwindcss/postcss'
import autoprefixer from 'autoprefixer'

export default {
  plugins: [
    tailwindcssPostcss(), // BUKAN tailwindcss() lagi
    autoprefixer,
  ],
}
