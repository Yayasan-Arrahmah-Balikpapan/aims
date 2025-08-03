<template>
    <button
        v-if="showButton"
        @click="handleInstall"
        class="mt-4 w-full bg-blue-500 text-white py-2 rounded"
    >
        Install Aplikasi
    </button>
</template>

<script>
export default {
    name: "PwaInstallButton",
    data() {
        return {
            deferredPrompt: null,
            showButton: false,
        }
    },
    mounted() {
        const self = this;

        // Simpan event beforeinstallprompt
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            self.deferredPrompt = e;
            self.showButton = true;
        });

        // Listen for app installation
        window.addEventListener('appinstalled', () => {
            console.log('App was installed');
            window.location.href = '/dashboard';
        });

        // Register service worker
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/build/sw.js')
                    .then(() => console.log('ServiceWorker registration successful'))
                    .catch(err => console.log('ServiceWorker registration failed: ', err));
            });
        }

        // Cek jika aplikasi sudah diinstall
        window.addEventListener('load', () => {
            if (window.matchMedia('(display-mode: standalone)').matches) {
                console.log('Running in standalone mode');
                self.showButton = false;
            }
        });
    },
    methods: {
        async handleInstall() {
            if (!this.deferredPrompt) return;

            this.deferredPrompt.prompt();

            const { outcome } = await this.deferredPrompt.userChoice;
            if (outcome === 'accepted') {
                console.log('User accepted the install prompt');
            } else {
                console.log('User dismissed the install prompt');
            }

            this.deferredPrompt = null;
            this.showButton = false;
        }
    }
}
</script>
