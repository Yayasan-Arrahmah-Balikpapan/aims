<x-layouts.main>
    <section class="max-w-7xl mx-auto bg-white text-sm">
        <section class="h-[200px] sm:h-[300px] bg-[url('/assets/bg/bg-masjid-ramadhan.png')] relative overflow-hidden bg-no-repeat sm:bg-cover bg-contain bg-bottom">
            <div class="absolute inset-0 bg-gradient-to-br from-[#ffebcd] via-amber-100 to-amber-200 opacity-75"></div>
            <div class="relative max-w-7xl pt-12 mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="flex items-center justify-center mb-4">
                    <img src="{{ asset('assets/logo/logo-ramadhan-1447h.png') }}" class="h-36 sm:h-52" alt="">
                </div>
            </div>
        </section>
        <section class="max-w-7xl mx-auto bg-white text-center text-sm">
            <div class="grid grid-cols-3 gap-4 p-6">
                <Link href="{{ route('website.lttq') }}" class="inline-flex flex-col items-center bg-gradient-to-t from-[#1d6a6a] to-[#108383] border-2 border-yellow-400 rounded-lg p-1">
                    <x-carbon-user-multiple class="w-8 h-8 text-yellow-400 mt-1" />
                    <span class="sm:font-bold font-semibold text-white">Peserta Lomba</span>
                </Link>
                <Link href="{{ route('website.ibadah') }}" class="inline-flex flex-col items-center">
                    <img src="{{ asset('assets/icon/icon-masjid.png') }}" class="h-16 sm:h-24" alt="icon-masjid">
                    <span class="sm:font-bold font-semibold text-gray-800 ">Peserta</span>
                </Link>
                <Link href="{{ route('dashboard.peserta.riwayatpembayaran') }}" class="inline-flex flex-col items-center">
                    <img src="{{ asset('assets/icon/pembayaran-spp.png') }}" class="h-16 sm:h-24" alt="pembayaran-spp">
                    <span class="sm:font-bold font-semibold text-gray-800 ">Tanggal</span>
                </Link>
            </div>
        </section>
    </section>
    {{-- <section>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="#kegiatan" class="p-2 rounded-md flex items-center bg-gradient-to-b from-[#deaa37] to-[#feb10a] text-white shadow-lg shadow-amber-200">
                <x-carbon-calendar class="w-5 h-5 mr-2" />
                Informasi Kegiatan
            </a>
            <Link href="{{ route('website.ramadhan.lomba') }}" class="p-2 rounded-md flex items-center border border-[#deaa37] text-[#deaa37] bg-white shadow-lg shadow-amber-200 hover:bg-amber-50">
                <x-carbon-notification class="w-5 h-5 mr-2" />
                Lomba-lomba
            </Link>
        </div>
    </section> --}}
    {{-- <section class="max-w-7xl mx-auto px-5 md:px-10 py-10 bg-white text-sm">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
            <Link href="{{ route('website.lttq.tahsin.pendaftaran') }}" class="grid grid-cols-2 border rounded-xl shadow-md ">
                <img src="{{ asset('assets/img/ramadhan/lomba.png') }}" class="rounded-s-xl" alt="1" loading="lazy">
                <div class="px-4 py-2 flex flex-col justify-between items-start">
                    <div class="text-left">
                        <p class="text-gray-800 text-md lg:text-3xl font-bold">Daftar Lomba Semarak Ramadhan</p>
                    </div>
                    <div class="flex items-center">
                        <x-carbon-time-filled class="w-4 text-primary-700 mr-2" />
                        <p class="text-gray-600 text-xs">15 Jan - 10 Feb  2026</p>
                    </div>
                </div>
            </Link>
        </div>
    </section> --}}
</x-layouts.main>
