<x-layouts.main :unit="$unit">

    <x-layouts.card>
        <h2 class="text-xl font-bold uppercase">
            Periode {{ $unit }}  Angkatan {{ $dataperiode->angkatan }}, Tahun {{ $dataperiode->tahun_ajaran }}
        </h2>
    </x-layouts.card>

    <div class="md:flex p-3">
        @include('dashboard.admin.periode.menu')
        <div class="px-3 w-full">
            <div class="items-center justify-end flex">
                <Link modal max-width="lg" href="{{ route('admin.jadwal.create', ['unit' => $unit, 'periode' => $periode]) }}" class="text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
                    Tambah Data
                    @svg('carbon-add-filled', 'ml-2 text-white h-4 w-4')
                </Link>
            </div>
            {{-- <x-splade-table :for="$jadwal">
                <x-splade-cell actions as="$data">
                    <div class="flex items-center gap-1">

                        @if ($data->status == 'MENUNGGU KONFIRMASI')
                            <Link href="/users/edit" class="text-yellow-500 border border-yellow-500 rounded-md px-2 py-1">
                                <x-carbon-edit class="w-5 h-5 text-yellow-500"/>
                            </Link>
                        @endif
                        <Link href="{{ route('invoice.index', ['uuid' => $data->uuid]) }}" target="_blank" class="text-sky-500 border border-sky-500 rounded-md px-2 py-1">
                            <x-carbon-report class="w-5 h-5 text-sky-500"/>
                        </Link>
                        <Link href="{{ route('admin.jadwal.show', ['unit' => $data->periode->unit->slug, 'periode' => $data->periode->id, 'jadwal' => $data->id]) }}" class="text-yellow-500 border border-yellow-500 rounded-md px-2 py-1">
                            <x-carbon-edit class="w-5 h-5 text-yellow-500"/>
                        </Link>
                        <Link
                            confirm="Konfirmasi Hapus Data"
                            confirm-text="Apakah yakin data {{ $data->nama_jadwal }}, {{ $data->level->nama }} {{ $data->hari_belajar }} dihapus ?"
                            confirm-button="Ya"
                            cancel-button="Tidak"
                            href="/users/edit" class="text-red-700 border border-red-700 rounded-md px-2 py-1">
                            <x-carbon-trash-can class="w-5 h-5 text-red-700"/>
                        </Link>
                    </div>
                </x-splade-cell>
            </x-splade-table> --}}
        </div>
    </div>
</x-layouts.main>
