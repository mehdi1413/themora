import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'

import tailwindcss from '@tailwindcss/vite'


// https://vite.dev/config/
export default defineConfig({
  plugins: [
      vue(),
    tailwindcss()
  ],
  resolve:{
    alias:{
      '@':path.resolve(__dirname,'./src')
    }
  },

  build: {
    outDir: '../dist/',
    emptyOutDir: true,
    chunkSizeWarningLimit: 1600,

    rolldownOptions:{
      output: {
        format: 'es',
        entryFileNames: 'assets/[name].js',
        chunkFileNames: 'assets/[name].js',
        assetFileNames: 'assets/[name].[ext]',
      }
    }
  }
})
