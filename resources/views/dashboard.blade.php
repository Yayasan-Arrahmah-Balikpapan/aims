<x-app-layout>
    {{-- <section>
        <div class="bg-gradient-to-tl from-primary-500 from-10% via-primary-600 via-40% to-emerald-500 to-90% py-16 px-10 ">
            <div class="max-w-7xl  mx-auto">
                <SliderDashboard />
            </div>
        </div>
    </section> --}}

    <section class=" dark:bg-gray-900">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 text-xs">
            <div class="">
                <h2 class="text-base font-bold tracking-tight text-gray-900 dark:text-white">
                    Ahlan Wa Sahlan
                </h2>
                <p class="mt-1">
                    Anda login menggunakan nomor {{ auth()->user()->phone_number }}
                </p>
            </div>
        </div>
    </section>

    <div class=" bg-primary-800">
        <div class="max-w-7xl mx-auto ">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flow-root">
                    {{-- <div class="mx-auto">
                        @php
                        $slides = [
                        [
                        'url' => url('/') . '/assets/img/lttq/1.jpg',
                        'link' => '#',
                        ],
                        [
                        'url' => url('/') . '/assets/img/lttq/2.jpg',
                        'link' => '#',
                        ],
                        [
                        'url' =>
                        'https://images.pexels.com/photos/337904/pexels-photo-337904.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                        'link' => '#',
                        ],
                        ];
                        @endphp
                        <CarouselSlider :initial-slides="{{ json_encode($slides) }}" />
                    </div> --}}
                    <div class="bg-no-repeat bg-center bg-cover h-full " style="background-image: url({{ url('/') }}/assets/img/masjid.png)">
                    </div>
                </div>
                {{-- <div class="flow-root m-4 w-full text-sm bg-white rounded-xl border border-gray-300 ">
                    <div class="divide-y divide-gray-300 relative pl-3 m-4">
                        @php
                        $events = [
                            [
                                'tanggal' => 'JULI 2025',
                                'keterangan' => 'WISUDA LTTQ 2025',
                                'link' => 'https://www.arrahmahbalikpapan.or.id/',
                            ],
                        ];
                        @endphp
                        @foreach ($events as $event)
                        <div class="flex flex-col gap-1 py-2">
                            <p class="text-gray-500 shrink-0">
                                {{ $event['tanggal'] }}
                            </p>
                            <h3 class="font-semibold text-gray-900 dark:text-white">
                                <a href="{{ $event['link'] }}" class="hover:underline">{{ $event['keterangan'] }}</a>
                            </h3>
                        </div>
                        @endforeach
                        <div class="absolute top-0 left-0 h-full w-1 bg-gray-300 "></div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>




    {{-- <div class="pt-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white rounded-lg p-4">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl font-bold mb-4">Peserta</h1>
                    <Link href="/dashboard/daftar-program"
                    class="py-2.5 px-5 text-primary-800 border border-primary-800 rounded-lg">Daftar Program</Link>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th scope="col"
                                class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                Nama
                            </th>
                            <th scope="col"
                            class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            Status
                        </th>
                        <th scope="col"
                        class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        Program
                    </th>
                    <th scope="col"
                    class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <th scope="row"
                class="px-6 py-4 text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                Muhammad Fikri
            </th>
            <td class="px-6 py-4 text-blue-500">
                Aktif
            </td>
            <td class="px-6 py-4">
                Raudhotul Quran
            </td>
            <td class="px-6 py-4">
                <Link href="#"
                class="text-sm font-semibold text-primary-700 hover:text-white ">
                Pilih
            </Link>
        </td>
    </tr>
    <tr class="border-b border-gray-200 dark:border-gray-700">
        <th scope="row"
        class="px-6 py-4 text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
        Eko
    </th>
    <td class="px-6 py-4">
        <span class="text-green-500">
            Selesai
        </span>
    </td>
    <td class="px-6 py-4">
        Tahsin
    </td>
    <td class="px-6 py-4">
        <a href="#"
        class="text-sm font-semibold text-primary-700 hover:text-white bg-white  hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">
        Pilih
    </a>
</td>
</tr>
<tr class="border-b border-gray-200 dark:border-gray-700">
    <th scope="row"
    class="px-6 py-4 text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
    Marianto
</th>
<td class="px-6 py-4">
    <span class="text-red-500">
        Cuti
    </span>
</td>
<td class="px-6 py-4">
    Tahsin
</td>
<td class="px-6 py-4">
    <a href="#"
    class="text-sm font-semibold text-primary-700 hover:text-white bg-white  hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">
    Pilih
</a>
</td>
</tr>
<tr class="border-b border-gray-200 dark:border-gray-700">
    <th scope="row"
    class="px-6 py-4 text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
    Adam Indrawan
</th>
<td class="px-6 py-4">
    <span class="text-blue-500">
        Aktif
    </span>
</td>
<td class="px-6 py-4">
    Tahfizd Lil Atfhal
</td>
<td class="px-6 py-4">
    <a href="#"
    class="text-sm font-semibold text-primary-700 hover:text-white bg-white  hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">
    Pilih
</a>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div> --}}

<div class="pt-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="p-4">
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('website.lttq') }}" class="sm:flex block justify-between p-4 text-center rounded-2xl bg-gradient-to-r from-primary-800 to-primary-600 bg-">
                    <x-carbon-education class="text-white w-16 h-16 lg:w-20 lg:h-20"/>
                    <div class="sm:text-xl text-lg relative uppercase font-bold text-white flex items-end justify-end">Program LTTQ</div>
                </a>
                <a href="#" class="sm:flex block justify-between p-4 text-center rounded-2xl bg-gradient-to-r from-sky-800 to-sky-600">
                    <x-carbon-radio class="text-white w-16 h-16 lg:w-20 lg:h-20"/>
                    <div class="sm:text-xl text-lg relative uppercase font-bold text-white flex items-end justify-end">Informasi</div>
                </a>
                <a href="#" class="sm:flex block justify-between p-4 text-center rounded-2xl bg-gradient-to-r from-amber-800 to-amber-600">
                    <x-carbon-collaborate class="text-white w-16 h-16 lg:w-20 lg:h-20"/>
                    <div class="sm:text-xl text-lg relative uppercase font-bold text-white flex items-end justify-end">Donasi</div>
                </a>
                {{-- <a href="#" class="sm:flex block justify-between p-4 text-center rounded-2xl bg-gradient-to-r from-primary-800 to-primary-600">
                    <svg class="mx-auto mb-1 text-primary-800 w-7 h-7 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                    <div class="sm:text-xl text-lg relative uppercase font-bold text-white flex items-end justify-end">Acara</div>
                </a>
                <a href="#" class="sm:flex block justify-between p-4 text-center rounded-2xl bg-gradient-to-r from-primary-800 to-primary-600">
                    <svg class="mx-auto mb-1 text-primary-800 w-7 h-7 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
                    <div class="sm:text-xl text-lg relative uppercase font-bold text-white flex items-end justify-end">Settings</div>
                </a>
                <a href="#" class="sm:flex block justify-between p-4 text-center rounded-2xl bg-gradient-to-r from-primary-800 to-primary-600">
                    <svg class="mx-auto mb-1 text-primary-800 w-7 h-7 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"></path><path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <div class="sm:text-xl text-lg relative uppercase font-bold text-white flex items-end justify-end">Products</div>
                </a> --}}
            </div>
        </div>
    </div>
