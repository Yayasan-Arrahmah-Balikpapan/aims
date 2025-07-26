<x-layouts.card-a>
    @if(!$data_peserta)
        <div class="text-center py-6">
            <h3 class="text-2xl font-bold text-gray-900">Belum memiliki peserta</h3>
        </div>
    @else
        <div class="relative overflow-x-auto border border-b-0 border-x-0 rounded-md mb-4 bg-white">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th scope="col" class="border-x text-gray-700 font-semibold p-1 text-center bg-stone-100">
                            Pertemuan
                        </th>
                        @for ($i = 1; $i <= 16; $i++)
                            <th class="border-x text-center">{{ $i }}</th>
                        @endfor
                        <th scope="col" class="border-x text-center p-1 uppercase">
                            Total Hadir
                        </th>
                        <th scope="col" class="border-x text-center p-1 uppercase">
                            Mengikuti Ujian
                        </th>
                        <th scope="col" class="border-x text-center p-1 uppercase">
                            Nilai Ujian
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-gray-700 text-sm font-semibold border-b border-gray-300">
                        <td class="border-x p-1 text-center bg-stone-100">
                            Tanggal Absen
                        </td>
                        @for($i = 1; $i <= 16; $i++)
                            <td class="border-x text-center p-1 text-xs font-bold">
                                {{ isset($data_pertemuan_tanggal[$i]) ? \Carbon\Carbon::parse($data_pertemuan_tanggal[$i])->format('d-m-Y') : '' }}
                            </td>
                        @endfor
                    </tr>
                    <tr class="text-gray-700 text-sm font-semibold border-b border-gray-300">
                        <td class="border-x p-1 text-center bg-stone-100">
                            Tilawah
                        </td>
                        @for($i = 1; $i <= 16; $i++)
                            <td class="border-x text-center p-1 text-xs font-bold">
                                {{ isset($data_pertemuan_tilawah[$i])
                                    ? $data_pertemuan_tilawah[$i] == 'Surah - Ayat' ? '-' : $data_pertemuan_tilawah[$i]
                                    : '' }}
                            </td>
                        @endfor
                    </tr>
                    @foreach ($data_peserta as $item)
                        @php
                            $total_hadir = 0
                        @endphp
                        <tr class="text-gray-700 text-sm font-semibold border-b border-gray-300">
                            <td class="border-x p-1 uppercase bg-stone-100">
                                {{ $item->nis_peserta }} - {{ $item->peserta->nama }}
                            </td>
                            @for($i = 1; $i <= 16; $i++)
                                <td class="min-w-16 border-x text-center p-1 uppercase text-xs font-bold ">
                                    <div class="flex items-center justify-center">
                                        @if (isset($data_absensi_peserta[$item->id.'-'.$i]))
                                            @if ($data_absensi_peserta[$item->id.'-'.$i] == 1)
                                                @php
                                                    $total_hadir += 1;
                                                @endphp
                                                <x-carbon-checkmark class="w-6 h-6 text-sky-500" />
                                            @elseif ($data_absensi_peserta[$item->id.'-'.$i] == 2)
                                                <x-carbon-close-filled class="w-6 h-6 text-red-600" />
                                            @elseif ($data_absensi_peserta[$item->id.'-'.$i] == 3 || $data_absensi_peserta[$item->id.'-'.$i] == 4)
                                                <x-carbon-close-filled class="w-6 h-6 text-yellow-300" />
                                            @else
                                                -
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </div>
                                </td>
                            @endfor
                            <td class="border-x text-center p-1 uppercase text-xs font-bold">
                                {{ $total_hadir }}
                            </td>
                            <td class="border-x text-center p-1 uppercase text-xs font-bold ">
                                @if ($total_hadir >= 10)
                                    BOLEH
                                @else
                                    BELUM
                                    {{-- <Link href="#" class=" text-primary-600 border border-primary-600 rounded-md px-2 py-1">
                                        <x-carbon-checkmark class="w-4 h-4 text-primary-600" />
                                    </Link> --}}
                                @endif
                            </td>
                            <td class="border-x text-center p-1 uppercase text-xs font-bold">
                                {{ isset($item->data_nilai['ujian']) ? $item->levelTahsin($item->data_nilai['ujian']) : '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-layouts.card-a>
