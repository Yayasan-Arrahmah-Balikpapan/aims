import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import VueDevTools from 'vite-plugin-vue-devtools';
import { VitePWA } from 'vite-plugin-pwa';

export default defineConfig({
    plugins: [
        laravel({
            input: "resources/js/app.js",
            ssr: "resources/js/ssr.js",
            refresh: true,
        }),
         VitePWA({
            registerType: 'autoUpdate',
            includeAssets: ['favicon.png', 'logo-yayasan-192.png', 'logo-yayasan-512.png'],
            manifest: {
                name: 'Arrahmah Integrated Management System',
                short_name: 'Arrahmah AIMS',
                start_url: '/dashboard',
                display: 'standalone',
                background_color: '#ffffff',
                description: 'Manajemen Sistem Yayasan Arrahmah Balikpapan',
                theme_color: '#ffffff',
                icons: [
                    {
                        src: '/logo-yayasan-192.png',
                        sizes: '192x192',
                        type: 'image/png',
                    },
                    {
                        src: '/logo-yayasan-512.png',
                        sizes: '512x512',
                        type: 'image/png',
                    },
                    {
                        src: '/logo-yayasan-512.png',
                        sizes: '512x512',
                        type: 'image/png',
                        purpose: 'any maskable',
                    }
                ],
            },
            workbox: {
                navigateFallback: '/',
                globPatterns: ['**/*.{js,css,html,ico,png,svg}'],
            },
            devOptions: {
                enabled: true,
                type: 'module',
                navigateFallback: '/',
            },
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        VueDevTools(),
    ],
    ssr: {
        noExternal: ["vue", "@protonemedia/laravel-splade"]
    },
});
