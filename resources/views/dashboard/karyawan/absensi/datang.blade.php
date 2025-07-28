<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Absensi Datang | Karyawan Yayasan Arrahmah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.fullscreen@1.6.0/Control.FullScreen.css" />
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        #map {
            height: 330px;
            border-radius: 0.5rem;
        }
        .leaflet-control-fullscreen-button {
            background-color: white;
        }
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay">
        <div class="spinner"></div>
    </div>

    <div class="flex justify-center m-6">
        <a href="{{ route('karyawan.absensi.index') }}" class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
            </svg>
            Kembali
        </a>
    </div>
    <form id="absensiForm" action="{{ route('karyawan.absensi.datang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="max-w-xl mx-auto p-2 mt-10 bg-white rounded-2xl shadow-lg">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Absensi Datang</h2>
            <div class="grid grid-cols-2 gap-1">
                <div>
                    <div class="flex justify-center relative">
                        <video id="video" autoplay class="w-full" style="display: none;"></video>
                        <div id="cameraPlaceholder" class="w-full bg-gray-200 flex flex-col items-center justify-center" style="height: 330px;">
                            <i class="fas fa-camera text-4xl text-gray-500 mb-4"></i>
                            <p class="text-gray-600 mb-4">Memeriksa izin kamera...</p>
                            <button type="button" onclick="enableCamera()" id="enableCameraBtn" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center hidden">
                                <i class="fas fa-camera mr-2"></i> Izinkan Kamera
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-center mt-4 text-sm">
                        <button type="button" onclick="capturePhoto()" id="captureBtn" class="bg-sky-600 text-white px-4 py-1 rounded-2xl hover:bg-sky-700 flex items-center" disabled>
                            Ambil Foto
                        </button>
                    </div>
                    <div class="flex justify-center mt-4">
                        <img id="photoPreview" class="w-32 rounded border border-gray-300 hidden" />
                    </div>
                </div>
                <div class="">
                    <div id="map" class="flex items-center justify-center bg-gray-200">
                        <div id="locationPlaceholder" class="text-center p-4">
                            <i class="fas fa-map-marker-alt text-4xl text-gray-500 mb-4"></i>
                            <p class="text-gray-600 mb-4">Memeriksa izin lokasi...</p>
                            <button type="button" onclick="enableLocation()" id="enableLocationBtn" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center mx-auto hidden">
                                <i class="fas fa-map-marker-alt mr-2"></i> Izinkan Lokasi
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-center text-md font-bold text-gray-600 mt-4 mb-2" id="currentTime"></p>

            <div class="m-2 p-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" onchange="toggleKeterangan()">
                    <option value="HADIR">HADIR</option>
                    <option value="IZIN TELAT">IZIN TELAT</option>
                    <option value="SAKIT">SAKIT</option>
                </select>
                <div id="keteranganContainer" class="hidden mt-2">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="1" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
            </div>
            <script>
                function toggleKeterangan() {
                    const keteranganContainer = document.getElementById('keteranganContainer');
                    const keterangan = document.getElementById('keterangan');

                    if (document.getElementById('status').value === 'HADIR') {
                        keteranganContainer.classList.add('hidden');
                        keterangan.removeAttribute('required');
                    } else {
                        keteranganContainer.classList.remove('hidden');
                        keterangan.setAttribute('required', 'required');
                    }
                }
            </script>
            <hr class="mb-2">

            <!-- Hidden Inputs -->
            <input type="hidden" name="latitude" id="inputLatitude">
            <input type="hidden" name="longitude" id="inputLongitude">
            <input type="hidden" name="time" id="inputTime">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <input type="file" name="photo" id="photoInput" class="hidden" accept="image/jpeg">

            <div class="flex justify-center mt-4">
                <button type="submit" id="submitBtn" class="bg-green-600 text-white px-6 py-2 font-bold rounded hover:bg-green-700 flex items-center">
                    <span id="submitText">SUBMIT</span>
                    <div id="submitSpinner" class="hidden ml-2">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                </button>
            </div>

            <p class="text-center mt-4 text-red-500 text-sm" id="message"></p>
        </div>
    </form>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.fullscreen@1.6.0/Control.FullScreen.js"></script>

    <script>
        const video = document.getElementById('video');
        const photoPreview = document.getElementById('photoPreview');
        const message = document.getElementById('message');
        const currentTimeEl = document.getElementById('currentTime');
        const inputLat = document.getElementById('inputLatitude');
        const inputLng = document.getElementById('inputLongitude');
        const inputTime = document.getElementById('inputTime');
        const photoInput = document.getElementById('photoInput');
        const cameraPlaceholder = document.getElementById('cameraPlaceholder');
        const locationPlaceholder = document.getElementById('locationPlaceholder');
        const captureBtn = document.getElementById('captureBtn');
        const loadingOverlay = document.getElementById('loadingOverlay');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitSpinner = document.getElementById('submitSpinner');
        const enableCameraBtn = document.getElementById('enableCameraBtn');
        const enableLocationBtn = document.getElementById('enableLocationBtn');

        let photoBlob = null;
        let latitude = '';
        let longitude = '';
        let mapInitialized = false;

        // Check camera permission on page load
        async function checkCameraPermission() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                // Permission already granted
                video.srcObject = stream;
                video.style.display = 'block';
                cameraPlaceholder.style.display = 'none';
                captureBtn.disabled = false;
            } catch (err) {
                // Permission not granted or error
                console.log('Camera permission not granted:', err);
                cameraPlaceholder.querySelector('p').textContent = 'Kamera belum diizinkan';
                enableCameraBtn.classList.remove('hidden');
            }
        }

        // Check geolocation permission on page load
        function checkLocationPermission() {
            if (!navigator.permissions) {
                // Browser doesn't support Permission API, fallback to regular geolocation
                getLocation();
                return;
            }

            navigator.permissions.query({ name: 'geolocation' })
                .then(permissionStatus => {
                    if (permissionStatus.state === 'granted') {
                        // Permission already granted
                        getLocation();
                    } else if (permissionStatus.state === 'prompt') {
                        // Permission not decided yet
                        locationPlaceholder.querySelector('p').textContent = 'Silakan izinkan akses lokasi';
                        enableLocationBtn.classList.remove('hidden');
                    } else {
                        // Permission denied
                        locationPlaceholder.querySelector('p').textContent = 'Akses lokasi ditolak';
                        enableLocationBtn.classList.remove('hidden');
                    }

                    // Listen for permission changes
                    permissionStatus.onchange = function() {
                        if (this.state === 'granted') {
                            getLocation();
                        }
                    };
                })
                .catch(err => {
                    console.log('Error checking location permission:', err);
                    // Fallback to regular geolocation
                    getLocation();
                });
        }

        function enableCamera() {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    video.srcObject = stream;
                    video.style.display = 'block';
                    cameraPlaceholder.style.display = 'none';
                    captureBtn.disabled = false;
                })
                .catch(err => {
                    console.error(err);
                    message.textContent = 'Tidak dapat mengakses kamera: ' + err.message;
                    cameraPlaceholder.querySelector('p').textContent = 'Gagal mengakses kamera';
                });
        }

        function enableLocation() {
            getLocation();
        }

        function capturePhoto() {
            if (!video.srcObject) return;

            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0);
            canvas.toBlob(blob => {
                photoBlob = blob;
                photoPreview.src = URL.createObjectURL(blob);
                photoPreview.classList.remove('hidden');

                const file = new File([blob], 'photo.jpg', { type: 'image/jpeg' });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                photoInput.files = dataTransfer.files;
            }, 'image/jpeg');
        }

        function getLocation() {
            if (navigator.geolocation) {
                locationPlaceholder.querySelector('p').textContent = 'Mengambil lokasi...';

                navigator.geolocation.getCurrentPosition(
                    pos => {
                        latitude = pos.coords.latitude;
                        longitude = pos.coords.longitude;
                        inputLat.value = latitude;
                        inputLng.value = longitude;

                        // Hide location placeholder and show map
                        locationPlaceholder.style.display = 'none';
                        document.getElementById('map').innerHTML = ''; // Clear placeholder
                        initMap(latitude, longitude);
                    },
                    err => {
                        console.error(err);
                        message.textContent = 'Tidak dapat mengambil lokasi: ' + err.message;
                        locationPlaceholder.querySelector('p').textContent = 'Gagal mengambil lokasi';
                        enableLocationBtn.classList.remove('hidden');
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            } else {
                message.textContent = 'Browser tidak mendukung Geolocation';
                locationPlaceholder.querySelector('p').textContent = 'Browser tidak mendukung Geolocation';
            }
        }

        function initMap(lat, lng) {
            if (mapInitialized) return;

            const map = L.map('map', {
                fullscreenControl: true
            }).setView([lat, lng], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            L.marker([lat, lng]).addTo(map).bindPopup('Lokasi Anda').openPopup();
            mapInitialized = true;

            setTimeout(() => { map.invalidateSize(); }, 300);
        }

        function updateTime() {
            const now = new Date();
            const timeStr = now.toLocaleString('id-ID', {
                weekday: 'long', year: 'numeric', month: 'long',
                day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit'
            });
            currentTimeEl.textContent = timeStr;
            inputTime.value = now.toISOString(); // Store in ISO format for backend
        }

        // Form submission handler
        document.getElementById('absensiForm').addEventListener('submit', function(e) {
            // Validate required fields
            // if (!photoInput.files.length) {
            //     e.preventDefault();
            //     message.textContent = 'Harap ambil foto terlebih dahulu';
            //     return;
            // }

            if (!inputLat.value || !inputLng.value) {
                e.preventDefault();
                message.textContent = 'Harap izinkan lokasi terlebih dahulu';
                return;
            }

            // Show loading state
            submitText.textContent = 'Mengirim...';
            submitSpinner.classList.remove('hidden');
            submitBtn.disabled = true;
        });

        // Initial setup when page loads
        window.addEventListener('load', function() {
            // Check permissions
            checkCameraPermission();
            checkLocationPermission();

            // Update time
            updateTime();
            setInterval(updateTime, 1000);

            // Hide loading overlay
            setTimeout(() => {
                loadingOverlay.style.display = 'none';
            }, 500);
        });
    </script>
</body>
</html>
