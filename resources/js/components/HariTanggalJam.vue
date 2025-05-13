<template>
    <div class="p-2 pt-6 max-w-xl mx-auto">
        <div class="text-center text-5xl font-bold text-gray-600">
            {{ currentTime }}
        </div>
        <div class="text-center text-2xl font-semibold text-gray-600">
            {{ currentDateTime }}
        </div>
        <div class="text-center text-md font-medium text-green-700 mt-1">
            {{ currentHijriDate }}
        </div>
    </div>
</template>

<script>
export default {
    name: 'AbsensiForm',
    data() {
        return {
            currentTime: '',
            currentDateTime: '',
            currentHijriDate: ''
        };
    },
    mounted() {
        this.updateTime();
        this.fetchHijriDate();
        setInterval(this.updateTime, 1000);
    },
    methods: {
        updateTime() {
            const now = new Date();
            this.currentTime = now.toLocaleString('id-ID', {
                timeZone: 'Asia/Makassar',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            this.currentDateTime = now.toLocaleString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        },
        async fetchHijriDate() {
            const hijriMonths = [
                'Muharram', 'Safar', 'Rabiul Awal', 'Rabiul Akhir',
                'Jumadil Awal', 'Jumadil Akhir', 'Rajab', 'Syaban',
                'Ramadan', 'Syawal', 'Zulqodah', 'Zulhijjah'
            ];

            const today = new Date();
            const day = today.getDate();
            const month = today.getMonth() + 1;
            const year = today.getFullYear();
            const url = `https://api.aladhan.com/v1/gToH?date=${day}-${month}-${year}`;

            try {
                const response = await fetch(url);
                const data = await response.json();
                if (data.code === 200) {
                    const hijri = data.data.hijri;
                    const monthName = hijriMonths[parseInt(hijri.month.number) - 1]; // -1 karena index array dimulai dari 0
                    this.currentHijriDate = `${hijri.day} ${monthName} ${hijri.year} H`;
                } else {
                    this.currentHijriDate = 'Gagal mengambil tanggal Hijriah';
                }
            } catch (error) {
                console.error('Error fetching Hijri date:', error);
                this.currentHijriDate = 'Terjadi kesalahan';
            }
        }

    }
};
</script>

<style scoped>
</style>
