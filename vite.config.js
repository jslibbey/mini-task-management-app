import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { fileURLToPath, URL } from "url"

export const pathName = (path) => fileURLToPath(new URL(path, import.meta.url))

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue()
    ],
    resolve: {
        alias: {
            vue: "vue/dist/vue.esm-bundler.js",
            '@api': pathName("/resources/js/utils"),
            '@requests' : pathName("/resources/js/requests"),
            '@components' : pathName("/resources/js/components"),
        }
    }
});
