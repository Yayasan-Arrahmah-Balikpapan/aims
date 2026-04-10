<x-layouts.main :unit="$unit">

    <x-layouts.card>
        <h2 class="text-xl font-bold uppercase">
            Periode {{ $unit }}  Angkatan {{ $dataperiode->angkatan }}, Tahun {{ $dataperiode->tahun_ajaran }}
        </h2>
    </x-layouts.card>

    <div class="md:flex p-3">
        @include('dashboard.admin.periode.menu')
        <div class="px-3 w-full">
            <div class="items-center justify-end flex gap-2">
                <a href="{{ route('admin.peserta.export', ['unit' => $unit, 'periode' => $periode]) }}" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
                    Export
                    @svg('carbon-download', 'ml-2 text-white h-4 w-4')
                </a>
                <Link modal max-width="lg" href="{{ route('admin.peserta.create', ['unit' => $unit, 'periode' => $periode]) }}" class="text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
                    Tambah Peserta Baru
                    @svg('carbon-add-filled', 'ml-2 text-white h-4 w-4')
                </Link>
                <Link modal max-width="lg" href="{{ route('admin.peserta.create.pilih', ['unit' => $unit, 'periode' => $periode]) }}" class="text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
                    Mendaftar Ulang Peserta
                    @svg('carbon-add-filled', 'ml-2 text-white h-4 w-4')
                </Link>
            </div>
            <x-splade-table :for="$peserta">
                <x-splade-cell actions as="$data">
                    <div class="flex items-center gap-1">
                        {{-- @if ($data->status == 'MENUNGGU KONFIRMASI')
                            <Link href="{{ route('admin.peserta.edit', ['unit' => $data->periode->unit->slug, 'periode' => $data->periode->id, 'peserta' => $data->id]) }}" class="text-yellow-500 border border-yellow-500 rounded-md px-2 py-1">
                                <x-carbon-edit class="w-5 h-5 text-yellow-500"/>
                            </Link>
                        @endif --}}
                        {{-- <Link href="{{ route('invoice.index', ['uuid' => $data->uuid]) }}" target="_blank" class="text-sky-500 border border-sky-500 rounded-md px-2 py-1">
                            <x-carbon-report class="w-5 h-5 text-sky-500"/>
                        </Link> --}}
                        <Link confirm="Kirim Notif Daftar Ulang ?" href="{{ route('admin.peserta.notif-daftar-ulang', ['unit' => $data->periode->unit->slug, 'periode' => $data->periode->id, 'peserta' => $data->id]) }}" class="relative text-white border border-yellow-400 bg-yellow-400 rounded-md px-2 py-1 ">
                            <span class="absolute top-0 right-0 inline-flex items-center p-1  justify-center text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-green-500 rounded-full">{{ isset($data->notifikasi['daftar_ulang']) ? $data->notifikasi['daftar_ulang'] : '0' }}</span>
                            <x-carbon-notification class="w-4 h-4 mr-1 text-white"/>
                        </Link>
                        <Link href="{{ route('admin.peserta.show', ['unit' => $data->periode->unit->slug, 'periode' => $data->periode->id, 'peserta' => $data->id]) }}" class="text-yellow-500 border border-yellow-500 rounded-md px-2 py-1">
                            <x-carbon-edit class="w-5 h-5 text-yellow-500"/>
                        </Link>
                        <x-splade-form action="{{ route('admin.peserta.destroy', ['unit' => $data->periode->unit->slug, 'periode' => $data->periode->id, 'peserta' => $data->id]) }}"
                            method="DELETE"
                            confirm="Konfirmasi Hapus Data"
                            confirm-text="Data {{ $data->nis_peserta }}, {{ $data->peserta->nama }} - {{ $data->peserta->phone_number }} dihapus ?"
                            confirm-button="Ya"
                            cancel-button="Tidak"
                            >
                            @csrf
                            <button type="submit" class="text-red-700 border border-red-700 rounded-md px-2 py-1">
                                <x-carbon-trash-can class="w-5 h-5 text-red-700"/>
                            </button>
                        </x-splade-form>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-layouts.main>
