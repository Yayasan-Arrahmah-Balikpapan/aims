
<footer class="px-4 py-10 bg-gray-50 sm:p-6 dark:bg-gray-800">
    <div class="mx-auto max-w-screen-xl">
        <div class="md:flex md:justify-between flex-row">
            <div class="basis-1/4">
                <div class="mb-6 md:mb-0">
                    <Link href="/" class="flex items-center">
                        <img src="{{ url('/') }}/assets/img/logo-arrahmah.png" class="mr-3 h-12 sm:h-12" alt="Arrahmah Logo" />
                    </Link>
                </div>
            </div>
            <div class="basis-3/4">
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-4 text-xs">
                    <div>
                        <h2 class="mb-6 font-semibold text-gray-900 uppercase dark:text-white">Yayasan</h2>
                        <ul class="text-gray-600 dark:text-gray-400">
                            <li class="mb-4">
                                <Link href="#" class="hover:underline">Visi & Misi</Link>
                            </li>
                            <li class="mb-4">
                                <Link href="#" class="hover:underline">Struktur</Link>
                            </li>
                            <li class="mb-4">
                                <Link href="#" class="hover:underline">Metode Al-Haq</Link>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 font-semibold text-gray-900 uppercase dark:text-white">Pendidikan</h2>
                        <ul class="text-gray-600 dark:text-gray-400">
                            <li class="mb-4">
                                <Link href="{{ route('website.lttq.tahsin') }}" class="hover:underline">Tahsin</Link>
                            </li>
                            <li class="mb-4">
                                <Link href="{{ route('website.lttq.tla') }}" class="hover:underline">Tahfizh Lil Athfal</Link>
                            </li>
                            <li class="mb-4">
                                <Link href="{{ route('website.lttq.rq') }}" class="hover:underline">Roudhotul Quran</Link>
                            </li>
                            <li class="mb-4">
                                <Link href="{{ route('website.lttq.rtq-putra') }}" class="hover:underline">Rumah Tahfizh Quran Putra</Link>
                            </li>
                            <li class="mb-4">
                                <Link href="{{ route('website.lttq.rtq-putri') }}" class="hover:underline">Rumah Tahfizh Quran Putri</Link>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 font-semibold text-gray-900 uppercase dark:text-white">Ibadah</h2>
                        <ul class="text-gray-600 dark:text-gray-400">
                            <li class="mb-4">
                                <Link href="#" class="hover:underline">DKM Masjid</Link>
                            </li>
                            <li class="mb-4">
                                <Link href="#" class="hover:underline">Majelis Kajian Akhwat</Link>
                            </li>
                            <li class="mb-4">
                                <Link href="#" class="hover:underline">Ikatan Remaja Masjid</Link>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 font-semibold text-gray-900 uppercase dark:text-white">Sosial</h2>
                        <ul class="text-gray-600 dark:text-gray-400">
                            <li class="mb-4">
                                <Link href="#" class="hover:underline">Laziz</Link>
                            </li>
                            <li class="mb-4">
                                <Link href="#" class="hover:underline">Mualaf Center Indonesia</Link>
                            </li>
                            <li class="mb-4">
                                <Link href="#" class="hover:underline">Klinik Sehat Cahaya</Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <div class="flex flex-wrap justify-center items-center">
            <span class="text-sm text-gray-500 text-center dark:text-gray-400">© {{ date('Y') }} <Link href="#" class="hover:underline">Yayasan Arrahmah Balikpapan</Link>.
            </span>
        </div>
    </div>
</footer>
