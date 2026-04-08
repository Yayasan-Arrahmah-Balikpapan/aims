<template>
    <div>
        <div v-if="!isUploadSuccessful" class="mb-6 text-center">
            <a v-if="!isRecording" href="#" @click.prevent="startRecording" class="text-red-700 border border-red-700 px-4 py-4 font-semibold rounded-full hover:bg-red-700 hover:text-white cursor-pointer">
                KLIK REKAM SEKARANG <i class="fas fa-microphone"></i>
            </a>
            <a v-if="isRecording" href="#" @click.prevent="stopRecording" class="bg-red-500 text-white px-4 py-4 rounded-full hover:bg-red-600 cursor-pointer">
                STOP
            </a>
        </div>

        <div v-if="isRecording" class="text-center mb-4">
            <i class="fas fa-microphone recording text-4xl"></i>
        </div>

        <div v-if="!beforeRecording && !isUploadSuccessful">
            <audio ref="audioPlayback" controls class="w-full mb-4"></audio>
            <div v-if="isUploading" class="flex items-center justify-center gap-2 text-sm text-gray-600">
                <span class="upload-spinner"></span>
                <span>Mengunggah rekaman...</span>
            </div>
            <div v-else-if="uploadError" class="text-center">
                <p class="text-sm text-red-600 mb-2">{{ uploadError }}</p>
                <a
                    href="#"
                    @click.prevent="uploadAudio"
                    class="inline-flex items-center border border-red-600 text-red-600 px-3 py-1 rounded-lg hover:bg-red-600 hover:text-white"
                >
                    Coba Upload Lagi
                </a>
            </div>
        </div>

        <div v-if="isUploadSuccessful" class="text-center mb-4">
            <i class="fas fa-check-circle text-green-500 text-4xl"></i>
            <p class="text-green-500 text-xl mt-2">Rekaman Berhasil</p>
            <audio ref="audioPlayback" controls class="w-full mt-4"></audio>
        </div>
    </div>
</template>

<script>
import { v4 as uuidv4 } from 'uuid';

export default {
    data() {
        return {
            beforeRecording: true,
            isRecording: false,
            isUploadSuccessful: false,
            isUploading: false,
            uploadError: '',
            mediaRecorder: null,
            mediaStream: null,
            audioChunks: [],
            audioData: '',
            csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Ambil token CSRF dari meta tag
        };
    },
    methods: {
        async startRecording() {
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
            this.mediaStream = stream;
            this.mediaRecorder = new MediaRecorder(stream);

            this.mediaRecorder.ondataavailable = (event) => {
                this.audioChunks.push(event.data);
            };

            this.mediaRecorder.onstop = async () => {
                const audioBlob = new Blob(this.audioChunks, { type: 'audio/wav' });
                const audioUrl = URL.createObjectURL(audioBlob);
                this.$refs.audioPlayback.src = audioUrl;

                const formData = new FormData();
                const fileName = uuidv4() + '.wav'; // Gunakan UUID untuk nama file
                formData.append('audio', audioBlob, fileName);
                formData.append('_token', this.csrfToken); // Tambahkan token CSRF ke form data
                this.audioData = formData;

                this.audioChunks = [];
                await this.uploadAudio();

                if (this.mediaStream) {
                    this.mediaStream.getTracks().forEach((track) => track.stop());
                    this.mediaStream = null;
                }
            };

            this.mediaRecorder.start();
            this.isRecording = true;
            this.isUploadSuccessful = false;
            this.uploadError = '';
        },
        stopRecording() {
            if (!this.mediaRecorder || this.mediaRecorder.state !== 'recording') {
                return;
            }

            this.mediaRecorder.stop();
            this.isRecording = false;
            this.beforeRecording = false;
        },
        async uploadAudio() {
            if (this.isUploading || !this.audioData) {
                return;
            }

            try {
                this.isUploading = true;
                this.uploadError = '';
                console.log('Mengirim data:', this.audioData); // Log data yang akan dikirim
                const response = await axios.post('/lttq/tahsin/pendaftaran/store/rekaman', this.audioData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                console.log(response.data);
                this.isUploadSuccessful = true;
                this.isRecording = false;
            } catch (error) {
                this.uploadError = error?.response?.data?.message || 'Upload gagal. Silakan coba lagi.';
                console.error('Error uploading audio:', error.response || error.message);
            } finally {
                this.isUploading = false;
            }
        }
    },
};
</script>

<style scoped>
.recording {
    animation: blink 1s infinite;
}

.upload-spinner {
    width: 14px;
    height: 14px;
    border: 2px solid #d1d5db;
    border-top-color: #374151;
    border-radius: 9999px;
    animation: spin 0.7s linear infinite;
}

@keyframes blink {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>
