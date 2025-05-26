<template>
    <div class="bg-white w-full m-4 border border-gray-200 rounded-lg shadow-sm  p-4 max-w-sm mx-auto">
        <div class="flex justify-between items-center mb-4">
            <button @click="bulanSebelumnya">←</button>
            <h2 class="text-lg font-semibold">{{ namaBulan }} {{ tahun }}</h2>
            <button @click="bulanBerikutnya">→</button>
        </div>

        <div class="grid grid-cols-7 text-center font-medium">
            <div v-for="(hari, index) in namaHari" :key="index">{{ hari }}</div>
        </div>

        <div class="grid grid-cols-7 text-center gap-1 mt-2">
            <div v-for="blank in awalBulan" :key="'b'+blank">&nbsp;</div>
            <div
                v-for="tanggal in jumlahHari"
                :key="tanggal"
                class="p-1 rounded-full w-8 h-8 mx-auto flex items-center justify-center"
                :class="[warnaStatus(tanggal), isToday(tanggal) ? 'font-bold border-2 border-red-600' : ''],isWeekend(tanggal) ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : ''"
                >
                {{ tanggal }}
            </div>
        </div>

        <div class="text-center mt-4">
            <hr class="my-4">
            <div class="grid grid-cols-2 gap-2">
                <div class="flex items-center justify-start">
                    <span class="inline-block w-3 h-3 rounded-full bg-green-500 mr-2"></span>
                    <span class="text-gray-600 text-xs">: Hadir</span>
                </div>
                <div class="flex items-center justify-start">
                    <span class="inline-block w-3 h-3 rounded-full bg-yellow-300 mr-2"></span>
                    <span class="text-gray-600 text-xs">: Izin Telat</span>
                </div>
                <div class="flex items-center justify-start">
                    <span class="inline-block w-3 h-3 rounded-full bg-red-400 mr-2"></span>
                    <span class="text-gray-600 text-xs">: Libur</span>
                </div>
                <div class="flex items-center justify-start">
                    <span class="inline-block w-3 h-3 rounded-full bg-purple-500 mr-2"></span>
                    <span class="text-gray-600 text-xs">: Cuti</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            tanggalSaatIni: new Date(),
            dataAbsensi: {}, // Data dari API
            namaHari: ["Ahad", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
        };
    },
    computed: {
        tahun() {
            return this.tanggalSaatIni.getFullYear();
        },
        bulan() {
            return this.tanggalSaatIni.getMonth();
        },
        namaBulan() {
            return this.tanggalSaatIni.toLocaleString("id-ID", { month: "long" });
        },
        awalBulan() {
            const tanggal = new Date(this.tahun, this.bulan, 1);
            return tanggal.getDay();
        },
        jumlahHari() {
            return new Date(this.tahun, this.bulan + 1, 0).getDate();
        },
    },
    methods: {
        ambilDataAbsensi() {
            const bulan = String(this.bulan + 1).padStart(2, "0");
            const tahun = this.tahun;

            axios
            .get(`/dashboard/karyawan/absensi/data?bulan=${bulan}&tahun=${tahun}`)
            .then((res) => {
                this.dataAbsensi = res.data;
            })
            .catch((err) => {
                console.error("Gagal mengambil data absensi:", err);
            });
        },
        warnaStatus(tanggal) {
            const key = `${this.tahun}-${String(this.bulan + 1).padStart(2, "0")}-${String(tanggal).padStart(2, "0")}`;
            const status = this.dataAbsensi[key];

            switch (status) {
                case "HADIR":
                    return "bg-emerald-500 text-white";
                case "IZIN TELAT":
                    return "bg-yellow-300 text-white";
                case "TIDAK MASUK":
                    return "bg-red-400 text-white";
                case "CUTI":
                    return "bg-purple-500 text-white";
                default:
                    return "";
            }
        },
        bulanSebelumnya() {
            const newDate = new Date(this.tahun, this.bulan - 1, 1);
            this.tanggalSaatIni = newDate;
            this.ambilDataAbsensi();
        },
        bulanBerikutnya() {
            const newDate = new Date(this.tahun, this.bulan + 1, 1);
            this.tanggalSaatIni = newDate;
            this.ambilDataAbsensi();
        },
        isToday(tanggal) {
            const today = new Date();
            return (
                tanggal === today.getDate() &&
                this.bulan === today.getMonth() &&
                this.tahun === today.getFullYear()
            );
        },
        isWeekend(index) {
            const hariDalamMinggu = (index + this.awalBulan) % 7;
            return hariDalamMinggu === 1 || hariDalamMinggu === 0; // Sabtu & Minggu
        }
    },
    mounted() {
        this.ambilDataAbsensi();
    },
};
</script>

