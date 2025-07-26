<x-layouts.main :unit="$unit">
    <x-layouts.card>
       <label class="text-xl font-semibold uppercase">Periode {{ $data_periode->nama }}</label>
    </x-layouts.card>
    <div class="p-4">
        <div class="w-full">
            <div class="relative overflow-x-auto border rounded-md mb-4 bg-white">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead>
                        <tr class="border-b border-gray-200 ">
                            <th scope="col" class="p-4 uppercase">
                                NIS
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase">
                                Peserta
                            </th>
                            <th></th>
                            <th scope="col" class="py-4 px-2 uppercase">
                                Jadwal
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase">
                                Level
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase">
                                Daftar
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase">
                                Status
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_peserta_baru  as $item)
                            <tr class="text-gray-700 border-b border-gray-200 py-4">
                                <td class="p-4 uppercase font-semibold">
                                    {{ $item->nis_peserta }}
                                </td>
                                <td class="py-4 px-2 uppercase">
                                    {{ $item->peserta->nama }}
                                </td>
                                <td class="py-4 px-2 uppercase">
                                    {{ $item->peserta->jenis_peserta }}
                                </td>
                                <td class="py-4 px-2 uppercase">
                                    {{ $item->jadwal->nama_jadwal ?? '' }}
                                </td>
                                <td class="py-4 px-2 uppercase">
                                    {{ $data_peserta->data_nilai['penempatan-level'] ?? '' }}
                                </td>
                                <td class="py-4 px-2 uppercase">
                                    {{ $item->created_at->format('d F Y') }}
                                </td>
                                <td class="py-4 px-2 uppercase font-semibold">
                                    <span class="inline-block px-2 py-1 {{ $item->status_pendaftaran == 'belum diberikan level' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800'  }} rounded-full text-xs font-semibold">
                                        {{ $item->status_pendaftaran == 'belum diberikan level' ? 'Belum Diperiksa' : 'Selesai Diperiksa'  }}
                                    </span>
                                </td>
                                <td class="py-4 px-2 uppercase text-center">
                                    <Link href="{{ route('penguji.peserta-baru.show', ['unit' => $unit, 'periode' => $periode, 'peserta' => $item->id]) }}"
                                        class="text-white bg-primary-700 hover:bg-primary-900 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center">
                                        <x-carbon-edit class="w-5 h-5 mr-2"/>
                                    </Link>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-2 text-xs text-gray-500">
                {{ $data_peserta_baru ->links() }}
            </div>
        </div>
    </div>
</x-layouts.main>
