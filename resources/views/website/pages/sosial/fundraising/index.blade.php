@extends('website.layouts.web')

@section('content')
<main>
    <section class="overflow-hidden sm:py-20 py-10 bg-white">
        <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0">
            <div class="flex flex-col lg:flex-row items-center gap-7 xl:gap-14">
                <div class="lg:max-w-[570px] w-full">
                    <img src="{{ asset('assets/img/masjid.png') }}" alt="about" class="w-full rounded-xl">
                </div>
                <div class="lg:max-w-[490px] w-full py-8">
                    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                        Program <text class="text-orange-700">Sosial</text> Arrahmah
                    </h1>
                    <p>
                        “Sedekah tidak akan mengurangi harta. Allah tidak menambah kepada seorang hamba yang pemaaf melainkan kemuliaan, dan tidaklah seseorang merendah diri karena Allah melainkan Allah akan mengangkat derajatnya.”
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white">
        <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
            <dl class="grid max-w-screen-md gap-8 mx-auto text-gray-900 dark:text-white">
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl md:text-4xl font-extrabold">
                        <x-carbon-location class="text-orange-700 w-16 h-16 lg:w-20 lg:h-20"/>
                    </dt>
                    <dd class="font-light text-gray-500 dark:text-gray-400">Perum. Spinggan Pratama, Balikpapan.</dd>
                </div>
            </dl>
        </div>
    </section>

    <section class="py-10 bg-[url('/assets/bg/bg-dots-1.png')] bg-repeat bg-orange-700">
        <div class="max-w-[1170px] mx-auto px-4 sm:px-10 xl:px-0">
            {{-- <h1 class="text-center text-white text-5xl font-bold py-10">
                Unit Pendidikan <text class="text-lime-300 "> LTTQ Arrahmah </text>
            </h1> --}}
            <div class="py-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-y-11 gap-x-7">
                    <Link href="#" class="group lg:col-start-1 lg:col-end-4">
                        <div class="border border-gray-3 sm:h-40 h:24 rounded-[20px] bg-gray p-5 sm:mr-5 bg-white group-hover:drop-shadow-1 group-hover:-translate-y-2 transition-all">
                            <div class="flex items-center gap-4">
                                <div class="">
                                    <img src="{{ asset('assets/logo-arrahmah/9.png') }}" class="sm:w-36 w-24"  alt="lttq">
                                </div>
                                <div>
                                    <h4 class="font-semibold text-xl text-dark mb-1">
                                        Baitul Maal
                                    </h4>
                                    <p>Program Donasi Yayasan Ar Rahmah Balikpapan</p>
                                </div>
                            </div>
                        </div>
                    </Link>
                    <Link href="#" class="group lg:col-start-4 lg:col-end-7">
                        <div class="border border-gray-3 sm:h-40 h:24 rounded-[20px] bg-gray p-5 sm:mr-5 bg-white group-hover:drop-shadow-1 group-hover:-translate-y-2 transition-all">
                            <div class="flex items-center gap-4">
                                <div class="">
                                    <img src="{{ asset('assets/logo-arrahmah/7.png') }}" class="sm:w-36 w-24"  alt="lttq">
                                </div>
                                <div>
                                    <h4 class="font-semibold text-xl text-dark mb-1">
                                        Mualaf Center Indonesia
                                    </h4>
                                    <p>Memfasilitasi Masyarakat yang akan masuk Islam</p>
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
