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
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Buka Pendaftaran</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tutup Pendaftaran</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Peserta</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($periode as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $item->nama }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($item->waktu_start)->format('d-m-Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($item->waktu_end)->format('d-m-Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="font-bold {{ $item->aktifkan_pendaftaran == 1 ? 'text-sky-500' : 'text-red-500' }}">{{ $item->aktifkan_pendaftaran == 1 ? 'BUKA' : 'TUTUP' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 uppercase">{{ $item->kategori }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->kelas->count() }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <a href="{{ route('admin.periode.show', ['unit' => $unit, 'periode' => $item->id]) }}" class="inline-flex items-center rounded-lg border border-yellow-400 px-3 py-1 text-sm font-medium text-yellow-400">
                                Edit @svg('carbon-edit', 'ml-2 h-4 w-4 text-yellow-400')
                            </a>
                            <Link href="{{ route('admin.periode.statistik', ['unit' => $unit, 'periode' => $item->id]) }}" class="inline-flex items-center rounded-lg border border-primary-700 px-3 py-1 text-sm font-medium text-primary-700">
                                Lihat Data @svg('carbon-arrow-right', 'ml-2 h-4 w-4 text-primary-700')
                            </Link>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.main>
