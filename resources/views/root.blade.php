<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.png') }}">

    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" href="{{ asset('logo-yayasan-512.png') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    {{-- <x-splade-script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/serviceworker.js')
            .then((reg) => console.log('Service Worker Registered', reg))
            .catch((err) => console.log('SW Registration Failed', err));
    }
    </x-splade-script>

    <x-splade-script>
    let deferredPrompt;
    const installBtn = document.getElementById('installBtn');

    // Simpan event sebelum install prompt
    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;
        installBtn.classList.remove('hidden'); // tampilkan tombol
    });

    // Saat tombol diklik → tampilkan prompt install
    installBtn.addEventListener('click', async () => {
        installBtn.classList.add('hidden'); // sembunyikan tombol
        if (deferredPrompt) {
            deferredPrompt.prompt();
            const { outcome } = await deferredPrompt.userChoice;
            console.log(`User memilih: ${outcome}`);
            deferredPrompt = null;
        }
    });

    // Opsional: deteksi jika sudah terinstall
    window.addEventListener('appinstalled', () => {
        console.log("Aplikasi sudah diinstall.");
    });
    </x-splade-script> --}}


    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    @spladeHead

    <x-splade-script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></x-splade-script>
    <x-splade-script>
    window.OneSignalDeferred = window.OneSignalDeferred || [];
    OneSignalDeferred.push(async function(OneSignal) {
        await OneSignal.init({
        appId: "1c0e0bb6-57a8-4bb6-b586-502e678b153b",
        });
    });
    </x-splade-script>
</head>

<body class="font-sans antialiased">
    {{-- <button id="installBtn"
            class="hidden px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        Install Aplikasi
    </button> --}}
    @splade
</body>

</html>
