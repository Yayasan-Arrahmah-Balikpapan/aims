@extends('website.layouts.web')

@section('content')
<main>
    <section class="overflow-hidden sm:py-20 py-10 bg-white">
        <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0">
            <div class="flex flex-col lg:flex-row items-center gap-7 xl:gap-14">
                <div class="lg:max-w-[570px] w-full">
                    <img src="{{ asset('assets/img/lttq/2.jpg') }}" alt="about" class="w-full rounded-xl">
                </div>
                <div class="lg:max-w-[490px] w-full py-8">
                    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                        Lembaga <text class="text-primary-800">Tahsin Tahfizhil</text> Quran
                    </h1>
                    <p>
                        “Sesungguhnya orang yang paling utama di antara kalian adalah yang belajar Al-Qur`an dan mengajarkannya.”
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white">
        <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
            <dl class="grid max-w-screen-md gap-8 mx-auto text-gray-900 sm:grid-cols-2 dark:text-white">
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl md:text-4xl font-extrabold">1300+</dt>
                    <dd class="font-light text-gray-500 dark:text-gray-400">Peserta Didik Aktif</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl md:text-4xl font-extrabold">50+</dt>
                    <dd class="font-light text-gray-500 dark:text-gray-400">Pengajar</dd>
                </div>
            </dl>
        </div>
      </section>

    <section class="py-10 bg-[url('/assets/bg/bg-dots-1.png')] bg-repeat bg-[#0b661d]">
        <div class="max-w-[1170px] mx-auto px-4 sm:px-10 xl:px-0">
            <h1 class="text-center text-white text-5xl font-bold py-10">
                Unit Pendidikan <text class="text-lime-300 "> LTTQ Arrahmah </text>
            </h1>
            <div class="py-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-y-11 gap-x-7">
                    <Link href="{{ route('website.lttq.tahsin.pendaftaran') }}" class="group lg:col-start-1 lg:col-end-3">
                        <div class="border border-gray-3 sm:h-40 h:24 rounded-[20px] bg-gray p-5 sm:mr-5 bg-white group-hover:drop-shadow-1 group-hover:-translate-y-2 transition-all">
                            <div class="flex items-center gap-4">
                                <div class="">
                                    <img src="{{ asset('assets/logo/tahsin.jpg') }}" class="sm:w-36 w-24"  alt="lttq">
                                </div>
                                <div>
                                    <h4 class="font-semibold text-xl text-dark mb-1">
                                        Tahsin
                                    </h4>
                                    <p>Program perbaikan bacaan Al Qur'an</p>
                                </div>
                            </div>
                        </div>
                    </Link>
                    <Link href="#" class="group lg:col-start-3 lg:col-end-5">
                        <div class="border border-gray-3 sm:h-40 h:24 rounded-[20px] bg-gray p-5 sm:mx-5 bg-white group-hover:drop-shadow-1 group-hover:-translate-y-2 transition-all">
                            <div class="flex items-center gap-4">
                                <div class="">
                                    <img src="{{ asset('assets/logo/rq.png') }}" alt="rq" class="sm:w-36 w-24">
                                </div>
                                <div>
                                    <h4 class="font-semibold text-xl text-dark mb-1">
                                        Raudhotul Qur'an
                                    </h4>
                                    <p>Pendidikan Quran anak usia 3-6 Tahun</p>
                                </div>
                            </div>
                        </div>
                    </Link>
                    <Link href="#" class="group lg:col-start-5 lg:col-end-7">
                        <div class="border border-gray-3 sm:h-40 h:24 rounded-[20px] bg-gray p-5 sm:ml-2 bg-white group-hover:drop-shadow-1 group-hover:-translate-y-2 transition-all">
                            <div class="flex items-center gap-4">
                                <div class="">
                                    <img src="{{ asset('assets/logo/tla.jpg') }}" alt="tla" class="sm:w-36 w-24">
                                </div>
                                <div>
                                    <h4 class="font-semibold text-xl text-dark mb-1">
                                        Tahfizh Lil Atfhal
                                    </h4>
                                    <p>Pendidikan Quran Tahfizh anak usia 7-15 Tahun</p>
                                </div>
                            </div>
                        </div>
                    </Link>
                    <Link href="#" class="group lg:col-start-2 lg:col-end-4">
                        <div class="border border-gray-3 sm:h-40 h:24 rounded-[20px] bg-gray p-5 sm:mr-5 bg-white group-hover:drop-shadow-1 group-hover:-translate-y-2 transition-all">
                            <div class="flex items-center gap-4">
                                <div class="">
                                    <img src="{{ asset('assets/logo/rtq-putra.jpg') }}" alt="rtq-putra" class="sm:w-36 w-24">
                                </div>
                                <div>
                                    <h4 class="font-semibold text-xl text-dark mb-1">
                                        RTQ Putra
                                    </h4>
                                    <p>Rumah Tafizhil Qur'an Putra</p>
                                </div>
                            </div>
                        </div>
                    </Link>
                    <Link href="#" class="group lg:col-start-4 lg:col-end-6">
                        <div class="border border-gray-3 sm:h-40 h:24 rounded-[20px] bg-gray p-5 sm:ml-2 bg-white group-hover:drop-shadow-1 group-hover:-translate-y-2 transition-all">
                            <div class="flex items-center gap-4">
                                <div class="">
                                    <img src="{{ asset('assets/logo/rtq-putri.jpg') }}" alt="rtq-putri" class="sm:w-36 w-24">
                                </div>
                                <div>
                                    <h4 class="font-semibold text-xl text-dark mb-1">
                                        RTQ Putri
                                    </h4>
                                    <p>Rumah Tafizhil Qur'an Putri</p>
                                </div>
                            </div>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
