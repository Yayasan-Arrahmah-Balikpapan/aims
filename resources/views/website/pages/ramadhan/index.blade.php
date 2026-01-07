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

    <section id="hero" class="relative overflow-hidden py-20 lg:py-32">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 via-white to-green-50"></div>
        <div class="absolute inset-0 opacity-5">
          <div class="absolute inset-0" style={{
            backgroundImage: `url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2310b981' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E")`
          }}></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <Badge class="mb-6 bg-gradient-to-r from-emerald-600 to-green-600 text-white border-0 px-4 py-1.5">
            <Sparkles class="w-3.5 h-3.5 mr-1" />
            Ramadhan 1446 H
          </Badge>
          <h1 class="text-4xl sm:text-5xl lg:text-7xl font-bold mb-6 bg-gradient-to-r from-emerald-800 via-green-600 to-emerald-700 bg-clip-text text-transparent">
            Semarak Ramadhan
          </h1>
          <p class="text-lg sm:text-xl text-gray-700 max-w-3xl mx-auto mb-8 leading-relaxed">
            Mari merayakan bulan suci Ramadhan dengan berbagai kegiatan yang penuh makna dan keberkahan.
            Dari persiapan pra-Ramadhan hingga perayaan Idul Fitri, bersama kita isi hari-hari penuh berkah.
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <Button
              size="lg"
              class="bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white shadow-lg shadow-emerald-200"
            >
              <x-carbon-calendar class="w-5 h-5 mr-2" />
              Lihat Jadwal Kegiatan
            </Button>
            <Button
              size="lg"
              onClick={() => scrollToSection('tips')}
              variant="outline"
              class="border-emerald-300 text-emerald-700 hover:bg-emerald-50"
            >
              <x-carbon-notification class="w-5 h-5 mr-2" />
              Tips Ramadhan
            </Button>
          </div>
          <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
            <div class="text-center">
              <div class="text-3xl font-bold text-emerald-700">30</div>
              <div class="text-sm text-gray-600">Hari Puasa</div>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold text-emerald-700">20+</div>
              <div class="text-sm text-gray-600">Kegiatan</div>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold text-emerald-700">500+</div>
              <div class="text-sm text-gray-600">Peserta</div>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold text-emerald-700">100%</div>
              <div class="text-sm text-gray-600">Keberkahan</div>
            </div>
          </div>
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
