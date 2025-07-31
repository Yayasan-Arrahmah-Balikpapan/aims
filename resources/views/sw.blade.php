const CACHE_NAME = 'laravel-splade-pwa-{{ config('pwa.version') }}';

// Ambil semua file Vite yang di-generate
const urlsToCache = [
    '/',
    '/offline',
    @php
        $manifestPath = public_path('build/manifest.json');
        if (file_exists($manifestPath)) {
            $manifest = json_decode(file_get_contents($manifestPath), true);
            foreach ($manifest as $file) {
                echo "'/build/{$file['file']}',";
                if (!empty($file['css'])) {
                    foreach ($file['css'] as $cssFile) {
                        echo "'/build/{$cssFile}',";
                    }
                }
            }
        }
    @endphp
];

// Install SW dan cache semua file
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => cache.addAll(urlsToCache))
    );
    self.skipWaiting();
});

// Hapus cache lama saat versi baru
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((names) => {
            return Promise.all(
                names.map((name) => {
                    if (name !== CACHE_NAME) {
                        return caches.delete(name);
                    }
                })
            );
        })
    );
    self.clients.claim();
});

// Fetch handler untuk Splade (SPA + offline)
self.addEventListener('fetch', (event) => {
    if (event.request.method !== 'GET') return;

    event.respondWith(
        fetch(event.request)
            .then((response) => {
                const clone = response.clone();
                caches.open(CACHE_NAME).then((cache) => cache.put(event.request, clone));
                return response;
            })
            .catch(() => {
                return caches.match(event.request).then((cachedResponse) => {
                    if (cachedResponse) {
                        return cachedResponse;
                    }
                    // Jika navigasi SPA dan offline → tampilkan halaman offline
                    if (event.request.mode === 'navigate') {
                        return caches.match('/offline');
                    }
                });
            })
    );
});
