@php
    use Carbon\Carbon;
    $jumlahHari = Carbon::createFromDate($tahun, $bulan)->daysInMonth;
@endphp

<table border="1">
    <thead>
        <tr>
            <th rowspan="2">Tanggal</th>
            @foreach ($users as $user)
                <th colspan="4">{{ $user->name }}</th>
            @endforeach
        </tr>
        <tr>
            @foreach ($users as $user)
                <th>Datang</th>
                <th>Pulang</th>
                <th>Status</th>
                <th>Keterangan</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @for ($i = 1; $i <= $jumlahHari; $i++)
            @php
                $tanggal = Carbon::createFromDate($tahun, $bulan, $i)->format('Y-m-d');
            @endphp
            <tr>
                <td>{{ $i }}</td>
                @foreach ($users as $user)
                    @php
                        $absen = $user->karyawan_absensi->first(function ($item) use ($tanggal) {
                            return Carbon::parse($item->waktu_datang)->format('Y-m-d') === $tanggal;
                        });
                    @endphp
                    <td>{{ $absen?->waktu_datang ? Carbon::parse($absen->waktu_datang)->format('H:i') : '' }}</td>
                    <td>{{ $absen?->waktu_pulang ? Carbon::parse($absen->waktu_pulang)->format('H:i') : '' }}</td>
                    <td>{{ $absen?->status ?? '' }}</td>
                    <td>{{ isset($absen->keterangan['datang']) ? $absen->keterangan['datang'] : '' }}</td>

                @endforeach
            </tr>
        @endfor
    </tbody>
</table>
