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

    <style>
        #map {
            height: 330px;
            border-radius: 0.5rem;
        },
        .leaflet-control-fullscreen-button {
            background-color: white;
            }
    </style>
</head>
<body class="bg-gray-100">

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
                    <div class="flex justify-center">
                        <video id="video" autoplay class="w-full"></video>
                    </div>
                    <div class="flex justify-center mt-4 text-sm">
                        <button type="button" onclick="capturePhoto()" class="bg-sky-600 text-white px-4 py-1 rounded-2xl hover:bg-sky-700 flex items-center">
                            Ambil Foto
                        </button>
                    </div>
                    <div class="flex justify-center mt-4">
                        <img id="photoPreview" class="w-32 rounded border border-gray-300 hidden" />
                    </div>
                </div>
                <div class="">
                    <div id="map"></div>
                </div>
            </div>

            <p class="text-center text-md font-bold text-gray-600 mt-4 mb-2" id="currentTime"></p>

            <hr class="mb-2">

            <!-- Hidden Inputs -->
            <input type="hidden" name="latitude" id="inputLatitude">
            <input type="hidden" name="longitude" id="inputLongitude">
            <input type="hidden" name="time" id="inputTime">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <input type="file" name="photo" id="photoInput" class="hidden" accept="image/jpeg">

            <div class="flex justify-center mt-4">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 font-bold  rounded hover:bg-green-700">SUBMIT</button>
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

        let photoBlob = null;
        let latitude = '';
        let longitude = '';

        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => { video.srcObject = stream; })
            .catch(() => { message.textContent = 'Tidak dapat mengakses kamera'; });

        function capturePhoto() {
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
                navigator.geolocation.getCurrentPosition(pos => {
                    latitude = pos.coords.latitude;
                    longitude = pos.coords.longitude;
                    inputLat.value = latitude;
                    inputLng.value = longitude;
                    initMap(latitude, longitude);
                }, () => {
                    message.textContent = 'Tidak dapat mengambil lokasi';
                });
            } else {
                message.textContent = 'Browser tidak mendukung Geolocation';
            }
        }

        function initMap(lat, lng) {
            const map = L.map('map', {
                fullscreenControl: true
            }).setView([lat, lng], 16);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
            L.marker([lat, lng]).addTo(map).bindPopup('Lokasi Anda').openPopup();

            setTimeout(() => { map.invalidateSize(); }, 300);
        }

        function updateTime() {
            const now = new Date();
            const timeStr = now.toLocaleString('id-ID', {
                weekday: 'long', year: 'numeric', month: 'long',
                day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit'
            });
            currentTimeEl.textContent = timeStr;
            inputTime.value = timeStr;
        }

        getLocation();
        updateTime();
        setInterval(updateTime, 1000);
    </script>


</body>
</html>

