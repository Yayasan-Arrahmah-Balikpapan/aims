<template>
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        <div class="sm:p-6 py-2 border-b border-gray-200">
            <div class="flex flex-col md:flex-row justify-between items-center sm:mb-2 mb-2">
                <div>
                    <!-- Informasi hari ini yang tetap tidak berubah -->
                    <p class="text-sm text-gray-500 mt-1">
                        {{ today.toLocaleString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' }) }} -
                        {{ currentHijriDate }}
                    </p>

                    <h1 class="text-xl md:text-3xl font-bold text-gray-600 text-center sm:text-left">Agenda {{ calendarTitle }}</h1>
                    <h1 class="text-md md:text-xl font-bold text-gray-500 text-center sm:text-left">{{ currentHijriMonth }}</h1>
                </div>
                <div class="flex space-x-2 mt-2 md:mt-0">
                    <button @click="previousMonth"
                        class="sm:text-base text-sm px-2 py-1 sm:px-4 sm:py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-800 transition flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button @click="goToToday"
                        class="sm:text-base text-sm px-2 py-1 sm:px-4 sm:py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Bulan Ini
                    </button>
                    <button @click="nextMonth"
                        class="sm:text-base text-sm px-2 py-1 sm:px-4 sm:py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-800 transition flex items-center">
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-7 gap-2 sm:mb-4 mb-0 text-center font-semibold text-gray-600">
                <div v-for="(day, index) in weekdays" :key="index"
                     :class="['p-2',
                             index === 0 ? 'text-red-500' :
                             index === 6 ? 'text-red-500' : ''
                             ]">
                    {{ day }}
                </div>
            </div>

            <div class="grid grid-cols-7 sm:gap-2 gap-0 divide-x divide-y divide-gray-200">
                <div v-for="(day, index) in calendarDays" :key="index"
                    :class="['sm:min-h-[100px] min-h-[70px] sm:p-2 p-1 sm:border sm:rounded-lg',
                        {
                            'bg-gray-100 text-gray-400': !day.isCurrentMonth,
                            'bg-blue-50 border-blue-300': day.isToday,
                        }
                    ]">
                    <div class="flex justify-between items-start">
                        <div
                            :class="['font-bold sm:mb-1 mb-0',
                                { 'text-blue-600': day.isToday },
                                day.date.getDay() === 0 ? 'text-red-500' :
                                day.date.getDay() === 6 ? 'text-red-500' : ''
                            ]">
                            {{ day.date.getDate() }}
                        </div>
                        <div class="text-sm text-gray-500" v-if="day.isCurrentMonth && day.hijriDate">
                            {{ day.hijriDate }}
                        </div>
                    </div>
                    <div class="sm:space-y-1 space-y-0 max-h-[70px] overflow-y-auto">
                        <div v-for="event in getEventsForDate(day.date)" :key="event.id"
                            class="text-xs flex items-center truncate" :title="event.title">
                            <span class="w-2 h-2 rounded-full mr-1 flex-shrink-0"
                                :class="categoryColors[event.category] || categoryColors.other"></span>
                            <span class="truncate">{{ event.title }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 bg-gray-50">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Agenda Bulan {{ calendarTitle }}</h2>

            <div v-if="isLoading" class="text-center py-4">
                <div class="inline-flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span>Memuat Agenda...</span>
                </div>
            </div>

            <div v-else-if="eventsForCurrentMonth.length === 0" class="text-center py-6 text-gray-500">
                <i class="fas fa-calendar-times text-4xl mb-3"></i>
                <p>Tidak ada Agenda untuk bulan ini.</p>
            </div>

            <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div v-for="event in eventsForCurrentMonth" :key="event.id"
                    class="bg-white rounded-lg shadow-sm p-4 border-l-4"
                    :class="{
                        'border-blue-500': event.category === 'lttq',
                        'border-red-500': event.category === 'deadline',
                        'border-orange-500': event.category === 'event',
                        'border-green-500': event.category === 'training',
                        'border-purple-500': event.category === 'other'
                    }">
                    <div class="text-sm text-gray-500 mb-1">{{ formatDate(new Date(event.date)) }}</div>
                    <h3 class="font-semibold text-lg mb-2">{{ event.title }}</h3>
                    <p class="text-gray-600 mb-3">{{ event.description }}</p>
                    <div class="flex justify-between items-center">
                        <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                            <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg> {{ event.time }}
                        </span>
                        <span class="text-xs px-2 py-1 rounded-full text-white"
                            :class="{
                                'bg-blue-500': event.category === 'lttq',
                                'bg-red-500': event.category === 'deadline',
                                'bg-orange-500': event.category === 'event',
                                'bg-green-500': event.category === 'training',
                                'bg-purple-500': event.category === 'other'
                            }">
                            {{ event.category }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed, onMounted, watch } from 'vue';

