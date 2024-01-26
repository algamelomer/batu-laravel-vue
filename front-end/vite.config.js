import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [
        vue(),
    ],
    resolve: {
        alias: {
            '@fortawesome/vue-fontawesome': '@fortawesome/vue-fontawesome',

            '@': fileURLToPath(new URL('./src',
                import.meta.url))
        }
    }
})