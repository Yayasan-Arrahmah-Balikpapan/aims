<x-app-layout>
    <Dashboard :tabs="[
            { title: 'Dashboard'},
            { title: 'Peserta'},
            { title: 'Aktivitas'},
            { title: 'Akun'}
        ]"
        :initial-tab="0"
    >
        <template v-slot:tab-icon-0>
            <x-carbon-dashboard class="w-6 h-6 my-1" />
        </template>
        <template v-slot:tab-icon-1>
            <x-carbon-user-multiple class="w-6 h-6 my-1" />
        </template>
        <template v-slot:tab-icon-2>
            <x-carbon-list-dropdown class="w-6 h-6 my-1" />
        </template>
        <template v-slot:tab-icon-3>
            <x-carbon-user-avatar class="w-6 h-6 my-1" />
        </template>

        <template v-slot:tab-content-0>
            <div class="bg-white">
                <section class="max-w-7xl mx-auto bg-no-repeat bg-center bg-cover sm:bg-auto sm:bg-left bg-primary-800 bg-[url('/assets/bg/bg-dashboard.png')] h-[175px] sm:h-[300px] mb-20 sm:mb-32"
                    style="background-image: url({{ asset('assets/img/masjid.png') }});">
                    <div class="p-4 sm:px-6 item-center  gap-4">
                        <div class="mt-36 sm:mt-52 bg-white rounded-lg shadow-sm border border-gray-200 p-4 sm:p-8">
                            <div class="flex gap-4">
                                <div class="flex items-center justify-center">
                                    <span class="bg-sky-500 rounded-full h-6 sm:h-10 w-6 sm:w-10 flex items-center justify-center">
                                        <x-carbon-user-filled class="sm:h-6 h-4 text-white" />
                                    </span>
                                </div>
                                <div class="grow">
                                    <h2 class="text-md sm:text-lg text-gray-800 text-md font-bold">{{ auth()->user()->name ?? '-' }}</h2>
                                    <p class="text-sm sm:text-md text-gray-600">{{ auth()->user()->phone_number }}</p>
                                </div>
                                <div class="text-center">
                                    <h1 class="text-xl sm:text-2xl font-bold text-gray-600"> {{ $count_peserta }}</h1>
                                    <span class="text-white bg-sky-500 rounded-sm px-2 font-semibold text-[10px]">PESERTA</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="max-w-7xl mx-auto bg-white text-center text-sm">
                </section>
                <section class="max-w-7xl mx-auto bg-white text-center text-sm">
                    <div class="grid grid-cols-4 gap-4 p-6">
                        <div class="inline-flex flex-col items-center">
                            <img src="{{ asset('assets/icon/icon-pendidikan.png') }}" class="h-16 sm:h-24" alt="icon-pendidikan">
                            <span class="sm:font-bold font-semibold text-gray-800 ">Pendidikan LTTQ</span>
                        </div>
                        <div class="inline-flex flex-col items-center">
                            <img src="{{ asset('assets/icon/icon-masjid.png') }}" class="h-16 sm:h-24" alt="icon-masjid">
                            <span class="sm:font-bold font-semibold text-gray-800 ">Masjid</span>
                        </div>
                        <div class="inline-flex flex-col items-center">
                            <img src="{{ asset('assets/icon/icon-tahsin.png') }}" class="h-16 sm:h-24" alt="icon-tahsin">
                            <span class="sm:font-bold font-semibold text-gray-800 ">Tahsin</span>
                        </div>
                        <Link href="{{ route('dashboard.peserta.agenda') }}" class="inline-flex flex-col items-center">
                            <img src="{{ asset('assets/icon/icon-agenda.png') }}" class="h-16 sm:h-24" alt="icon-agenda">
                            <span class="sm:font-bold font-semibold text-gray-800 ">Agenda</span>
                        </Link>
                        <div class="inline-flex flex-col items-center">
                            <img src="{{ asset('assets/icon/icon-kajian.png') }}" class="h-16 sm:h-24" alt="icon-kajian">
                            <span class="sm:font-bold font-semibold text-gray-800 ">Kajian</span>
                        </div>
                        <div class="inline-flex flex-col items-center">
                            <img src="{{ asset('assets/icon/icon-infaq-zakat.png') }}" class="h-16 sm:h-24" alt="icon-infaq-zakat">
                            <span class="sm:font-bold font-semibold text-gray-800 ">Fundrising</span>
                        </div>
                        <div class="inline-flex flex-col items-center">
                            <img src="{{ asset('assets/icon/icon-informasi.png') }}" class="h-16 sm:h-24" alt="icon-informasi">
                            <span class="sm:font-bold font-semibold text-gray-800 ">Informasi</span>
                        </div>
                        <div class="inline-flex flex-col items-center">
                            <img src="{{ asset('assets/icon/icon-lainnya.png') }}" class="h-16 sm:h-24" alt="icon-lainnya">
                            <span class="sm:font-bold font-semibold text-gray-800 ">Lainnya</span>
                        </div>
                    </div>

                    <div class="px-6 py-2">
                        <div class="bg-primary-700 px-2 font-medium mx-4 rounded-md flex items-center justify-between text-white text-xs">
                            Yayasan Ar Rahmah Balikpapan
                            <x-carbon-chevron-right class="w-6 h-6 my-1" />
                        </div>
                    </div>
                </section>
            </div>
            <section class="max-w-7xl mx-auto p-12 bg-white text-sm">
                <h2 class="text-xl font-bold pb-2">Daftar</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <Link href="{{ route('website.lttq.tahsin.pendaftaran') }}" class="grid grid-cols-2 border rounded-xl shadow-md ">
                        <img src="{{ asset('assets/banner/1.png') }}" class="rounded-s-xl" alt="1" loading="lazy">
                        <div class="px-4 py-2 flex flex-col justify-between items-start">
                            <div class="text-left">
                                <p class="text-gray-800 text-xl lg:text-3xl font-bold">Program Perbaikan Bacaan Al-Quran</p>
                                <p class="text-gray-600 text-sm">Angkatan 27</p>
                            </div>
                            <div class="flex items-center">
                                <x-carbon-time-filled class="w-4 text-primary-700 mr-2" />
                                <p class="text-gray-600 text-xs">Agus-Nov 2025</p>
                            </div>
                        </div>
                    </Link>
                </div>
            </section>

            <x-splade-lazy>
                <x-slot:placeholder>
                    <div class="pt-10 pb-10 px-4">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="rounded-lg border border-gray-300 p-4">
                                <div class="flex animate-pulse space-x-4">
                                    <div class="size-10 rounded-full bg-gray-200"></div>
                                    <div class="flex-1 space-y-6 py-1">
                                        <div class="h-2 rounded bg-gray-200"></div>
                                        <div class="space-y-3">
                                            <div class="grid grid-cols-3 gap-4">
                                                <div class="col-span-2 h-2 rounded bg-gray-200"></div>
                                                <div class="col-span-1 h-2 rounded bg-gray-200"></div>
                                            </div>
                                            <div class="h-2 rounded bg-gray-200"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-slot:placeholder>
                @if ($user->getRoleNames()->isNotEmpty())
                <div class="pt-10 pb-10 px-4">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <h1 class="text-2xl font-bold mb-4">Akses</h1>
                        <div class="border-b border-gray-300 my-4"></div>
                        <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-4">
                            @forelse ($user->getRoleNames() as $role)
                            <x-partials.list-item>
                                <x-slot:title>{{ $role }}</x-slot>
                                <x-slot:link>@include('components.role.redirect-dashboard')</x-slot>
                            </x-partials.list-item>
                            @empty

                            @endforelse
                        </div>
                    </div>
                </div>
                @else

                @endif
            </x-splade-lazy>

            <div class="bg-primary-800">
                <section class="max-w-7xl mx-auto p-12  text-sm">
                    <h2 class="text-xl font-bold pb-2 text-white">Pendidikan LTTQ</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div class="bg-white rounded-xl shadow-md">
                            <img src="{{ asset('assets/banner/2.png') }}" class="rounded-t-xl" alt="2" loading="lazy">
                            <div class="px-4 py-2 h-28 sm:h-36 flex flex-col justify-between">
                                <p class="text-gray-800 font-bold text-xl">RTQ PUTRA</p>
                                <p class="text-gray-600 text-md">Program Pendidikan Asrama Hafalan Al-Quran </p>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-md">
                            <img src="{{ asset('assets/banner/3.png') }}" class="rounded-t-xl" alt="3" loading="lazy">
                            <div class="px-4 py-2 h-28 sm:h-36 flex flex-col justify-between">
                                <p class="text-gray-800 font-bold text-xl">RTQ PUTRI</p>
                                <p class="text-gray-600 text-md">Program Pendidikan Asrama Hafalan Al-Quran </p>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-md">
                            <img src="{{ asset('assets/banner/4.png') }}" class="rounded-t-xl" alt="4" loading="lazy">
                            <div class="px-4 py-2 h-28 sm:h-36 flex flex-col justify-between">
                                <p class="text-gray-800 font-bold text-xl">TLA</p>
                                <p class="text-gray-600 text-md">Program Tahfidz Al-Quran</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-md">
                            <img src="{{ asset('assets/banner/5.png') }}" class="rounded-t-xl" alt="5" loading="lazy">
                            <div class="px-4 py-2 h-28 sm:h-36 flex flex-col justify-between">
                                <p class="text-gray-800 font-bold text-xl">RQ</p>
                                <p class="text-gray-600 text-md">Pendidiakn Anak Usia Dini</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </template>

        <template v-slot:tab-content-1>
            <div class="pt-4 px-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                    <div class="bg-white rounded-lg p-4">
                        <div class="block sm:flex items-center sm:justify-between">
                            <h1 class="text-2xl font-bold mb-4">Peserta</h1>
                            <Link href="/dashboard/daftar-program" class="py-2 px-5 flex justify-between text-white bg-primary-800 text-sm rounded-lg uppercase">
                                Program Pendidikan
                                <x-carbon-education class="w-5 h-5 ml-2 text-white"/>
                            </Link>
                        </div>
                    </div>
                    <div class="flex justify-end py-4">
                        {{-- <input type="text" placeholder="Cari Peserta..."
                            class="w-full max-w-xs border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            oninput="filterList(this.value)"> --}}
                    </div>
                    <div class="flow-root">
                        <ul role="list" class="space-y-2">
                            <x-splade-lazy>
                                <x-slot:placeholder>
                                    <div class="rounded-lg border border-gray-300 p-4">
                                        <div class="flex animate-pulse space-x-4">
                                            <div class="size-10 rounded-full bg-gray-200"></div>
                                            <div class="flex-1 space-y-6 py-1">
                                                <div class="h-2 rounded bg-gray-200"></div>
                                                <div class="space-y-3">
                                                    <div class="grid grid-cols-3 gap-4">
                                                        <div class="col-span-2 h-2 rounded bg-gray-200"></div>
                                                        <div class="col-span-1 h-2 rounded bg-gray-200"></div>
                                                    </div>
                                                    <div class="h-2 rounded bg-gray-200"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </x-slot:placeholder>
                                @forelse ($data_peserta_paginate as $item)
                                    <li class="p-2 sm:p-4 border rounded-md bg-white">
                                        <div class="flex items-center justify-between uppercase ">
                                            <span class="text-xs sm:text-[16px] font-semibold">{{ $item->nis_peserta }}</span>
                                            <div class="text-[10px] sm:text-xs">
                                                Status :
                                                <span class="px-2 py-0 sm:py-1 ml-1 font-semibold rounded-xl
                                                    {{ $item->status_aktif == 'diproses' ? 'bg-yellow-300 text-gray-900'
                                                    : ($item->status_aktif == 'aktif' ? 'bg-sky-500 text-white'
                                                    : ($item->status_aktif == 'ditangguhkan' || $item->status_aktif == 'off' ? 'bg-red-700 text-white' : '')) }}">
                                                    {{ $item->status_aktif }}
                                                </span>
                                                @if ($item->status_pendaftaran == 'belum pilih jadwal')
                                                    <span class="bg-red-300 text-gray-800 px-2 py-1 font-semibold rounded-xl">
                                                        Dimohon Segera Memilih Jadwal
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <hr class="my-1 sm:my-2" />
                                        <div class="flex items-center">
                                            <div class="shrink-0 px-0 sm:px-4">
                                                <img class="w-10 sm:w-16 rounded-full" src="/assets/logo/{{ $item->periode->unit->slug }}.jpg" alt="{{ $item->periode->unit->nama }}">
                                            </div>
                                            <div class="flex-1 min-w-0 sm:ms-4 ms-2">
                                                <Link href="{{ route('dashboard.peserta', ['uuid' => $item->uuid ]) }}">
                                                    <p class="text-md font-medium text-gray-900 uppercase">

                                                    </p>
                                                    <p class="text-md font-medium text-gray-900 uppercase">
                                                            {{ $item->peserta->nama }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 uppercase">
                                                        {{ $item->periode->unit->nama }} {{ $item->periode->nama }}
                                                    </p>
                                                </Link>
                                            </div>
                                            <div class="hidden sm:block items-center text-base font-semibold text-gray-900">
                                                <Link href="{{ route('dashboard.peserta', ['uuid' => $item->uuid ]) }}"
                                                    class="text-sm flex font-semibold border rounded-lg py-2.5 px-5 border-primary-700 text-primary-700 bg-white">
                                                    Lihat
                                                </Link>
                                            </div>
                                        </div>

                                        @if(isset($data_transaksi['transaksi'.$item->id]) || $item->status_pendaftaran == 'belum pilih jadwal')
                                            <hr class="my-1 sm:my-2" />
                                            <div class="flex items-center justify-center text-center ">
                                                <div class="items-center justify-center text-center text-base font-semibold text-gray-900">
                                                    @if(isset($data_transaksi['transaksi'.$item->id]))
                                                        <Link href="{{ route('website.lttq.invoice', ['uuid' => $data_transaksi['transaksi'.$item->id] ]) }}"
                                                            class="text-sm flex font-semibold border rounded-lg py-1.5 px-3 bg-yellow-400  text-white ">
                                                            Konfirmasi Pembayaran
                                                            <x-carbon-arrow-right class="w-5 h-5 ml-2 "/>
                                                        </Link>
                                                    @endif
                                                    @if ($item->status_pendaftaran == 'belum pilih jadwal')
                                                        <Link away href="{{ route('dashboard.peserta.daftar-jadwal', ['peserta' => $item->uuid ]) }}"
                                                            class="text-sm flex font-semibold border rounded-lg py-1.5 px-3 bg-primary-700 text-white">
                                                            Pilih Jadwal Sekarang
                                                            <x-carbon-arrow-right class="w-5 h-5 ml-2 "/>
                                                        </Link>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </li>
                                @empty
                                    <li class="p-4">
                                        Belum Ada Data Peserta
                                    </li>
                                @endforelse
                            </x-splade-lazy>
                        </ul>
                    </div>
                    <div class="flow-root py-4">
                        {{ $data_peserta_paginate->links() }}
                    </div>
                </div>
            </div>
        </template>

        <template v-slot:tab-content-2>
            <div class="pt-4 px-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                    <div class="bg-white rounded-lg p-4 mb-4">
                        <div class="block sm:flex items-center sm:justify-between">
                            <h1 class="text-2xl font-bold mb-4">Riwayat Pembayaran</h1>
                            <Link href="{{ route('dashboard.peserta.pembayaran.pilih-peserta') }}" class="py-2 px-5 flex justify-between text-primary-800 text-sm uppercase font-semibold border border-primary-800 rounded-lg">
                                Buat Pembayaran
                                <x-carbon-document-export class="w-5 h-5 ml-2 text-primary-800"/>
                            </Link>
                        </div>
                    </div>
                    <div class="flow-root">
                        <ul role="list" class="space-y-2">
                            <x-splade-lazy>
                                <x-slot:placeholder>
                                    <div class="rounded-lg border border-gray-300 p-4">
                                        <div class="flex animate-pulse space-x-4">
                                            <div class="size-10 rounded-full bg-gray-200"></div>
                                            <div class="flex-1 space-y-6 py-1">
                                                <div class="h-2 rounded bg-gray-200"></div>
                                                <div class="space-y-3">
                                                    <div class="grid grid-cols-3 gap-4">
                                                        <div class="col-span-2 h-2 rounded bg-gray-200"></div>
                                                        <div class="col-span-1 h-2 rounded bg-gray-200"></div>
                                                    </div>
                                                    <div class="h-2 rounded bg-gray-200"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </x-slot:placeholder>
                                @forelse ($data_transaksi as $item)
                                    <li class="p-4 border rounded-md bg-white">
                                        <div class="flex items-center justify-between border-b pb-2">
                                            <div class="flex-1 min-w-0 sm:ms-4">
                                                <p class="text-sm font-bold text-gray-900 uppercase">
                                                    INVOICE : {{ \Carbon\Carbon::parse($item->created_at)->format('Ymd') }}-{{ $item->id}}
                                                </p>
                                                {{-- <p class="text-sm text-gray-500 uppercase">
                                                    {{ $item->created_at->format('d F Y') }}
                                                </p> --}}
                                            </div>

                                            @if ($item->status == 1)
                                                <span class="bg-yellow-300 text-gray-900 px-2 py-1 rounded text-xs flex">Menunggu Pembayaran</span>
                                            @elseif ($item->status == 2)
                                                <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs flex">Menunggu Konfirmasi</span>
                                            @elseif ($item->status == 3)
                                                <span class="bg-green-500 text-white px-2 py-1 rounded text-xs flex">LUNAS</span>
                                            @elseif ($item->status == 4)
                                                <span class="bg-red-500 text-white px-2 py-1 rounded text-xs flex">Kadaluarsa</span>
                                            @endif
                                        </div>
                                        <div class="flex items-center pt-2">
                                            <div class="flex-1 min-w-0 sm:ms-4">
                                                <Link href="{{ route('dashboard.peserta', ['uuid' => $item->kelas->uuid ]) }}">
                                                    <p class="text-md font-medium text-gray-900 uppercase">
                                                        {{ $item->kelas->nis_peserta }} - {{ $item->kelas->peserta->nama }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 uppercase">
                                                        {{ $item->periode->unit->nama }} {{ $item->periode->nama }}
                                                    </p>
                                                </Link>
                                            </div>
                                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                                <Link href="{{ route('website.lttq.invoice', ['uuid' => $item->uuid, 'program' => $item->program_slug]) }}"
                                                    class="text-sm flex font-semibold  border-primary-700 text-primary-700 hover:text-white bg-white  hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">
                                                    Lihat Invoice
                                                </Link>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="p-4">
                                        Belum Ada Riwayat Aktivitas
                                    </li>
                                @endforelse
                            </x-splade-lazy>
                        </ul>
                    </div>
                    <div class="flow-root py-4">
                        {{ $data_transaksi->links() }}
                    </div>
                </div>
            </div>
        </template>

        <template v-slot:tab-content-3>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl" dusk="update-profile-information">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </Dashboard>

</x-app-layout>