export default {
    name: 'CalendarWithEvents',
    setup() {
        const currentDate = ref(new Date());
        const today = ref(new Date()); // Tanggal hari ini yang tetap
        const events = ref([]);
        const isLoading = ref(true);
        const currentHijriDate = ref('');
        const currentHijriMonth = ref('');
        const hijriDates = ref({});

        // Fungsi untuk mengonversi angka ke angka Arab
        const toArabicNumbers = (number) => {
            const arabicNumbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
            return number.toString().replace(/\d/g, (digit) => arabicNumbers[digit]);
        };

        // Fungsi untuk mengambil tanggal Hijriah untuk tanggal tertentu
        const fetchHijriDateForDay = async (date) => {
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();
            const url = `https://api.aladhan.com/v1/gToH?date=${day}-${month}-${year}`;

            try {
                const response = await fetch(url);
                const data = await response.json();
                if (data.code === 200) {
                    const hijri = data.data.hijri;
                    return toArabicNumbers(hijri.day);
                }
            } catch (error) {
                console.error('Error fetching Hijri date:', error);
            }
            return '';
        };

        // Fungsi untuk mengambil tanggal Hijriah untuk bulan saat ini
        const fetchHijriMonth = async () => {
            const hijriMonths = [
                'Muharram', 'Safar', 'Rabiul Awal', 'Rabiul Akhir',
                'Jumadil Awal', 'Jumadil Akhir', 'Rajab', 'Syaban',
                'Ramadan', 'Syawal', 'Zulqodah', 'Zulhijjah'
            ];

            // Ambil tanggal tengah bulan untuk mendapatkan bulan Hijriah yang akurat
            const midMonthDate = new Date(currentDate.value.getFullYear(), currentDate.value.getMonth(), 15);
            const day = midMonthDate.getDate();
            const month = midMonthDate.getMonth() + 1;
            const year = midMonthDate.getFullYear();
            const url = `https://api.aladhan.com/v1/gToH?date=${day}-${month}-${year}`;

            try {
                const response = await fetch(url);
                const data = await response.json();
                if (data.code === 200) {
                    const hijri = data.data.hijri;
                    const monthName = hijriMonths[parseInt(hijri.month.number) - 1];
                    const arabicYear = toArabicNumbers(hijri.year);
                    currentHijriMonth.value = `${monthName} ${hijri.year} H`;
                } else {
                    currentHijriMonth.value = 'Gagal mengambil bulan Hijriah';
                }
            } catch (error) {
                console.error('Error fetching Hijri month:', error);
                currentHijriMonth.value = 'Terjadi kesalahan';
            }
        };

        // Fungsi untuk mengambil tanggal Hijriah untuk hari ini (tetap)
        const fetchCurrentHijriDate = async () => {
            const hijriMonths = [
                'Muharram', 'Safar', 'Rabiul Awal', 'Rabiul Akhir',
                'Jumadil Awal', 'Jumadil Akhir', 'Rajab', 'Syaban',
                'Ramadan', 'Syawal', 'Zulqodah', 'Zulhijjah'
            ];

            const day = today.value.getDate();
            const month = today.value.getMonth() + 1;
            const year = today.value.getFullYear();
            const url = `https://api.aladhan.com/v1/gToH?date=${day}-${month}-${year}`;

            try {
                const response = await fetch(url);
                const data = await response.json();
                if (data.code === 200) {
                    const hijri = data.data.hijri;
                    const monthName = hijriMonths[parseInt(hijri.month.number) - 1];
                    const arabicDay = toArabicNumbers(hijri.day);
                    const arabicYear = toArabicNumbers(hijri.year);
                    currentHijriDate.value = `${hijri.day} ${monthName} ${hijri.year} H`;
                } else {
                    currentHijriDate.value = 'Gagal mengambil tanggal Hijriah';
                }
            } catch (error) {
                console.error('Error fetching Hijri date:', error);
                currentHijriDate.value = 'Terjadi kesalahan';
            }
        };

        // Fungsi untuk mengambil semua tanggal Hijriah untuk bulan yang ditampilkan
        const fetchAllHijriDates = async () => {
            const year = currentDate.value.getFullYear();
            const month = currentDate.value.getMonth();

            // Hari pertama bulan ini
            const firstDay = new Date(year, month, 1);
            // Hari terakhir bulan ini
            const lastDay = new Date(year, month + 1, 0);

            hijriDates.value = {};

            // Ambil tanggal Hijriah untuk setiap hari dalam bulan
            for (let d = new Date(firstDay); d <= lastDay; d.setDate(d.getDate() + 1)) {
                const dateStr = d.toDateString();
                hijriDates.value[dateStr] = await fetchHijriDateForDay(new Date(d));
            }

            // Juga ambil bulan Hijriah
            await fetchHijriMonth();
        };

        // Warna default untuk kategori kegiatan
        const categoryColors = {
            'lttq': 'bg-blue-500',
            'deadline': 'bg-red-500',
            'event': 'bg-orange-500',
            'training': 'bg-green-500',
            'other': 'bg-purple-500'
        };

        // Mengambil data kegiatan dari API
        const fetchEvents = async () => {
            isLoading.value = true;
            try {
                // Ganti dengan endpoint API Laravel Anda
                const response = await fetch('/api/events');
                const data = await response.json();
                events.value = data;
            } catch (error) {
                console.error('Error fetching events:', error);
                // Data dummy untuk contoh
                events.value = [{
                    id: 1,
                    title: 'Pendaftaran Tahsin Angkatan 27',
                    date: '2025-08-01',
                    category: 'lttq',
                    description: 'Waktu pendaftaran Agustus-November 2025',
                    time: 'Online'
                }];
            } finally {
                isLoading.value = false;
            }
        };

        // Navigasi bulan
        const previousMonth = async () => {
            currentDate.value = new Date(
                currentDate.value.getFullYear(),
                currentDate.value.getMonth() - 1,
                1
            );
            await fetchAllHijriDates();
        };

        const nextMonth = async () => {
            currentDate.value = new Date(
                currentDate.value.getFullYear(),
                currentDate.value.getMonth() + 1,
                1
            );
            await fetchAllHijriDates();
        };

        const goToToday = async () => {
            currentDate.value = new Date();
            await fetchAllHijriDates();
        };

        // Menghasilkan hari-hari dalam kalender dengan data Hijriah
        const calendarDays = computed(() => {
            const year = currentDate.value.getFullYear();
            const month = currentDate.value.getMonth();

            // Hari pertama bulan ini
            const firstDay = new Date(year, month, 1);
            // Hari terakhir bulan ini
            const lastDay = new Date(year, month + 1, 0);
            // Hari dalam minggu untuk hari pertama (0 = Minggu, 6 = Sabtu)
            const firstDayOfWeek = firstDay.getDay();
            // Total hari dalam bulan
            const daysInMonth = lastDay.getDate();

            // Menghasilkan hari dari bulan sebelumnya
            const prevMonthLastDay = new Date(year, month, 0).getDate();
            const prevMonthDays = [];
            for (let i = firstDayOfWeek - 1; i >= 0; i--) {
                const date = new Date(year, month - 1, prevMonthLastDay - i);
                prevMonthDays.push({
                    date,
                    isCurrentMonth: false,
                    isToday: date.toDateString() === today.value.toDateString(),
                    isWeekend: date.getDay() === 0 || date.getDay() === 6,
                    hijriDate: null
                });
            }

            // Menghasilkan hari dalam bulan ini
            const currentMonthDays = [];
            for (let i = 1; i <= daysInMonth; i++) {
                const date = new Date(year, month, i);
                currentMonthDays.push({
                    date,
                    isCurrentMonth: true,
                    isToday: date.toDateString() === today.value.toDateString(),
                    isWeekend: date.getDay() === 0 || date.getDay() === 6,
                    hijriDate: hijriDates.value[date.toDateString()] || ''
                });
            }

            // Menghasilkan hari dari bulan berikutnya
            const nextMonthDays = [];
            const totalCells = 42; // 6 minggu * 7 hari
            const remainingCells = totalCells - (prevMonthDays.length + currentMonthDays.length);
            for (let i = 1; i <= remainingCells; i++) {
                const date = new Date(year, month + 1, i);
                nextMonthDays.push({
                    date,
                    isCurrentMonth: false,
                    isToday: date.toDateString() === today.value.toDateString(),
                    isWeekend: date.getDay() === 0 || date.getDay() === 6,
                    hijriDate: null
                });
            }

            return [...prevMonthDays, ...currentMonthDays, ...nextMonthDays];
        });

        // Mendapatkan kegiatan untuk tanggal tertentu
        const getEventsForDate = (date) => {
            return events.value.filter(event => {
                const eventDate = new Date(event.date);
                return eventDate.toDateString() === date.toDateString();
            });
        };

        // Mendapatkan semua kegiatan untuk bulan yang sedang dilihat
        const eventsForCurrentMonth = computed(() => {
            const year = currentDate.value.getFullYear();
            const month = currentDate.value.getMonth();

            return events.value.filter(event => {
                const eventDate = new Date(event.date);
                return eventDate.getFullYear() === year &&
                    eventDate.getMonth() === month;
            }).sort((a, b) => new Date(a.date) - new Date(b.date));
        });

        // Format tanggal untuk tampilan
        const formatDate = (date) => {
            return date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        };

        // Format bulan dan tahun untuk judul
        const calendarTitle = computed(() => {
            return currentDate.value.toLocaleDateString('id-ID', {
                month: 'long',
                year: 'numeric'
            });
        });

        // Format hari dalam minggu (ubah Minggu menjadi Ahad)
        const weekdays = computed(() => {
            const days = [];
            const formatter = new Intl.DateTimeFormat('id-ID', {
                weekday: 'short'
            });

            // Mulai dari Minggu
            for (let i = 0; i < 7; i++) {
                const date = new Date(2023, 0, i + 1);
                let dayName = formatter.format(date);
                // Ubah "Min" menjadi "Ahd" untuk Ahad
                if (dayName === 'Min') dayName = 'Ahd';
                days.push(dayName);
            }

            return days;
        });

        // Memuat data saat komponen dimount
        onMounted(async () => {
            await fetchEvents();
            await fetchAllHijriDates();
            await fetchCurrentHijriDate();
        });

        // Watch perubahan bulan dan update Hijri dates
        watch(currentDate, async () => {
            await fetchAllHijriDates();
        });

        return {
            currentDate,
            today, // Ekspos variabel today
            events,
            isLoading,
            currentHijriMonth,
            currentHijriDate,
            categoryColors,
            calendarDays,
            eventsForCurrentMonth,
            calendarTitle,
            weekdays,
            previousMonth,
            nextMonth,
            goToToday,
            getEventsForDate,
            formatDate
        };
    }
};
</script>
