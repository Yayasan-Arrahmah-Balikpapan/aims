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
        <x-layouts.card-periode>
            <div class="flex items-start justify-start pb-2">
                {{-- <Link modal max-width="lg" href="{{ route('admin.jadwal.import', ['unit' => $unit, 'jadwal'=> $jadwal->id]) }}" title=""
                    class="mt-4 sm:mt-0 text-green-500 font-medium rounded-lg border border-green-500 text-sm px-4 py-1 lg:py-2.5 flex items-center justify-between"
                    role="button">
                    Import Data
                    <x-carbon-document-add class="w-5 h-5 ml-3 text-green-500"/>
                </Link> --}}
            </div>
            @if(!$pesertas)
                <div class="text-center py-6">
                    <h3 class="text-2xl font-bold text-gray-900">Belum memiliki peserta</h3>
                </div>
            @else
            <x-splade-table :for="$pesertas">
                <x-slot name="head">
                    <thead>
                        <tr class="text-sm text-gray-700 uppercase bg-gray-50">
                            @foreach($pesertas->columns() as $column)
                                <th class="p-2">{{ $column->label }}</th>
                                @for ($i = 1; $i <= 16; $i++)
                                    <th>{{ $i }}</th>
                                @endfor
                                <th>Nilai Ujian</th>
                            @endforeach
                        </tr>
                    </thead>
                </x-slot>
                <x-slot name="body">
                    <tbody>
                        @foreach($pesertas->resource as $peserta)
                            <tr class="text-gray-900 ">
                                <td class="p-2 uppercase">{{ $peserta->peserta->nama }}</td>
                                @for($i = 1; $i <= 16; $i++)
                                    <td class="text-center p-2 uppercase text-xs font-bold">
                                        -
                                    </td>
                                @endfor
                                <td class="text-center p-2 uppercase text-xs font-bold">
                                    -
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-slot>
            </x-splade-table>
            @endif
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

