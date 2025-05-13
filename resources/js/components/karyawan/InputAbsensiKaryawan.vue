<template>
    <div class="p-6 max-w-xl mx-auto bg-white rounded-xl shadow-md space-y-6">
        <h1 class="text-3xl font-bold text-center text-gray-800">Form Absensi</h1>

        <div v-if="successMessage" class="text-green-600 text-center">{{ successMessage }}</div>
        <div v-if="errorMessage" class="text-red-600 text-center">{{ errorMessage }}</div>

        <div class="space-y-4">
            <div class="flex flex-col items-center">
                <video ref="video" autoplay class="w-72 h-52 rounded-lg border"></video>
                <button @click="capturePhoto" class="mt-3 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Ambil Foto</button>
            </div>

            <div v-if="photoPreview" class="flex justify-center">
                <img :src="photoPreview" class="w-32 h-32 object-cover rounded border" />
            </div>

            <div>
                <div id="map" class="w-full h-64 rounded-lg border"></div>
            </div>

            <div class="text-center text-gray-600">
                {{ currentTime }}
            </div>

            <button @click="submitForm" class="w-full px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700" :disabled="loading">
                <span v-if="loading">Menyimpan...</span>
                <span v-else>Simpan Absensi</span>
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import markerIcon2x from 'leaflet/dist/images/marker-icon-2x.png';
import markerIcon from 'leaflet/dist/images/marker-icon.png';
import markerShadow from 'leaflet/dist/images/marker-shadow.png';

delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
    iconRetinaUrl: markerIcon2x,
    iconUrl: markerIcon,
    shadowUrl: markerShadow,
});


export default {
    name: 'AbsensiForm',
    data() {
        return {
            video: null,
            photo: null,
            photoPreview: '',
            latitude: '',
            longitude: '',
            successMessage: '',
            errorMessage: '',
            loading: false,
            currentTime: '',
            map: null,
            marker: null,
        };
    },
    mounted() {
        this.startCamera();
        this.getLocation();
        this.updateTime();
        setInterval(this.updateTime, 1000);
    },
    methods: {
        startCamera() {
            navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                this.video = this.$refs.video;
                this.video.srcObject = stream;
            })
            .catch(err => {
                console.error('Gagal mengakses kamera', err);
                this.errorMessage = 'Tidak dapat mengakses kamera';
            });
        },
        getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    this.latitude = position.coords.latitude;
                    this.longitude = position.coords.longitude;

                    this.$nextTick(() => {
                        setTimeout(() => {
                            this.initMap();
                        }, 100);
                    });

                }, error => {
                    console.error('Gagal mendapatkan lokasi', error);
                    this.errorMessage = 'Tidak dapat mengambil lokasi';
                });
            } else {
                this.errorMessage = 'Geolocation tidak didukung browser';
            }
        },
        initMap() {
            this.map = L.map('map').setView([this.latitude, this.longitude], 16);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(this.map);

            this.marker = L.marker([this.latitude, this.longitude]).addTo(this.map)
            .bindPopup('Lokasi Anda').openPopup();

            setTimeout(() => {
                this.map.invalidateSize();
            }, 200);
        },
        capturePhoto() {
            const canvas = document.createElement('canvas');
            canvas.width = this.video.videoWidth;
            canvas.height = this.video.videoHeight;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(this.video, 0, 0);

            canvas.toBlob(blob => {
                this.photo = new File([blob], 'photo.jpg', { type: 'image/jpeg' });
                this.photoPreview = URL.createObjectURL(blob);
            }, 'image/jpeg');
        },
        submitForm() {
            if (!this.photo || !this.latitude || !this.longitude) {
                this.errorMessage = 'Foto dan lokasi harus diambil terlebih dahulu.';
                return;
            }

            this.loading = true;
            this.errorMessage = '';
            this.successMessage = '';

            const formData = new FormData();
            formData.append('photo', this.photo);
            formData.append('latitude', this.latitude);
            formData.append('longitude', this.longitude);
            formData.append('time', this.currentTime);

            axios.post('/absensi', formData)
            .then(response => {
                this.successMessage = 'Absensi berhasil!';
                this.resetForm();
            })
            .catch(error => {
                console.error('Gagal menyimpan absensi', error);
                this.errorMessage = 'Gagal menyimpan absensi.';
            })
            .finally(() => {
                this.loading = false;
            });
        },
        resetForm() {
            this.photo = null;
            this.photoPreview = '';
        },
        updateTime() {
            const now = new Date();
            this.currentTime = now.toLocaleString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
        },
    }
}
</script>

<style scoped>
#map {
    min-height: 250px;
}
</style>
