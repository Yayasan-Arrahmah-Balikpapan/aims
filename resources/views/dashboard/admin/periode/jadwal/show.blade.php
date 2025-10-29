<x-layouts.main :unit="$unit">

    <x-layouts.card>
        <h2 class="text-xl font-bold uppercase">
            Periode {{ $unit }}  Angkatan {{ $dataperiode->angkatan }}, Tahun {{ $dataperiode->tahun_ajaran }}
        </h2>
    </x-layouts.card>

    <div class="md:flex p-3">
        @include('dashboard.admin.periode.menu')
        <div class="grid grid-cols-1 gap-3 w-full">
            <x-layouts.card-periode>
                <x-layouts.title>Data Jadwal <text class="uppercase">{{ $unit }}</text>, {{ $jadwal->nama_jadwal }} - {{ $jadwal->periode->nama }} </x-layouts.title>
                <div class="py-4">
                    <div class="mb-4 grid gap-3 sm:grid-cols-2 md:gap-6">
                        <div class="flex flex-col">
                            <p class="text-sm font-medium text-gray-700">Pengajar</p>
                            <p class="text-lg font-bold text-gray-800">{{  $jadwal->pengajar ? $jadwal->pengajar->user->name : '-' }}</p>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-sm font-medium text-gray-700">Jenis</p>
                            <p class="text-lg font-bold text-gray-800">{{ $jadwal->jenis_peserta ?? '-' }}</p>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-sm font-medium text-gray-700">Hari</p>
                            <p class="text-lg font-bold text-gray-800">{{ $jadwal->hari_belajar ?? '-' }}</p>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-sm font-medium text-gray-700">Waktu </p>
                            <p class="text-lg font-bold text-gray-800">{{ $jadwal->jam_mulai ?? '.' }} - {{ $jadwal->jam_selesai ?? '.' }}</p>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-sm font-medium text-gray-700">Level</p>
                            <p class="text-lg font-bold text-gray-800">{{ $jadwal->level ? $jadwal->level->nama : '-' }}</p>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-sm font-medium text-gray-700">Status Belajar</p>
                            <p class="text-lg font-bold text-gray-800">{{ $jadwal->status_belajar ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-end justify-end pb-2">
                    <Link modal max-width="lg" href="{{ route('admin.jadwal.edit', ['unit' => $unit, 'periode' => $periode ,'jadwal'=> $jadwal->id]) }}" title=""
                        class="mt-4 sm:mt-0 text-yellow-500 font-medium rounded-lg border border-yellow-500 text-sm px-4 py-1 lg:py-2.5 flex items-center justify-between"
                        role="button">
                        Edit Data
                        <x-carbon-edit class="w-5 h-5 ml-3 text-yellow-500"/>
                    </Link>
                </div>
            </x-layouts.card>
            <x-layouts.card>
                {{-- <div class="flex items-start justify-start pb-2">
                    <Link modal max-width="lg" href="{{ route('admin.jadwal.import', ['unit' => $unit, 'jadwal'=> $jadwal->id]) }}" title=""
                        class="mt-4 sm:mt-0 text-green-500 font-medium rounded-lg border border-green-500 text-sm px-4 py-1 lg:py-2.5 flex items-center justify-between"
                        role="button">
                        Import Data
                        <x-carbon-document-add class="w-5 h-5 ml-3 text-green-500"/>
                    </Link>
                </div> --}}
                <div class="relative overflow-x-auto border rounded-md mb-4 bg-white">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead>
                            <tr class="border-b border-gray-200 ">
                                <th scope="col" class="px-3 py-3 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50">
                                    Nama
                                </th>
                                @for ($i = 1; $i <= 16; $i++)
                                    <th scope="col"
                                        class="px-3 py-3 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50">
                                        {{ $i }}
                                    </th>
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
                            @foreach ($data_peserta as $item)
                                <tr class="text-gray-700 border-b border-gray-200 py-4">
                                    <td class="p-4 uppercase font-semibold">
                                            <Link href="{{ route('admin.peserta.show', ['unit' => $unit, 'periode' => $periode, 'peserta' => $item->id]) }}" >
                                                <p class="text-gray-900 whitespace-nowrap">
                                                    {{ $item->peserta->nama }}
                                                </p>
                                                <p class="text-gray-600 whitespace-nowrap">
                                                    {{ $item->peserta->phone_number }}
                                                </p>
                                            </Link>
                                    </td>
                                    @for($i = 1; $i <= 16; $i++)
                                        @php
                                            $total_hadir = 0;
                                        @endphp
                                        <td class="text-center py-4 px-2 uppercase">
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
                                        {{-- {{ isset($item->data_nilai['ujian']) ? $item->levelTahsin($item->data_nilai['ujian']) : '-' }} --}}
                                        -
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-layouts.card>
        </div>

        @if(session('successCount') || session('failCount'))
            <x-splade-modal opened>
                <div class="alert alert-success">
                    <p>Jumlah data yang berhasil diimport: {{ session('successCount') }}</p>
                    <p>Jumlah data yang gagal diimport: {{ session('failCount') }}</p>
                </div>
            </x-splade-modal>
        @endif

        @if(session('failures'))
            <x-splade-modal opened>
                <div class="alert alert-danger">
                    <h4>Data yang gagal diimport:</h4>
                    <ul>
                        @foreach(session('failures') as $failure)
                            <li>
                                <strong>Baris:</strong> {{ json_encode($failure['row']) }}<br>
                                <strong>Error:</strong> {{ $failure['error'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </x-splade-modal>
        @endif
    </div>
</x-layouts.main>

