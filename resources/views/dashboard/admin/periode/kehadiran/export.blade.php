 <table>
    <thead>
        @if ($dataperiode->format_absensi['jenis_absensi'] == '1')
            <tr>
                <th></th>
                <th></th>
                <th></th>
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
                            <th colspan="{{ $dataperiode->format_absensi['jenis_laporan'] == 'harian' ? $cd_i_end : '' }}">
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
        <tr>
            <th>
                Nama
            </th>
            <th>
                Jenis
            </th>
            <th>
                Level
            </th>
            <th>
                Pengajar
            </th>
            <th>
                Waktu Jadwal
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
                            <th>
                                {{ $j }}
                            </th>
                        @endfor
                    @else
                        <th>
                            
                        </th>
                    @endif
                @endfor
            @elseif ($dataperiode->format_absensi['jenis_absensi'] == '2')
                @for ($i = 1; $i <= $dataperiode->format_absensi['jumlah_pertemuan']; $i++)
                    <th>
                        {{ $i }}
                    </th>
                @endfor
            @else 
                <th>
                    Belum Pilih Format Absensi
                </th>
            @endif
            
            @if ($dataperiode->format_absensi['jenis_absensi'] == '2')
                <th>
                    Total Hadir
                </th>
                <th>Mengikuti Ujian</th>
                <th>Nilai Ujian</th>
            @else
                <th></th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($data_peserta as $item)
            @php
                $total_hadir = 0;
            @endphp
            <tr>
                <td>
                    {{ $item->peserta->nama }}
                </td>
                <td>
                    {{ isset($item->jadwal) ? ($item->jadwal->jenis_peserta ?? '-') : '-' }}
                </td>
                <td>
                    {{ isset($item->jadwal) ? ($item->jadwal->level->nama ?? '-') : '-' }}
                </td>
                <td>
                    {{ isset($item->jadwal) ? ($item->jadwal->pengajar->kode_nama_pengajar ?? '-') : '-' }}
                </td>
                <td>
                    {{ isset($item->jadwal) ? ($item->jadwal->hari_belajar . ' ' . $item->jadwal->jam_mulai) : '-' }}
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
                                <td>
                                @if(isset($data_absen_tanggal[$item->id.'-'.$j.'-'.$dy->format('m-Y')]))
                                        1
                                    @else
                                        -
                                    @endif
                                </td>
                            @endfor
                        @else
                            <td>
                                <div></div>
                                <div>
                                    -
                                </div>
                            </td>
                        @endif
                    @endfor
                @elseif ($dataperiode->format_absensi['jenis_absensi'] == '2')
                    @for ($i = 1; $i <= $dataperiode->format_absensi['jumlah_pertemuan']; $i++)
                        <td>
                            @if (isset($data_absensi_peserta[$item->id.'-'.$i]))
                                @if ($data_absensi_peserta[$item->id.'-'.$i] == 1)
                                    @php
                                        $total_hadir += 1;
                                    @endphp
                                    1
                                @elseif ($data_absensi_peserta[$item->id.'-'.$i] == 2)
                                    0
                                @elseif ($data_absensi_peserta[$item->id.'-'.$i] == 3 || $data_absensi_peserta[$item->id.'-'.$i] == 4)
                                    0
                                @else
                                    -
                                @endif
                            @else
                                -
                            @endif
                        </td>
                    @endfor
                @else 
                    <td>
                        Belum Pilih Format Absensi
                    </td>
                @endif
                <td>
                    {{ $total_hadir }}
                </td>
                <td>
                    @if ($total_hadir >= 10)
                        BOLEH
                    @else
                        BELUM
                    @endif
                </td>
                <td>-</td>
            </tr>
        @endforeach
    </tbody>
</table>
