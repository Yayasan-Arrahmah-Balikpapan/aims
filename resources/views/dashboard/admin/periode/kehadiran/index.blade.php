<x-layouts.main :unit="$unit">

    <x-layouts.card>
        <h2 class="text-xl font-bold uppercase">
            Periode {{ $unit }}  Angkatan {{ $dataperiode->angkatan }}, Tahun {{ $dataperiode->tahun_ajaran }}
        </h2>
    </x-layouts.card>

    <div class="md:flex p-3">
        @include('dashboard.admin.periode.menu')
        <div class="px-3 w-full">
            <div class="items-center justify-end flex space-x-2">
                <a href="{{ route('admin.kehadiran.export', ['unit' => $unit, 'periode' => $periode]) }}" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
                    Export
                    @svg('carbon-download', 'ml-2 text-white h-4 w-4')
                </a>
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
                        @if ($dataperiode->format_absensi['jenis_absensi'] == '1')
                            <tr class="border-b border-gray-200 ">
                                <th></th>
                                <th></th>
                                @if ($dataperiode->format_absensi['jenis_absensi'] == '1')
                                    @php
                                        $m_i_start = $dataperiode->waktu_start->format('m');
                                        $m_i_start = $m_i_start - 0;
                                        $d_i_start = $dataperiode->waktu_start->format('d');
                                        $d_i_start = $d_i_start - 0;

                                        $m_i_end = $dataperiode->waktu_end->format('m');
                                        $m_i_end = $m_i_end - 0;
                                        $d_i_end = $dataperiode->waktu_end->format('d');
                                        $d_i_end = $d_i_end - 0;
                                        $d_i_end_add = 0;
                                    @endphp
                                    @for ($i =  $m_i_start; $i <= $m_i_end; $i++)
                                        @php
                                            if($i != $m_i_start){
                                                $d_i_start = 1;
                                            }

                                            if($i != $m_i_end){
                                                $d_i_end_add++;
                                                $md_i_end = $dataperiode->waktu_start->addMonths($d_i_end_add);
                                                $d_i_end = $md_i_end->endOfMonth()->format('d');
                                                $cd_i_end = $d_i_end - $d_i_start + 1;
                                                $d_i_end = $d_i_end - 0;
                                            } else {
                                                $d_i_end = $dataperiode->waktu_end->format('d');
                                                $d_i_end = $d_i_end - 0;
                                            }
                                        @endphp
                                            <th colspan="{{ $dataperiode->format_absensi['jenis_laporan'] == 'harian' ? $cd_i_end : '' }}"
                                                class="p-2 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50 border-x border-gray-200">
                                                {{ $md_i_end->format('M Y') }}
                                            </th>
                                    @endfor
                                @elseif ($dataperiode->format_absensi['jenis_absensi'] == '2')
                                    <th></th>
                                @else 
                                    <th></th>
                                @endif
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        @endif
                        <tr class="border-b border-gray-200 ">
                            <th scope="col" class="px-3 py-3 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50">
                                Nama
                            </th>
                            <th scope="col" class="px-3 py-3 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50">
                                Jadwal
                            </th>
                            @if ($dataperiode->format_absensi['jenis_absensi'] == '1')
                                @php
                                    $m_i_start = $dataperiode->waktu_start->format('m');
                                    $m_i_start = $m_i_start - 0;
                                    $d_i_start = $dataperiode->waktu_start->format('d');
                                    $d_i_start = $d_i_start - 0;

                                    $m_i_end = $dataperiode->waktu_end->format('m');
                                    $m_i_end = $m_i_end - 0;
                                    $d_i_end = $dataperiode->waktu_end->format('d');
                                    $d_i_end = $d_i_end - 0;
                                    $d_i_end_add = 0;
                                @endphp
                                @for ($i =  $m_i_start; $i <= $m_i_end; $i++)
                                    @if ($dataperiode->format_absensi['jenis_laporan'] == 'harian')
                                        @php
                                            if($i != $m_i_start){
                                                $d_i_start = 1;
                                            }

                                            if($i != $m_i_end){
                                                $d_i_end_add++;
                                                $d_i_end = $dataperiode->waktu_start->addMonths($d_i_end_add);
                                                $d_i_end = $d_i_end->endOfMonth()->format('d');
                                                $d_i_end = $d_i_end - 0;
                                            } else {
                                                $d_i_end = $dataperiode->waktu_end->format('d');
                                                $d_i_end = $d_i_end - 0;
                                            }
                                        @endphp
                                        @for ($j = $d_i_start; $j <= $d_i_end; $j++)
                                            <th scope="col"
                                                class="p-2 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50 border-x border-gray-200">
                                                {{ $j }}
                                            </th>
                                        @endfor
                                    @else
                                        <th scope="col"
                                            class="p-2 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50 border-x border-gray-200">
                                            
                                        </th>
                                    @endif
                                @endfor
                            @elseif ($dataperiode->format_absensi['jenis_absensi'] == '2')
                                @for ($i = 1; $i <= $dataperiode->format_absensi['jumlah_pertemuan']; $i++)
                                    <th scope="col"
                                        class="p-2 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50">
                                        {{ $i }}
                                    </th>
                                @endfor
                            @else 
                                <th scope="col" class="p-2 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50">
                                    Belum Pilih Format Absensi
                                </th>
                            @endif
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
                            @php
                                $total_hadir = 0;
                            @endphp
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
                                @if ($dataperiode->format_absensi['jenis_absensi'] == '1')
                                    @php
                                        $m_i_start = $dataperiode->waktu_start->format('m');
                                        $m_i_start = $m_i_start - 0;
                                        $d_i_start = $dataperiode->waktu_start->format('d');
                                        $d_i_start = $d_i_start - 0;

                                        $m_i_end = $dataperiode->waktu_end->format('m');
                                        $m_i_end = $m_i_end - 0;
                                        $d_i_end = $dataperiode->waktu_end->format('d');
                                        $d_i_end = $d_i_end - 0;
                                        $d_i_end_add = 0;
                                    @endphp
                                    @for ($i = $m_i_start; $i <= $m_i_end; $i++)
                                        @if ($dataperiode->format_absensi['jenis_laporan'] == 'harian')
                                            @php
                                                if($i != $m_i_start){
                                                    $d_i_start = 1;
                                                }

                                                if($i != $m_i_end){
                                                    $d_i_end_add++;
                                                    $d_i_end = $dataperiode->waktu_start->addMonths($d_i_end_add);
                                                    $d_i_end = $d_i_end->endOfMonth()->format('d');
                                                    $d_i_end = $d_i_end - 0;
                                                } else {
                                                    $d_i_end = $dataperiode->waktu_end->format('d');
                                                    $d_i_end = $d_i_end - 0;
                                                }

                                                $dy = $dataperiode->waktu_start->addMonths($d_i_end_add);
                                            @endphp
                                            @for ($j = $d_i_start; $j <= $d_i_end; $j++)
                                                <td class="text-center p-2 uppercase border-x border-gray-200">
                                                @if(isset($data_absensi_tanggal[$item->id.'-'.$j.'-'.$dy->format('m-Y')]))
                                                        <x-carbon-checkmark class="w-6 h-6 text-sky-500" />
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            @endfor
                                        @else
                                            <td class=" p-2 uppercase border-x border-gray-200">
                                                <div></div>
                                                <div>
                                                    <x-carbon-add-alt class="w-6 h-6 text-gray-700" />
                                                </div>
                                            </td>
                                        @endif
                                    @endfor
                                @elseif ($dataperiode->format_absensi['jenis_absensi'] == '2')
                                    @for ($i = 1; $i <= $dataperiode->format_absensi['jumlah_pertemuan']; $i++)
                                        <td class="text-center p-2 uppercase">
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
                                @else 
                                    <td class="text-center p-2 uppercase">
                                        Belum Pilih Format Absensi
                                    </td>
                                @endif
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
