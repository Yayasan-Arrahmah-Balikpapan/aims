<template>
    <div v-if="showButton" class="relative p-2 max-w-md mx-auto">
        <div class="relative p-4 bg-white rounded-lg shadow">
            <div class="mb-4 text-sm font-light text-gray-500">
                <h3 class="mb-3 text-2xl font-bold text-gray-900">Pasang Aplikasi</h3>
                <p>
                    Aplikasi AIMS - <i>Arrahmah Integrated Management System</i>
                </p>
            </div>
            <div class="justify-between items-center pt-0 space-y-2 sm:flex sm:space-y-0">
                <a href="#" class="font-medium text-xs text-primary-600 hover:underline">
                    Petunjuk Pemasangan
                </a>
                <div class="items-center space-y-4 sm:space-x-4 sm:flex sm:space-y-0">
                    <button
                        type="button"
                        @click="handleInstall"
                        class="py-2 px-4 w-full text-sm font-medium text-center text-white rounded-lg bg-primary-700 sm:w-auto hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300"
                    >
                        <i>Install</i> Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
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
