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
                            <th scope="col" class="px-3 py-3 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50">
                                Jadwal
                            </th>
                            @for ($i = 1; $i <= 16; $i++)
                                <th scope="col"
                                    class="px-3 py-3 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50">
                                    {{ $i }}
                                </th>
                            @endfor
                            <th scope="col" class="px-3 py-3 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50">
                                Jumlah
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_jadwal as $item)
                            <tr class="text-gray-700 border-b border-gray-200 py-4">
                                <td class="p-2 uppercase font-semibold">
                                    {{ $item->nama_jadwal }}
                                </td>
                                @for($i = 1; $i <= 16; $i++)
                                    <td class="text-center py-4 px-2 uppercase">
                                        @if(isset($data_absen[$item->id.'-'.$i]))
                                            {{ \Carbon\Carbon::parse($data_absen[$item->id.'-'.$i])->format('d-m-Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                @endfor
                                <td class="text-center py-4 px-2 uppercase">
                                    -
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-2 text-gray-500">
                {{ $data_jadwal->links() }}
            </div>
        </div>
    </div>
</x-layouts.main>