</div>



<div class="pt-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="m-4">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Peserta Terdaftar</h5>
            </div>
            <div class="flow-root ">
                <ul role="list" class="divide-y divide-gray-200 space-y-2">
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
                        @forelse ($data_peserta as $item)
                            <li class="p-2 sm:p-4 border rounded-md bg-white">
                                <div class="flex items-center justify-end uppercase space-x-2">
                                    <div class="text-xs">
                                        STATUS :
                                    </div>
                                    @if ($item->status_aktif == 'diproses')
                                        <span class="bg-yellow-300 text-gray-900 px-2 py-1 text-xs font-semibold rounded-xl">
                                            Diproses
                                        </span>
                                    @elseif ($item->status_aktif == 'aktif')
                                        <span class="bg-sky-500 text-white px-2 py-1 text-xs font-semibold rounded-xl">
                                            Aktif
                                        </span>
                                    @elseif ($item->status_aktif == 'ditangguhkan' || $item->status_aktif == 'off')
                                        <span class="bg-red-700 text-white px-2 py-1 text-xs font-semibold rounded-xl uppercase">
                                            {{ $item->status_aktif}}
                                        </span>
                                    @endif
                                    @if ($item->status_pendaftaran == 'belum pilih jadwal')
                                        <span class="bg-red-300 text-gray-800 px-2 py-1 text-xs font-semibold rounded-xl">
                                            Dimohon Segera Memilih Jadwal
                                        </span>
                                    @endif
                                </div>
                                <hr class="my-2" />
                                <div class="flex items-center">
                                    <div class="shrink-0 px-0 sm:px-4">
                                        <img class="w-16 rounded-full" src="/assets/logo/{{ $item->periode->unit->slug }}.jpg" alt="{{ $item->periode->unit->nama }}">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <Link href="{{ route('dashboard.peserta', ['uuid' => $item->uuid ]) }}">
                                            <p class="text-md font-medium text-gray-900 uppercase">
                                                    {{ $item->nis_peserta }} - {{ $item->peserta->nama }}
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
                                    <hr class="my-2" />
                                    <div class="flex items-center justify-center text-center ">
                                        <div class="inline-flex items-center justify-center text-center text-base font-semibold text-gray-900">
                                            @if(isset($data_transaksi['transaksi'.$item->id]))
                                                <Link href="{{ route('website.lttq.invoice', ['uuid' => $data_transaksi['transaksi'.$item->id] ]) }}"
                                                    class="text-sm flex font-semibold border rounded-lg py-1.5 px-3 bg-yellow-400 ">
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
        </div>
    </div>
