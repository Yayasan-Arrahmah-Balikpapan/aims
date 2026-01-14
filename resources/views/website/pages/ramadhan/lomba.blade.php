@extends('website.layouts.web')

@section('content')
<main>
    <section class="py-10 bg-[url('/assets/bg/bg-dots-1.png')] bg-repeat bg-[#317f80]">
        <div class="max-w-md mx-auto px-4 sm:px-10 xl:px-0">
            <div class="py-10">
                <div class="flex items-center justify-center mb-4">
                    <img src="{{ asset('assets/logo/logo-ramadhan-1447h.png') }}" class="h-32" alt="">
                </div>
                <h2 class="text-3xl font-extrabold text-white text-center mb-4">Lomba Lomba Semarak Ramadhan 1447H</h2>
            </div>
        </div>
    </section>
    <section class="pb-10 bg-[url('/assets/bg/bg-masjid-ramadhan.png')] relative overflow-hidden bg-no-repeat bg-contain bg-bottom bg-fixed">
        <div class="absolute inset-0 bg-gradient-to-br from-[#ffebcd] via-amber-100 to-amber-200 opacity-75"></div>
        <div class="relative max-w-7xl pt-12 mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full">
                <div class="bg-[#fffcf7] rounded-lg shadow-sm p-4 text-left hover:shadow-lg hover:-translate-y-1 transform transition">
                    <h3 class="text-lg font-semibold text-[#1d6a6a]">LOMBA MENGGAMBAR & MEWARNAI A</h3>
                    <div class="mt-2 inline-block text-sm text-gray-600 bg-blue-50 font-medium px-2 py-1 rounded-md">Anak Usia 4-6 Tahun - Mewarnai</div>
                </div>
                <div class="bg-[#fffcf7] rounded-lg shadow-sm p-4 text-left hover:shadow-lg hover:-translate-y-1 transform transition">
                    <h3 class="text-lg font-semibold text-[#1d6a6a]">LOMBA MENGGAMBAR & MEWARNAI B</h3>
                    <div class="mt-2 inline-block text-sm text-gray-600 bg-blue-50 font-medium px-2 py-1 rounded-md">Anak Usia 7-10 Tahun - Menggambar & Mewarnai</div>
                </div>
            </div>
            <hr class="">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full">
                <div class="bg-[#fffcf7] rounded-lg shadow-sm p-4 text-left hover:shadow-lg hover:-translate-y-1 transform transition">
                    <h3 class="text-lg font-semibold text-[#1d6a6a]">LOMBA ADZAN & IQOMAH A</h3>
                    <div class="mt-2 inline-block text-sm text-gray-600 bg-green-50 font-medium px-2 py-1 rounded-md">Anak Usia 5-8 Tahun</div>
                </div>
                <div class="bg-[#fffcf7] rounded-lg shadow-sm p-4 text-left hover:shadow-lg hover:-translate-y-1 transform transition">
                    <h3 class="text-lg font-semibold text-[#1d6a6a]">LOMBA ADZAN & IQOMAH B</h3>
                    <div class="mt-2 inline-block text-sm text-gray-600 bg-green-50 font-medium px-2 py-1 rounded-md">Anak Usia 9-12 Tahun</div>
                </div>
                <div class="bg-[#fffcf7] rounded-lg shadow-sm p-4 text-left hover:shadow-lg hover:-translate-y-1 transform transition">
                    <h3 class="text-lg font-semibold text-[#1d6a6a]">LOMBA ADZAN & IQOMAH C</h3>
                    <div class="mt-2 inline-block text-sm text-gray-600 bg-green-50 font-medium px-2 py-1 rounded-md">Anak Usia 13-15 Tahun</div>
                </div>
            </div>
            <hr class="">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full">
                <div class="bg-[#fffcf7] rounded-lg shadow-sm p-4 text-left hover:shadow-lg hover:-translate-y-1 transform transition">
                    <h3 class="text-lg font-semibold text-[#1d6a6a]">LOMBA TAHFIDZ A</h3>
                    <div class="mt-2 inline-block text-sm text-gray-600 bg-yellow-50 font-medium px-2 py-1 rounded-md">Anak Usia 3-6 Tahun</div>
                </div>
                <div class="bg-[#fffcf7] rounded-lg shadow-sm p-4 text-left hover:shadow-lg hover:-translate-y-1 transform transition">
                    <h3 class="text-lg font-semibold text-[#1d6a6a]">LOMBA TAHFIDZ B</h3>
                    <div class="mt-2 inline-block text-sm text-gray-600 bg-yellow-50 font-medium px-2 py-1 rounded-md">Anak Usia 7-10 Tahun</div>
                </div>
                <div class="bg-[#fffcf7] rounded-lg shadow-sm p-4 text-left hover:shadow-lg hover:-translate-y-1 transform transition">
                    <h3 class="text-lg font-semibold text-[#1d6a6a]">LOMBA TAHFIDZ C</h3>
                    <div class="mt-2 inline-block text-sm text-gray-600 bg-yellow-50 font-medium px-2 py-1 rounded-md">Anak Usia 11-15 Tahun</div>
                </div>
            </div>
            <hr class="">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full">
                <div class="bg-[#fffcf7] rounded-lg shadow-sm p-4 text-left hover:shadow-lg hover:-translate-y-1 transform transition">
                    <h3 class="text-lg font-semibold text-[#1d6a6a]">LOMBA CERDAS CERMAT (Per-Kelompok)</h3>
                    <div class="mt-2 inline-block text-sm text-gray-600 bg-red-50 font-medium px-2 py-1 rounded-md">Kategori SD Kelas 4-6</div>
                </div>
                <div class="bg-[#fffcf7] rounded-lg shadow-sm p-4 text-left hover:shadow-lg hover:-translate-y-1 transform transition">
                    <h3 class="text-lg font-semibold text-[#1d6a6a]">LOMBA CERDAS CERMAT (Per-Kelompok)</h3>
                    <div class="mt-2 inline-block text-sm text-gray-600 bg-red-50 font-medium px-2 py-1 rounded-md">Kategori SMP Kelas 7-9</div>
                </div>
            </div>
            <div class="flex flex-col items-center justify-center">
                <Link href="{{ route('website.ramadhan') }}" class="my-8 items-center px-4 py-2 border shadow-sm text-sm font-medium rounded-md text-white bg-[#1d6a6a]">
                    Kembali ke Halaman Utama
                </Link>
            </div>
        </div>
        
    </section>

    
</main>

@endsection
