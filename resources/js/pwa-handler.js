// Simpan event beforeinstallprompt
let deferredPrompt;
const installButton = document.getElementById('installPWA');

window.addEventListener('beforeinstallprompt', (e) => {
    // Prevent the mini-infobar from appearing on mobile
    e.preventDefault();
    // Stash the event so it can be triggered later
    deferredPrompt = e;

    // Tampilkan tombol install
    if (installButton) {
        installButton.style.display = 'block';
    }
});

// Handle klik tombol install
if (installButton) {
    installButton.addEventListener('click', async () => {
        if (!deferredPrompt) return;

        // Tampilkan prompt install
        deferredPrompt.prompt();

        // Tunggu user memilih
        const { outcome } = await deferredPrompt.userChoice;

        if (outcome === 'accepted') {
            console.log('User accepted the install prompt');
        } else {
            console.log('User dismissed the install prompt');
        }

        // Reset deferredPrompt
        deferredPrompt = null;

        // Sembunyikan tombol
        installButton.style.display = 'none';
    });
}

// Listen for app installation
window.addEventListener('appinstalled', (event) => {
    console.log('App was installed');
    // Redirect to dashboard after installation
    window.location.href = '/dashboard';
});

// Register service worker
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').then(registration => {
            console.log('ServiceWorker registration successful');
        }).catch(err => {
            console.log('ServiceWorker registration failed: ', err);
        });
    });
}

// Cek jika aplikasi sudah diinstall
window.addEventListener('load', () => {
    if (window.matchMedia('(display-mode: standalone)').matches) {
        console.log('Running in standalone mode');
        if (installButton) {
            installButton.style.display = 'none';
        }
    }
});