</div>

<div class="pt-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-center">
            {{-- <img src="https://cdn.discordapp.com/attachments/867731696706387978/1330038315239604288/banner.png?ex=678c8635&is=678b34b5&hm=996e45a700ec7b336c0f0f203566bc765753ef2aa4205fb102bb62198a36e136&" class="w-auto border border-gray-300" alt="Logo"> --}}
        </div>
    </div>
</div>

{{-- <div class="pt-10 pb-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-center">
            <img src="{{ url('/') }}/assets/img/logo-arrahmah.png" class="h-14 w-auto m-4" alt="Logo">
            <img src="{{ url('/') }}/assets/img/lttq/lttq.png" class="h-14 w-auto m-4" alt="Logo">
        </div>
        <div class="flex items-center justify-center">
            <img src="{{ url('/') }}/assets/img/lttq/rq.png" class="h-14 w-auto m-4" alt="Logo">
            <img src="{{ url('/') }}/assets/img/lttq/rtq-putra.png" class="h-14 w-auto m-4" alt="Logo">
            <img src="{{ url('/') }}/assets/img/lttq/rtq-putri.png" class="h-14 w-auto m-4" alt="Logo">
            <img src="{{ url('/') }}/assets/img/lttq/tahsin.png" class="h-14 w-auto m-4" alt="Logo">
            <img src="{{ url('/') }}/assets/img/lttq/tla.png" class="h-14 w-auto m-4" alt="Logo">
        </div>
    </div>
</div> --}}

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
    @endif
</x-splade-lazy>

{{-- <div class="pt-10 pb-10">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <UploadManager />
    </div>
</div> --}}

</x-app-layout>
