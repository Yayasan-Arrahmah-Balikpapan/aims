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
                            <th scope="col" class="py-4 px-2 uppercase">
                                Jadwal
                            </th>
                            @foreach($data_biaya as $item_biaya)
                                <th scope="col" class="py-4 px-2 uppercase">
                                    {{ $item_biaya->nama }}
                                </th>
                            @endforeach
                            <th scope="col" class="py-4 px-2 uppercase text-center">
                                Total
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase text-center">
                                Donasi
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase text-center">
                                Total Transfer
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_peserta as $item)
                            @php
                                $total_pembayaran = 0;
                            @endphp
                            <tr class="text-gray-700 border-b border-gray-200 py-4">
                                <td class="p-4 uppercase font-semibold">
                                    {{ $item->nis_peserta }}
                                </td>
                                <td class="py-4 px-2 uppercase">
                                    {{ $item->peserta->nama }}
                                </td>
                                <td class="py-4 px-2 uppercase">
                                    {{ $item->jadwal->nama_jadwal ?? '' }}
                                </td>
                                @foreach($data_biaya as $item_biaya_)
                                    <td class="py-4 px-2 uppercase">
                                        @if(isset($data_pembayaran_peserta[$item->id][$item_biaya_->id]))
                                            @php
                                                $total_pembayaran += $data_pembayaran_peserta[$item->id][$item_biaya_->id];
                                            @endphp
                                            Rp. {{ number_format($data_pembayaran_peserta[$item->id][$item_biaya_->id], 0, ',', '.') }}
                                        @else
                                            Rp. 0
                                        @endif
                                    </td>
                                @endforeach
                                <td class="py-4 px-2 uppercase text-center">
                                    Rp. {{ number_format($total_pembayaran, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-2 uppercase text-center">
                                    Rp. {{ number_format(0, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-2 uppercase text-center">
                                    Rp. {{ number_format(0, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-2 text-xs text-gray-500">
                {{ $data_peserta->links() }}
            </div>
        </div>
    </div>
</x-layouts.main>
