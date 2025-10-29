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
            <div class="w-full">
                <x-splade-form method="GET" class="sm:flex items-center sm:space-x-2 border border-gray-300 rounded-lg p-2 mb-2"
                    :default="[
                            'cari' => request()->query('cari') ?? '',
                            'jenis_peserta' => request()->query('jenis_peserta') ?? '',
                            'status' => request()->query('status') ?? '',
                            'peserta' => request()->query('peserta') ?? '',
                            'level' => request()->query('level') ?? '',
                        ],
                    ">
                    <x-splade-input value="{{ request()->query('cari') }}" name="cari" placeholder="Nama Peserta" class="flex-grow"/>
                    <x-splade-select name="jenis_peserta">
                        <option value="" disabled selected>-- Jenis</option>
                        <option value="ikhwan">Ikhwan</option>
                        <option value="akhwat">Akhwat</option>
                        <option value="">Semua</option>
                    </x-splade-select>
                    <x-splade-select name="peserta">
                        <option value="" disabled selected>-- Peserta</option>
                        <option value="baru">Baru</option>
                        <option value="melanjutkan">Daftar Ulang</option>
                        <option value="">Semua</option>
                    </x-splade-select>
                    <x-splade-select name="level">
                        <option value="" disabled selected>-- Level</option>
                        @foreach ( $data_level as $level )
                            <option value="{{ $level->id }}">{{ $level->nama }}</option>
                        @endforeach
                        <option value="">Semua</option>
                    </x-splade-select>
                    <x-splade-select name="status">
                        <option value="" disabled selected>-- Status</option>
                        <option value="belum diberikan level">Belum Diberikan Level</option>
                        <option value="belum pilih jadwal">Belum Pilih Jadwal</option>
                        <option value="selesai pilih jadwal">Selesai Pilih Jadwal</option>
                        <option value="">Semua</option>
                    </x-splade-select>
                    <x-splade-submit :label="__('Cari')"/>
                </x-splade-form>
            </div>
            <div class="relative overflow-x-auto border rounded-md mb-4 bg-white">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead>
                        <tr class="border-b border-gray-200 ">
                            <th scope="col" class="px-3 py-3 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50">
                                Nama
                            </th>
                            <th scope="col" class="px-3 py-3 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50">
                                Jadwal
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
                                <td class="p-4 uppercase font-semibold">
                                    {{ $item->jadwal->nama_jadwal ?? '' }}
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
            <div class="p-2 text-gray-500">
                {{ $data_peserta->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-layouts.main>
