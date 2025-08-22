<x-layouts.main :unit="$unit">
    <x-layouts.card>
       <label class="text-xl font-semibold uppercase">Periode {{ $data_periode->nama }}</label>
    </x-layouts.card>
    <div class="p-4">
        <div class="w-full">
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
                        @forelse ($data_peserta_baru  as $index => $item)
                            <p class="text-3xl sm:p-1 font-black text-gray-200 absolute">{{ $index + 1 }}</p>
                            <li class="sm:p-4 p-2 border rounded-md bg-white">
                                <div class="flex items-center justify-between border-b pb-2">
                                    <div class="flex-1 min-w-0 sm:ms-4">
                                        <p class="ml-3 sm:ml-0 text-sm font-bold text-gray-900 uppercase">
                                            Level : {{ $data_peserta->data_nilai['penempatan-level'] ?? '-' }}
                                        </p>
                                    </div>
                                    <span class="inline-block px-2 py-1 {{ $item->status_pendaftaran == 'belum diberikan level' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800'  }} rounded-full text-xs font-semibold">
                                        {{ $item->status_pendaftaran == 'belum diberikan level' ? 'Belum Diperiksa' : 'Selesai Diperiksa'  }}
                                    </span>
                                </div>
                                <div class="flex items-center pt-2">
                                    <div class="flex-1 min-w-0 sm:ms-4">
                                        <Link href="{{ route('penguji.peserta-baru.show', ['unit' => $unit, 'periode' => $periode, 'peserta' => $item->id]) }}">
                                            <p class="text-md font-medium text-gray-900 uppercase">
                                                {{ $item->nis_peserta }} - {{ $item->peserta->nama }}
                                            </p>
                                            <p class="text-sm text-gray-500 uppercase">
                                                {{ $item->jadwal->nama_jadwal ?? '-Belum Pilih Jadwal-' }}
                                            </p>
                                        </Link>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center pt-1">
                                    <p class="text-sm sm:text-base font-semibold sm:pt-4 pt-0 text-gray-700 uppercase">
                                        {{ $item->peserta->jenis_peserta }}
                                    </p>
                                    <div class="inline-flex items-center ">
                                        <Link href="{{ route('penguji.peserta-baru.show', ['unit' => $unit, 'periode' => $periode, 'peserta' => $item->id]) }}"
                                            class="text-white bg-primary-700 hover:bg-primary-900 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm sm:px-3 sm:py-2 py-1 px-2 text-center inline-flex items-center">
                                            Lihat <x-carbon-edit class="w-5 h-5 ml-2"/>
                                        </Link>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="p-4">
                                Belum Ada Data
                            </li>
                        @endforelse
                    </x-splade-lazy>
                </ul>
            </div>

            <div class="p-2 text-xs text-gray-500">
                {{ $data_peserta_baru ->links() }}
            </div>
        </div>
    </div>
</x-layouts.main>
