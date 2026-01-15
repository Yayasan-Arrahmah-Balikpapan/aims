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
                <div class="bg-[#deaa37] rounded-md p-4 text-white flex flex-row items-center">
                    <x-carbon-alarm class="flex-1/4 h-8 w-8 mr-4"/>
                    <div class="flex-3/4">
                        <h2 class="text-md font-semibold">Pendaftaran</h2>
                        <p class="text-sm font-medium">14 Januari - 10 Februari 2026</p>
                    </div>
                </div>
                <div class="bg-[#deaa37] rounded-md p-4 text-white flex flex-row items-center mt-2">
                    <x-carbon-event class="flex-1/4 h-8 w-8 mr-4"/>
                    <div class="flex-3/4">
                        <h2 class="text-md font-semibold">Perlombaan</h2>
                        <p class="text-sm font-medium">7,8,14,15 Februari 2026</p>
                    </div>
                </div>
                <div class="bg-[#deaa37] rounded-md p-4 text-white flex flex-row items-center mt-2">
                    <x-carbon-location class="flex-1/4 h-8 w-8 mr-4"/>
                    <div class="flex-3/4">
                        <h2 class="text-md font-semibold">Masjid Arrahmah Balikpapan</h2>
                        <p class="text-sm font-medium">Perum Spinggan Pratama, Balikpapan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-10 bg-[url('/assets/bg/bg-masjid-ramadhan.png')] relative overflow-hidden bg-no-repeat bg-contain bg-bottom bg-fixed">
        <div class="absolute inset-0 bg-gradient-to-br from-[#ffebcd] via-amber-100 to-amber-200 opacity-75"></div>
        <div class="relative max-w-7xl pt-12 mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="w-full">
                <div class="bg-blue-50 rounded-lg shadow-sm p-4 text-left hover:shadow-lg hover:-translate-y-1 transform transition">
                    <div class="flex items-center">
                        <x-carbon-pen-fountain class="h-6 w-6 text-[#1d6a6a] mr-4"/>
                        <h3 class="text-xl font-semibold text-[#1d6a6a]">LOMBA MENGGAMBAR & MEWARNAI</h3>
                    </div>
                    <hr class="my-2">
                    <div class="mt-2 text-md text-gray-600 bg-blue-50 font-semibold p-2 rounded-md">
                        <p>Kategori A. Anak Usia 4-6 Tahun - Mewarnai</p>
                        <p>Kategori B. Anak Usia 7-10 Tahun - Menggambar & Mewarnai</p>
                    </div>
                    <div class="text-md bg-white text-gray-600 font-semibold p-2 rounded-md">
                        <p>Infaq Lomba adalah sebesar Rp. 50.000,- /peserta</p>
                    </div>
                    <div class="inline-block text-sm bg-slate-200 text-gray-600 font-medium p-2 rounded-md mt-2">
                        ** Usia ditentukan pertanggal 20 Januari 2026
                    </div>

                    <div class="bg-white border rounded-md mt-2 flex items-center justify-between p-2 w-full sm:w-1/3">
                        <h2 class="text-md font-semibold text-[#1d6a6a] mr-5">Petunjuk Teknis</h2>
                        <x-carbon-document-download class="inline h-5 w-5 text-gray-700"/>
                    </div>
                </div>
            </div>
            <hr class="border-white">
            <div class="w-full">
                <div class="bg-green-50 rounded-lg shadow-sm p-4 text-left hover:shadow-lg hover:-translate-y-1 transform transition">
                    <div class="flex items-center">
                        <x-carbon-draggable class="h-6 w-6 text-[#1d6a6a] mr-4"/>
                        <h3 class="text-xl font-semibold text-[#1d6a6a]">LOMBA ADZAN & IQOMAH</h3>
                    </div>
                    <hr class="my-2">
                    <div class="mt-2 text-md text-gray-600 bg-green-50 font-semibold p-2 rounded-md">
                        <p>Kategori A. Anak Usia 5-8 Tahun</p>
                        <p>Kategori B. Anak Usia 9-12 Tahun</p>
                        <p>Kategori C. Anak Usia 13-15 Tahun</p>
                    </div>
                    <div class="text-md bg-white text-gray-600 font-semibold p-2 rounded-md">
                        <p>Infaq Lomba adalah sebesar Rp. 50.000,- /peserta</p>
                    </div>
                    <div class="inline-block text-sm bg-slate-200 text-gray-600 font-medium p-2 rounded-md mt-2">
                        ** Usia ditentukan pertanggal 20 Januari 2026
                    </div>

                    <div class="bg-white border rounded-md mt-2 flex items-center justify-between p-2 w-full sm:w-1/3">
                        <h2 class="text-md font-semibold text-[#1d6a6a] mr-5">Petunjuk Teknis</h2>
                        <x-carbon-document-download class="inline h-5 w-5 text-gray-700"/>
                    </div>
                </div>
            </div>
            <hr class="border-white">
            <div class="w-full">
                <div class="bg-yellow-50 rounded-lg shadow-sm p-4 text-left hover:shadow-lg hover:-translate-y-1 transform transition">
                    <div class="flex items-center">
                        <x-carbon-pen-fountain class="h-6 w-6 text-[#1d6a6a] mr-4"/>
                        <h3 class="text-xl font-semibold text-[#1d6a6a]">LOMBA TAHFIDZ</h3>
                    </div>
                    <hr class="my-2">
                    <div class="mt-2 text-md text-gray-600 bg-yellow-50 font-semibold p-2 rounded-md">
                        <p>Kategori A. Anak Usia Anak Usia 3-6 Tahun</p>
                        <p>Kategori B. Anak Usia 7-10 Tahun</p>
                        <p>Kategori C. Anak Usia 11-15 Tahun</p>
                    </div>
                    <div class="text-md bg-white text-gray-600 font-semibold p-2 rounded-md">
                        <p>Infaq Lomba adalah sebesar Rp. 50.000,- /peserta</p>
                    </div>
                    <div class="inline-block text-sm bg-slate-200 text-gray-600 font-medium p-2 rounded-md mt-2">
                        ** Usia ditentukan pertanggal 20 Januari 2026
                    </div>

                    <div class="bg-white border rounded-md mt-2 flex items-center justify-between p-2 w-full sm:w-1/3">
                        <h2 class="text-md font-semibold text-[#1d6a6a] mr-5">Petunjuk Teknis</h2>
                        <x-carbon-document-download class="inline h-5 w-5 text-gray-700"/>
                    </div>
                </div>
            </div>
            <hr class="border-white">
            <div class="w-full">
                <div class="bg-red-50 rounded-lg shadow-sm p-4 text-left hover:shadow-lg hover:-translate-y-1 transform transition">
                    <div class="flex items-center">
                        <x-carbon-pen-fountain class="h-6 w-6 text-[#1d6a6a] mr-4"/>
                        <h3 class="text-xl font-semibold text-[#1d6a6a]">LOMBA CERDAS CERMAT</h3>
                    </div>
                    <hr class="my-2">
                    <div class="mt-2 text-md text-gray-600 bg-red-50 font-semibold p-2 rounded-md">
                        <p class="font-medium italic">1 Kelompok 3 Peserta</p>
                        <p>Kategori SD Kelas 4-6</p>
                        <p>Kategori SMP Kelas 7-9</p>
                    </div>
                    <div class="text-md bg-white text-gray-600 font-semibold p-2 rounded-md">
                        <p>Infaq Lomba adalah sebesar Rp. 100.000,- /kelompok</p>
                    </div>
                    <div class="inline-block text-sm bg-slate-200 text-gray-600 font-medium p-2 rounded-md mt-2">
                        ** Usia ditentukan pertanggal 20 Januari 2026
                    </div>

                    <div class="bg-white border rounded-md mt-2 flex items-center justify-between p-2 w-full sm:w-1/3">
                        <h2 class="text-md font-semibold text-[#1d6a6a] mr-5">Petunjuk Teknis</h2>
                        <x-carbon-document-download class="inline h-5 w-5 text-gray-700"/>
                    </div>
                </div>
            </div>
            <hr class="border-white">
            <div class="max-w-xl mx-auto w-full">
                <Link href="{{ route('website.ramadhan.lomba.daftar') }}">
                    <div class="bg-[#1d6a6a] rounded-lg shadow-md p-4" >
                        <div class="flex flex-row items-center justify-between">
                            <div class="flex-3/4">
                                <h3 class="text-white text-lg font-semibold">Daftar Lomba Sekarang!</h3>
                                <p class="text-white text-sm font-medium ">Klik Disini untuk Pendaftaran Lomba</p>
                            </div>
                            <div class="flex-1/4 flex justify-end">
                                <x-carbon-select-window class="h-10 w-10 text-white"/>
                            </div>
                        </div>
                    </div>
                </Link>
            </div>
            <hr>
            <h2 class="text-2xl font-bold text-center mb-4 text-gray-700">Kontak</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
                <a class="bg-white rounded-lg shadow-md p-4 mb-4" href="https://wa.me/6285750223866">
                    <div class="flex flex-row items-center">
                        <div class="flex-1/4">
                            <img class="h-10 mr-4" src="{{ asset('assets/img/logo-wa.png') }}" alt="Ustad Zaky">
                        </div>
                        <div class="flex-3/4">
                            <h3 class="text-lg font-semibold">Ustadzah Widya</h3>
                            <p class="text-sm font-medium text-gray-700">085750223866</p>
                        </div>
                    </div>
                </a>
                <a class="bg-white rounded-lg shadow-md p-4 mb-4" href="https://wa.me/6281649329520">
                    <div class="flex flex-row items-center">
                        <div class="flex-1/4">
                            <img class="h-10 mr-4" src="{{ asset('assets/img/logo-wa.png') }}" alt="Ustad Zaky">
                        </div>
                        <div class="flex-3/4">
                            <h3 class="text-lg font-semibold">Ustad Zaky</h3>
                            <p class="text-sm font-medium text-gray-700">081649329520</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="flex flex-col items-center justify-center">
                <Link href="{{ route('website.ramadhan') }}" class="my-8 items-center px-4 py-2 border shadow-sm text-sm font-medium rounded-md text-white bg-[#deaa37]">
                    Kembali ke Halaman Utama
                </Link>
            </div>
        </div>

    </section>


</main>

@endsection
