{{-- <div class="items-center justify-end flex space-x-2">
    <a href="{{ route('admin.absensi.export', ['unit' => $unit, 'periode' => $periode]) }}" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
        Export
        @svg('carbon-download', 'ml-2 text-white h-4 w-4')
    </a>
    <Link modal max-width="lg" href="{{ route('admin.jadwal.create', ['unit' => $unit, 'periode' => $periode]) }}" class="text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
        Tambah Data
        @svg('carbon-add-filled', 'ml-2 text-white h-4 w-4')
    </Link>
</div> --}}
<x-splade-form method="GET" class="sm:flex items-center sm:space-x-2 border border-gray-300 rounded-lg p-2 mb-2"
    :default="[
            'jenis_peserta' => request()->query('jenis_peserta') ?? '',
            'level' => request()->query('level') ?? '',
            'sesi' => request()->query('sesi') ?? '',
            'pengajar' => request()->query('pengajar') ?? '',
            'bulan' => request()->query('bulan') ?? '',
            'tahun' => request()->query('tahun') ?? '',
        ],
    ">
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-1">
        <x-splade-select name="pengajar">
            <option value="" disabled selected>-- Pengajar</option>
            @foreach ( $data_pengajar as $pengajar )
                <option value="{{ $pengajar->id }}">{{ $pengajar->kode_nama_pengajar }}</option>
            @endforeach
            <option value="">Semua</option>
        </x-splade-select>
        <x-splade-select name="sesi">
            <option value="" disabled selected>-- Sesi</option>
            <option value="SIANG">SIANG</option>
            <option value="SORE">SORE</option>
            <option value="MALAM">MALAM</option>
            <option value="BADAL">BADAL</option>
            <option value="">Semua</option>
        </x-splade-select>
        <x-splade-select name="bulan">
            <option value="" disabled selected>-- Bulan</option>
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
            <option value="6">Juni</option>
            <option value="7">Juli</option>
            <option value="8">Agustus</option>
            <option value="9">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
            <option value="">Semua</option>
        </x-splade-select>
        <x-splade-select name="tahun">
            <option value="" disabled selected>-- Tahun</option>
            @php
                $current_year = \Carbon\Carbon::now()->format('Y');
            @endphp
            @for ($i = $current_year; $i >= 2020; $i--)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
            <option value="">Semua</option>
        </x-splade-select>
    </div>
    <x-splade-submit :label="__('Lihat')"/>
</x-splade-form>
<div class="relative overflow-x-scroll border rounded-md mb-4 bg-white">
    <table class="text-sm text-left text-gray-500 w-full">
        <thead>
            @isset($dataperiode->format_absensi['jenis_absensi'])
                @if ($dataperiode->format_absensi['jenis_absensi'] == '1')
                    <tr class="border-b border-gray-200 ">
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
                    </tr>
                @endif
            @endisset

            <tr class="border-b border-gray-200 ">
                <th class="p-2 text-center font-bold text-gray-900 bg-gray-50">
                    Jadwal
                </th>
                @isset($dataperiode->format_absensi['jenis_absensi'])
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
                @endisset

                <th scope="col" class="p-2 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50">
                    @isset($dataperiode->format_absensi['jenis_absensi'])
                        @if ($dataperiode->format_absensi['jenis_absensi'] == '2')
                            Jumlah
                        @endif
                    @endisset
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_jadwal as $item)
                @php
                    $total_hadir = 0;
                @endphp
                <tr class="text-gray-700 border-b border-gray-200 py-4">
                    <td class="p-2 uppercase font-semibold whitespace-nowrap">
                        {{ $item->nama_jadwal }}
                    </td>
                    @isset($dataperiode->format_absensi['jenis_absensi'])
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
                                        @if(isset($data_absen_tanggal[$item->id.'-'.$j.'-'.$dy->format('m-Y')]))
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
                                    @if(isset($data_absen[$item->id.'-'.$i]))
                                        @php
                                            $total_hadir += 1;
                                        @endphp
                                        {{ \Carbon\Carbon::parse($data_absen[$item->id.'-'.$i])->format('d-m-Y') }}
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
                    @endisset
                    <td class="text-center p-2 uppercase">
                        {{ $total_hadir }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="p-2 text-gray-500">
    {{ $data_jadwal->appends(request()->query())->links() }}
</div>
