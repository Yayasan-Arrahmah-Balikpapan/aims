@extends('website.layouts.web')

@section('content')
    <section class="py-10 bg-[url('/assets/bg/bg-dots-1.png')] bg-repeat bg-sky-600">
        <div class="max-w-xl px-4 py-16 mx-auto lg:gap-8 xl:gap-0 lg:py-24 text-center">
            <div class="bg-white rounded-lg p-8">
                <div class="flex justify-center items-center">
                    <img src="{{ url('/') }}/assets/logo/tahsin.jpg" class="h-64 mb-10" alt="LTTQ Tahsin" />
                </div>

                <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl lg:text-6xl text-sky-600">
                    Divisi
                    <span class="underline underline-offset-2 decoration-8 decoration-sky-700 ">Tahsin</span>
                </h1>
                <p class="mb-6 text-lg font-normal text-gray-700 lg:text-xl sm:px-16">
                    Pendidikan Perbaikan bacaan Al-Quran usia peserta minimal 15 Tahun selama 4 Bulan (Ikhwan & Akhwat).
                </p>
            </div>
        </div>
    </section>

    {{-- <section class="bg-white py-20">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="max-w-screen-lg mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    Kenapa Kita Harus Belajar Tahsin Di Ar Rahmah ?
                </h2>
                <p class="text-gray-500 sm:text-xl dark:text-gray-400">
                    Yang Insya Allah berikut poin-poin yang kami tawarkan kepada calon Peserta Tahsin LTTQ Arrahmah Balikpapan
                </p>
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-sky-100 lg:h-12 lg:w-12">
                        <svg class="w-5 h-5 text-sky-600 lg:w-6 lg:h-6 dark:text-sky-300" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Metode Pembelajaran Sistematis</h3>
                    <p class="text-gray-500 dark:text-gray-400">Menggunakan Metode Al-Haqq yang sistematis. Pembelajaran bertahap sesuai level dan kemampuan peserta.</p>
                </div>
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-sky-100 lg:h-12 lg:w-12">
                        <svg class="w-5 h-5 text-sky-600 lg:w-6 lg:h-6 dark:text-sky-300" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Pembelajaran Offline & Online</h3>
                    <p class="text-gray-500 dark:text-gray-400">Menjangkau seluruh masyarakat indonesia. Baik belajar di Masjid Arrahmah atau dimanapun.</p>
                </div>
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-sky-100 lg:h-12 lg:w-12">
                        <svg class="w-5 h-5 text-sky-600 lg:w-6 lg:h-6 dark:text-sky-300" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                            <path
                                d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Pengajar Yang Bersertifikasi</h3>
                    <p class="text-gray-500 dark:text-gray-400">Pengajar sudah tersertifikasi dan terjaga bacaannya melalui program Pengajar Wajib Talaqqi setiap pekannya.</p>
                </div>
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-sky-100 lg:h-12 lg:w-12">
                        <svg class="w-5 h-5 text-sky-600 lg:w-6 lg:h-6 dark:text-sky-300" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z">
                            </path>
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Dibimbing Oleh Ustad Saiful Anwar LC, MA</h3>
                    <p class="text-gray-500 dark:text-gray-400">Perancang Metode Al-Haqq dan pemilik sanad yang bersambung hinga Rasulullah.</p>
                </div>
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-sky-100 lg:h-12 lg:w-12">
                        <svg class="w-5 h-5 text-sky-600 lg:w-6 lg:h-6 dark:text-sky-300" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Berpengalaman Sejak 2012</h3>
                    <p class="text-gray-500 dark:text-gray-400">Perancang Metode Al-Haqq dan pemilik sanad yang bersambung hinga Rasulullah.</p>
                </div>
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-sky-100 lg:h-12 lg:w-12">
                        <svg class="w-5 h-5 text-sky-600 lg:w-6 lg:h-6 dark:text-sky-300" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Pilihan Waktu Fleksibel</h3>
                    <p class="text-gray-500 dark:text-gray-400">Kami menawarkan pilihan waktu dan jam belejar yang dapat dipilih sesuai keinginan.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-[url('/assets/bg/bg-dots-1.png')] bg-repeat bg-sky-600">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <img class="h-auto max-w-full rounded-lg shadow-lg"
                    src="{{ url('/') }}/assets/tahsin/1.jpg" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg shadow-lg"
                    src="{{ url('/') }}/assets/tahsin/2.jpg" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg shadow-lg"
                    src="{{ url('/') }}/assets/tahsin/3.jpg" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg shadow-lg"
                    src="{{ url('/') }}/assets/tahsin/4.jpg" alt="">
            </div>
        </div>
    </section>

    <section class="bg-white bg-[url('/assets/bg/bg-dots-1.png')] bg-repeat py-20">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">

                <div></div>
                <!-- Pricing Card -->
                <div
                    class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow">
                    <h3 class="mb-4 text-4xl font-semibold">Infaq Belajar</h3>
                    <p class=" mb-8 font-light text-gray-500 sm:text-lg dark:text-gray-400">1 Periode Pembelajaran selama 4 Bulan</p>

                    <!-- List -->
                    <ul role="list" class="mb-8 space-y-2 text-left">
                        <li class="flex justify-between items-center space-x-3">
                            <span>Biaya Pendaftaran</span>
                            <span class="font-bold">RP. 150.000</span>
                        </li>

                        <li class="flex justify-between items-center space-x-3">
                            <span>SPP</span>
                            <span class="font-bold">RP. 100.000</span>
                        </li>
                        <li class="flex justify-between items-center space-x-3">
                            <span>Modul Per Level</span>
                            <span class="font-bold">RP. 35.000</span>
                        </li>
                        <li class="flex justify-between items-center space-x-3">
                            <span>Buku Prestasi</span>
                            <span class="font-bold">RP. 25.000</span>
                        </li>
                        <li class="flex justify-between items-center space-x-3">
                            <span>Mushaf Rasm Utsmani*</span>
                            <span class="font-bold">RP. 115.000</span>
                        </li>
                        <span class="text-sm text-gray-500 font-light">*Jika Belum memiliki</span>

                    </ul>
                    <a href="{{ route('website.lttq.tahsin.pendaftaran') }}"
                        class="text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:ring-sky-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-sky-900">
                        Daftar
                    </a>
                </div>
                <!-- Pricing Card -->
                <div></div>
            </div>
        </div>
    </section>

    <section class="py-10 bg-[url('/assets/bg/bg-dots-1.png')] bg-repeat bg-sky-600">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-3xl mx-4 sm:mx-auto">
            <div class="bg-white p-8 rounded-lg">
                <ul role="list" class="space-y-2">
                    <li class="flex justify-between items-center space-x-3">
                        <span>Admin Ikhwan</span>
                        <span class="font-bold">6282149604546</span>
                    </li>
                </ul>
            </div>
            <div class="bg-white p-8 rounded-lg">
                <ul role="list" class="space-y-2">
                    <li class="flex justify-between items-center space-x-3">
                        <span>Admin Akhwat</span>
                        <span class="font-bold">6281930418501</span>
                    </li>
                </ul>
            </div>
        </div>
    </section> --}}
@endsection
