@extends('website.layouts.web')

@section('content')
<main>
    <section class="h-screen bg-[url('/assets/bg/bg-masjid-ramadhan.png')] relative overflow-hidden bg-no-repeat bg-contain bg-bottom bg-fixed">
        <div class="absolute inset-0 bg-gradient-to-br from-[#ffebcd] via-amber-100 to-amber-200 opacity-75"></div>
        <div class="relative max-w-7xl pt-12 mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex items-center justify-center mb-4">
                <img src="{{ asset('assets/logo/logo-ramadhan-1447h.png') }}" class="h-64 sm:h-32" alt="">
            </div>
            <p class="text-lg sm:text-xl max-w-3xl mx-auto mb-8 leading-relaxed font-semibold text-gradient-to-r from-[#1d6a6a] to-primary-800">
                Mari merayakan bulan suci Ramadhan dengan Yayasan Ar-Rahmah Balikpapan
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#kegiatan" class="p-2 rounded-md flex items-center bg-gradient-to-r bg-[#deaa37] text-white shadow-lg shadow-amber-200">
                    <x-carbon-calendar class="w-5 h-5 mr-2" />
                    Lihat Jadwal Kegiatan
                </a>
                <Link class="p-2 rounded-md flex items-center border border-[#deaa37] text-[#deaa37] bg-white shadow-lg shadow-amber-200 hover:bg-amber-50">
                    <x-carbon-notification class="w-5 h-5 mr-2" />
                    Lomba-lomba
                </Link>
            </div>
            <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                <div class="text-center">
                    <div class="text-3xl font-bold text-[#1d6a6a]">Lomba Islami</div>
                    <div class="text-sm text-gray-600">3-14 Tahun</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-[#1d6a6a]">Pawai</div>
                    <div class="text-sm text-gray-600">Kegiatan</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-[#1d6a6a]">500+</div>
                    <div class="text-sm text-gray-600">Peserta</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-[#1d6a6a]">100%</div>
                    <div class="text-sm text-gray-600">Keberkahan</div>
                </div>
            </div>
            {{-- <div class="hidden sm:block py-8 mt-12 text-center max-w-md mx-auto text-lg border border-[#8badad] rounded-md ">
                <div class="flex justify-center font-bold text-2xl text-[#deaa37]">
                  مَنْ صَامَ رَمَضَانَ إِيمَانًا وَاحْتِسَابًا غُفِرَ لَهُ مَا تَقَدَّمَ مِنْ ذَنْبِهِ
                </div>
                <div class="flex justify-center mt-4 italic text-[#073e3e] text-xs">
                  "Barang siapa yang berpuasa di bulan Ramadhan karena iman dan mengharap pahala dari Allah, maka akan diampuni dosa-dosanya yang telah lalu."
                  <br>
                  (HR. Bukhari dan Muslim)
                </div>
            </div> --}}
        </div>
    </section>

    <section class="py-10 bg-[url('/assets/bg/bg-dots-1.png')] bg-repeat bg-[#317f80]">
        <div class="max-w-md mx-auto px-4 sm:px-10 xl:px-0">
            <div class="py-10">
                <div class="rounded-md border border-gray-300">
                    <style>
                        iframe {
                            background: transparent;
                        }
                    </style>
                    <iframe width="100%" height="600" src="https://www.youtube.com/embed/yUV2bOYYLHk?modestbranding=1&showinfo=0&autoplay=1&mute=1&loop=1&controls=0&rel=0" title="Semarak Ramadhan Arrahmah" referrerpolicy="no-referrer-when-downgrade" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    <section id="kegiatan" class="py-10 bg-[url('/assets/img/masjid.png')] bg-left-bottom relative overflow-hidden bg-no-repeat bg-[#fff3e1]">
        <div class="bg-[url('/assets/img/masjid.png')] bg-fixed bg-cover bg-no-repeat bg-right-bottom bg-[#fff3e1]"></div>
        <div class="max-w-lg mx-auto px-4 sm:px-10 xl:px-0">
            <div class="py-10 mb-52 sm:mb-0 ">
                <div class="pb-10">
                    <h2 class="text-3xl font-bold text-[#1d6a6a]">Kegiatan Semarak Ramadhan</h2>
                    <p>Insya Allah Kegiatan Pra Ramadhan Hingga Akhir Ramadhan</p>
                </div>

                <ol class="relative border-s border-default">
                    <li class="mb-10 ms-6">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-[#deaa37] rounded-full -start-3">
                            <x-carbon-star-filled class="w-4 h-4 text-white" />
                        </span>
                        <time class="bg-[#1d6a6a] text-heading text-xs  font-medium px-1.5 py-0.5 rounded text-white border border-white">7,8,14,15 Februari 2026</time>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-heading my-2">Lomba-Lomba Anak
                            <span class="ms-2 bg-[#deaa37] border border-white text-white text-xs font-medium px-1.5 py-0.5 rounded">Untuk UMUM</span></h3>
                        <p class="mb-4 text-body">Loba Mewarnai, Lomba Adzan, Lomba Tahfizh. Usia Peserta 3-14 tahun</p>
                        <div class="flex items-center gap-4">
                            <Link href="#" class="inline-flex items-center text-body bg-[#deaa37] text-white box-border border border-white rounded-md hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 text-sm px-4 py-2.5 focus:outline-none">
                                <svg class="w-4 h-4 me-1.5 -ms-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M10 3v4a1 1 0 0 1-1 1H5m14-4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Zm-4 1h.01v.01H15V5Zm-2 2h.01v.01H13V7Zm2 2h.01v.01H15V9Zm-2 2h.01v.01H13V11Zm2 2h.01v.01H15V13Zm-2 2h.01v.01H13V15Zm2 2h.01v.01H15V17Zm-2 2h.01v.01H13V19Z"/></svg>
                                Informasi
                            </Link>
                            <Link href="#" class="inline-flex items-center text-body bg-[#1d6a6a] text-white box-border border border-white rounded-md hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 text-sm px-4 py-2.5 focus:outline-none">
                                Daftar Lomba <x-carbon-arrow-right class="w-4 h-4 ms-1" />
                            </Link>
                        </div>

                    </li>
                    <li class="mb-10 ms-6">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-[#deaa37] rounded-full -start-3">
                            <x-carbon-calendar class="w-4 h-4 text-white" />
                        </span>
                        <time class="bg-[#1d6a6a] text-heading text-xs font-medium px-1.5 py-0.5 rounded text-white border border-white">15 Februari 2026</time>
                        <h3 class="my-2 text-lg font-semibold text-heading">Pawai & Tabligh Akbar</h3>
                        <p class="text-body">Hingga 200 Peserta Pawai & Tabligh Akbar</p>
                    </li>
                    <li class="mb-10 ms-6">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-[#deaa37] rounded-full -start-3">
                            <x-carbon-calendar class="w-4 h-4 text-white" />
                        </span>
                        <time class="bg-[#1d6a6a] text-heading text-xs font-medium px-1.5 py-0.5 rounded text-white border border-white">1 - 20 Ramadhan 1447H</time>
                        <h3 class="my-2 text-lg font-semibold text-heading">Tahsin Ikhwan & Akhwat</h3>
                        <p class="text-body">Program perbaikan bacaan quran di Masjid Arrahmah.</p>
                        <hr class="my-2">
                        <h3 class="my-2 text-lg font-semibold text-heading">Kisah Anak Menjelang Berbuka</h3>
                        <p class="text-body">Program Kisah motivasi untuk anak di masjid saat menjelang berbuka puasa.</p>
                    </li>
                    <li class="mb-10 ms-6">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-[#deaa37] rounded-full -start-3">
                            <x-carbon-calendar class="w-4 h-4 text-white" />
                        </span>
                        <time class="bg-[#1d6a6a] text-heading text-xs font-medium px-1.5 py-0.5 rounded text-white border border-white">1 - 30 Ramadhan 1447H</time>
                        <h3 class="my-2 text-lg font-semibold text-heading">Takjil Berbuka Bersama</h3>
                        <h3 class="my-2 text-lg font-semibold text-heading">Sholat Tarawih Bersama (Riwayat Warsh & Hafs)</h3>
                        <h3 class="my-2 text-lg font-semibold text-heading">Kultum Sebelum Sholat Tarawih</h3>
                        <h3 class="my-2 text-lg font-semibold text-heading">Kajian Rutin Bada Subuh</h3>
                        <h3 class="my-2 text-lg font-semibold text-heading">Kajian Duha</h3>
                    </li>
                    <li class="mb-10 ms-6">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-[#deaa37] rounded-full -start-3">
                            <x-carbon-calendar class="w-4 h-4 text-white" />
                        </span>
                        <time class="bg-[#1d6a6a] text-heading text-xs font-medium px-1.5 py-0.5 rounded text-white border border-white">20 Februari - 5 Maret 2026</time>
                        <h3 class="my-2 text-lg font-semibold text-heading">Pesrom Emak-emak</h3>
                        <p class="text-body">Pesantren Ramadhan untuk ibu-ibu dengan kegiatan kajian dan mengaji tahsin.</p>
                    </li>
                    <li class="mb-10 ms-6">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-[#deaa37] rounded-full -start-3">
                            <x-carbon-calendar class="w-4 h-4 text-white" />
                        </span>
                        <time class="bg-[#1d6a6a] text-heading text-xs font-medium px-1.5 py-0.5 rounded text-white border border-white">28 Februari, 1,7,8 Maret 2026</time>
                        <h3 class="my-2 text-lg font-semibold text-heading">Pesrom Anak-anak</h3>
                        <p class="text-body">Pesantren Ramadhan untuk anak-anak dengan banyak kegiatan islami.</p>
                    </li>
                    <li class="mb-10 ms-6">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-[#deaa37] rounded-full -start-3">
                            <x-carbon-favorite-filled class="w-4 h-4 text-white" />
                        </span>
                        <time class="bg-[#1d6a6a] text-heading text-xs font-medium px-1.5 py-0.5 rounded text-white border border-white">7-8 Maret 2026</time>
                        <h3 class="my-2 text-lg font-semibold text-heading bg-[#fff3e1] rounded-md">Baksos</h3>
                        <p class="text-body bg-[#fff3e1] rounded-md">Penyebaran baksos bagi yang membutuhkan.</p>
                    </li>
                    <li class="mb-10 ms-6">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-[#deaa37] rounded-full -start-3">
                            <x-carbon-star-filled class="w-4 h-4 text-white" />
                        </span>
                        <time class="bg-[#1d6a6a] text-heading text-xs font-medium px-1.5 py-0.5 rounded text-white border border-white">21 - 30 Ramadhan 1447H</time>
                        <h3 class="my-2 text-lg font-semibold text-heading bg-[#fff3e1] rounded-md">Itikaf</h3>
                        <p class="text-body bg-[#fff3e1] rounded-md">Itikaf bersama di Masjid Arrahmah. Jam 22.00 Wita & Jam 02.00 Wita.</p>
                        <hr class="my-2">
                        <h3 class="my-2 text-lg font-semibold text-heading bg-[#fff3e1] rounded-md">Sahur dan Makan berbuka bersama di Masjid</h3>
                        <p class="text-body mb-10 bg-[#fff3e1] rounded-md">Gratis bagi pendaftar program itikaf kami.</p>
                    </li>
                    <li class="mb-10 ms-6">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-[#deaa37] rounded-full -start-3">
                            <x-carbon-star-filled class="w-4 h-4 text-white" />
                        </span>
                        <time class="bg-[#1d6a6a] text-heading text-xs font-medium px-1.5 py-0.5 rounded text-white border border-white">1 Syawal 1447H</time>
                        <h3 class="my-2 text-lg font-semibold text-heading bg-[#fff3e1] rounded-md">Sholat Idul Fitri</h3>
                        <p class="text-body bg-[#fff3e1] rounded-md">Sholat Idul Fitri bersama di area perumahan spinggan pratama.</p>
                    </li>
                </ol>
            </div>
        </div>
    </section>

    <section class="py-10 bg-[url('/assets/bg/bg-dots-1.png')] bg-repeat bg-[#317f80]">
        <div class="max-w-5xl mx-auto px-4 sm:px-10 xl:px-0">
            <div class="py-10">
                <div class="">
                    <div class="pb-10 text-center">
                        <h2 class="text-3xl font-bold text-[#deaa37]">Donasi Ramadhan Arrahmah</h2>
                        <p class="text-white">Transfer Rekening atau Langsung QRIS</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-4 rounded-md border border-gray-300 bg-[#deaa37] flex flex-col items-center justify-center">
                            <img src="{{ asset('assets/pembayaran/bsi.png') }}" class="mb-4" alt="">
                            <div class="text-xl font-bold text-white">556-778-0001</div>
                            <div class="text-xl font-bold text-white">AN. MASJID ARRAHMAH</div>
                            <div class="text-sm text-white font-semibold">Kode Tambahan 3 Digit Terakhir</div>
                            <ul class="list-disc text-sm text-white">
                                <li>Buka Puasa : 111 </li>
                                <li>Bakti Sosial : 222</li>
                                <li>Kajian Islam : 333</li>
                                <li>I'tikaf : 444</li>
                                <li>Kebersihan, Fasilitas, dll : 555</li>
                            </ul>
                        </div>
                        <div class="p-4 rounded-md border border-gray-300 bg-[#deaa37] flex flex-col items-center justify-center">
                            <img src="{{ asset('assets/img/qris-ramadhan.png') }}" class="h-52" alt="">
                            <div class="text-xl font-bold text-white">RAMADHAN ARRAHMAH</div>
                            <div class="text-sm text-gray-100">NMID : ID2021139744449A01</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gradient-to-br from-[#ffebcd] via-amber-100 to-amber-200 ">
        <div class="relative max-w-4xl pt-12 mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-[#1d6a6a]">Yang Sering Ditanyakan</h2>
            <div class="grid grid-cols-1 gap-6 pt-6">
                <div class="bg-[#deaa37] p-4 rounded-md">
                    <h3 class="text-lg font-bold text-[#1d6a6a]">Q: Apa tujuan dari program Ramadhan Arrahmah?</h3>
                    <p class="text-sm text-white">A: Program Ramadhan Arrahmah bertujuan untuk memberikan kesempatan kepada masyarakat untuk mengenalakan potensi diri dalam berbagai bidang kehidupan.</p>
                </div>
                <div class="bg-[#deaa37] p-4 rounded-md">
                    <h3 class="text-lg font-bold text-[#1d6a6a]">Q: Siapa yang harus saya lakukan untuk mengikuti program Ramadhan Arrahmah?</h3>
                    <p class="text-sm text-white">A: Anda harus melakukan pendaftaran melalui form yang telah disediakan.</p>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
