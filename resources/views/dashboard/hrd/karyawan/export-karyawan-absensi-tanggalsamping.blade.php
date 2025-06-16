@php
    use Carbon\Carbon;
    $jumlahHari = Carbon::createFromDate($tahun, $bulan)->daysInMonth;
@endphp

<table border="1">
    <thead>
        <tr>
            <th rowspan="3">Nama</th>
            @for ($i = 1; $i <= $jumlahHari; $i++)
                <th colspan="4">{{ $i }}</th>
            @endfor
        </tr>
        <tr>
            @for ($i = 1; $i <= $jumlahHari; $i++)
                @php
                    $tanggal = Carbon::createFromDate($tahun, $bulan, $i)->translatedFormat('l, d M');
                @endphp
                <th colspan="4">{{ $tanggal }}</th>
            @endfor
        </tr>
        <tr>
            @for ($i = 1; $i <= $jumlahHari; $i++)
                <th>Dat</th>
                <th>Pul</th>
                <th>Sta</th>
                <th>Ket</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                @for ($i = 1; $i <= $jumlahHari; $i++)
                    @php
                        $tanggal = Carbon::createFromDate($tahun, $bulan, $i)->format('Y-m-d');
                        $absen = $user->karyawan_absensi->first(function ($item) use ($tanggal) {
                            return Carbon::parse($item->waktu_datang)->format('Y-m-d') === $tanggal;
                        });
                    @endphp
                    <td>{{ $absen?->waktu_datang ? Carbon::parse($absen->waktu_datang)->format('H:i') : '' }}</td>
                    <td>{{ $absen?->waktu_pulang ? Carbon::parse($absen->waktu_pulang)->format('H:i') : '' }}</td>
                    <td>{{ $absen?->status ?? '' }}</td>
                    <td>{{ isset($absen->keterangan['datang']) ? $absen->keterangan['datang'] : '' }}</td>
                @endfor
            </tr>
        @endforeach
    </tbody>
</table>
