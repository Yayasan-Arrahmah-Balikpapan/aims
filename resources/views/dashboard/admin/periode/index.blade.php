<x-layouts.main :unit="$unit">

    {{-- <div class="border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
            <li class="me-2">
                <x-link-item class="mx-4 my-2 px-4" :href="route('admin.jadwal.index', ['unit' => $unit])" :active="request()->routeIs('admin.jadwal.index', ['unit' => $unit])">
                    @svg('carbon-table-alias', 'text-gray-600 h-6 w-6')
                    <span class="ml-3">Jadwal</span>
                </x-link-item>

            </li>
            <li class="me-2">
                <x-link-item class="mx-4 my-2 px-4" :href="route('admin.peserta.index', ['unit' => $unit])" :active="request()->routeIs('admin.peserta.index', ['unit' => $unit])">
                    @svg('carbon-user-multiple', 'text-gray-600 h-6 w-6')
                    <span class="ml-3">Peserta</span>
                </x-link-item>
            </li>
            <li class="me-2">
                <x-link-item class="mx-4 my-2 px-4" :href="route('admin.pembayaran.index', ['unit' => $unit])" :active="request()->routeIs('admin.pembayaran.index', ['unit' => $unit])">
                    @svg('carbon-list-dropdown', 'text-gray-600 h-6 w-6')
                    <span class="ml-3">Pembayaran</span>
                </x-link-item>
            </li>
        </ul>
    </div> --}}

    <x-layouts.card>
        <h2 class="text-2xl font-bold uppercase">Manajemen Data {{ $unit }}</h2>
        {{-- <x-layouts.title>Manajemen Periode {{ $unit }}</x-layouts.title> --}}

        {{-- <x-splade-table :for="$periode" /> --}}
    </x-layouts.card>

    <div class="p-4">
        <div class="items-center justify-end flex">
            <Link modal max-width="lg" href="{{ route('admin.periode.create', ['unit' => $unit]) }}"
                class="text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
            Tambah Data
            @svg('carbon-add-filled', 'ml-2 text-white h-4 w-4')
            </Link>
        </div>
    </div>


    <div class="p-4">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 lg:gap-6">
            @foreach ($periode as $item)
            <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm  sm:p-6">
                    <p class="text-xl font-semibold text-gray-900">Angkatan {{ $item->angkatan }}</p>
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500">Tahun Ajaran</dt>
                                <dd class="text-base font-medium text-gray-900">{{ $item->tahun_ajaran }}</dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500">Buka Pendaftaran</dt>
                                <dd class="text-base font-medium text-gray-900">{{ \Carbon\Carbon::parse($item->waktu_start)->format('d-m-Y') }}</dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500">Tutup Pendaftaran</dt>
                                <dd class="text-base font-medium text-gray-900">{{ \Carbon\Carbon::parse($item->waktu_end)->format('d-m-Y') }}</dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500">Status Daftar</dt>
                                <dd class="text-base font-bold {{ $item->aktifkan_pendaftaran == 1 ? 'text-sky-500' : 'text-red-500' }}">{{ $item->aktifkan_pendaftaran == 1 ? 'BUKA' : 'TUTUP' }}</dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500">Peserta</dt>
                                <dd class="text-base font-medium text-gray-900">{{ $item->peserta }}</dd>
                            </dl>
                        </div>
                    </div>
                    <hr class="border-t border-gray-200 pt-2">
                    <div class="flex w-full items-center justify-between space-x-2">
                        <Link href="{{ route('admin.periode.statistik', ['unit' => $unit, 'periode' => $item->id]) }}" class="flex items-center justify-center rounded-lg border border-primary-700 px-5 py-2.5 text-sm font-medium text-primary-700">
                            Lihat Data  @svg('carbon-arrow-right', 'ml-2 h-5 w-5 text-primary-700')
                        </Link>
                        <a href="{{ route('admin.periode.show', ['unit' => $unit, 'periode' => $item->id]) }}" class="flex items-center justify-center rounded-lg border border-yellow-400 px-3 py-2.5 text-sm font-medium text-yellow-400">
                            @svg('carbon-edit', 'h-5 w-5 text-yellow-400')
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-layouts.main>
