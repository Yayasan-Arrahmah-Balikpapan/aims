<x-layouts.main>
    <div class="p-4">
        <h2 class="text-2xl font-bold uppercase">
            Absensi Karyawan
        </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
        <div class="bg-white m-4 p-2 rounded-lg border">
            <div class="bg-[url('/assets/bg/bg-dots-1.png')] bg-repeat">
                <HariTanggalJam />
                <hr class="my-6">
            </div>
            @if (!$absensi)
                <div class="flex justify-center mb-6 mt-4">
                    <a href="{{ route('karyawan.absensi.datang') }}" class="px-6 py-4 flex items-center font-semibold bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-lg hover:from-primary-700 hover:to-primary-800">
                        @svg('carbon-touch-1', 'h-12 w-12 mr-2')
                        Isi Absensi Datang
                    </a>
                </div>
            @else
                @if (!isset($absensi->keterangan['istirahat_mulai']))
                    <div class="flex justify-center mb-6 mt-4">
                        <a href="{{ route('karyawan.absensi.istirahat-mulai') }}" class="px-6 py-4 flex items-center font-semibold bg-gradient-to-r from-sky-500 to-sky-600 text-white rounded-lg hover:from-sky-700 hover:to-sky-800">
                            @svg('carbon-touch-1', 'h-12 w-12 mr-2')
                            Isi Waktu Istirahat
                        </a>
                    </div>
                @else
                    @if (!isset($absensi->keterangan['istirahat_selesai']))
                        <div class="flex justify-center mb-6 mt-4">
                            <a href="{{ route('karyawan.absensi.istirahat-selesai') }}" class="px-6 py-4 flex items-center font-semibold bg-gradient-to-r from-sky-500 to-sky-600 text-white rounded-lg hover:from-sky-700 hover:to-sky-800">
                                @svg('carbon-touch-1', 'h-12 w-12 mr-2')
                                Istirahat Selesai
                            </a>
                        </div>
                    @else
                        @if ($absensi->waktu_pulang == null)
                            <div class="flex justify-center mb-6 mt-4">
                                <a href="{{ route('karyawan.absensi.pulang') }}" class="px-6 py-4 flex items-center font-semibold bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg hover:from-orange-700 hover:to-orange-800">
                                    @svg('carbon-touch-1', 'h-12 w-12 mr-2')
                                    Isi Absensi Pulang
                                </a>
                            </div>
                        @else
                            <div class="flex justify-center mb-6 mt-4">
                                <div class="px-6 py-4 flex items-center font-semibold border-2 border-primary-700 text-primary-700 rounded-lg">
                                    @svg('carbon-checkmark-outline', 'h-12 w-12 mr-2')
                                    <span>Absensi Selesai</span>
                                </div>
                            </div>
                        @endif
                    @endif
                @endif
            @endif

            <div class="grid grid-cols-3 gap-2 p-4">
                <div class="flex flex-col items-center mr-2">
                    @svg('carbon-timer', 'h-10 w-10 text-gray-500 mb-1')
                    <span class="text-gray-800 font-bold text-sm">{{ $absensi ? $absensi->waktu_datang->format('H:i') : '-' }}</span>
                    <span class="text-gray-800 font-bold text-sm">{{ $absensi ? 'WITA' : '' }}</span>
                    <span class="text-gray-500">Datang</span>
                </div>
                <div class="flex flex-col items-center mr-2">
                    @svg('carbon-time', 'h-10 w-10 text-gray-500 mb-1')
                    <span class="text-gray-800 font-bold text-sm">
                        {{ $absensi && isset($absensi->keterangan['istirahat_mulai']) ? \Carbon\Carbon::parse($absensi->keterangan['istirahat_mulai'])->timezone('Asia/Makassar')->format('H:i') : '-' }}
                        -
                        {{ $absensi && isset($absensi->keterangan['istirahat_selesai']) ? \Carbon\Carbon::parse($absensi->keterangan['istirahat_selesai'])->timezone('Asia/Makassar')->format('H:i') : '-' }}
                    </span>
                    <span class="text-gray-800 font-bold text-sm">
                        {{ $absensi && isset($absensi->keterangan['istirahat_mulai']) ? 'WITA' : '' }}
                    </span>
                    <span class="text-gray-500">Istirahat</span>
                </div>
                <div class="flex flex-col items-center">
                    @svg('carbon-event-schedule', 'h-10 w-10 text-gray-500 mb-1')
                    <span class="text-gray-800 font-bold text-sm">{{ $absensi && $absensi->waktu_pulang ? $absensi->waktu_pulang->format('H:i') : '-' }}</span>
                    <span class="text-gray-800 font-bold text-sm">{{ $absensi && $absensi->waktu_pulang ? 'WITA' : '' }}</span>
                    <span class="text-gray-500">Pulang</span>
                </div>
            </div>
        </div>
        <div></div>
        <div class="w-full">
            <KalenderAbsensiKaryawan />
        </div>
    </div>


</x-layouts.main>
