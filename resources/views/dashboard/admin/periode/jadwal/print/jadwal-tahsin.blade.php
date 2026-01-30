<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data->periode->nama }}</title>
</head>
<body style="margin: 0; padding: 10px 20px; font-family: Arial, Helvetica, sans-serif; ">

<div style="width: 100%; margin: 0 auto; background: white; ">

    <!-- Header dengan gradien -->
    <div style="padding: 10px;">
        <div style="width: 100%;">
            <div style="font-size: 26px; font-weight: bold; margin-bottom: 5px; letter-spacing: 0.5px;">
                JADWAL TAHSIN ANGKATAN {{ $data->periode->angkatan }}
            </div>
            <div style="display: inline-block; justify-content: start; align-items: center; background-color: black; color: white; font-size: 24px; font-weight: bold; margin-bottom: 4px; text-transform: uppercase; border-radius: 8px; padding: 5px">
                {{ $data->pengajar->kode_nama_pengajar }}
            </div>
            <div style="font-size: 20px; font-weight: bold; margin-bottom: 8px; text-transform: uppercase;">
                {{ $data->level->nama }} - {{ $data->hari_belajar }} {{ $data->jam_mulai }}
            </div>
        </div>
    </div>

    <!-- Konten utama -->
    <div style="padding: 10px;">
        <!-- Tabel untuk absensi -->
        <table style="width: 100%; border-collapse: collapse; border: 1px solid ; margin-bottom: 10px; font-size: 12px">
            <thead>
                <tr>
                    <th style="border: 1px solid ; padding: 5px;">Nama</th>
                    <th style="border: 1px solid ; width: 100px;">Absen</th>
                    @for ($i = 1; $i <= 15; $i++)
                        <th style="border: 1px solid ;">{{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach ($data->kelas as $item)
                    <tr>
                        <td style="border: 1px solid ; padding: 5px; text-transform: uppercase; font-size: 14px">
                            {{ $item->peserta->nama }}<br>
                            {{ $item->peserta->phone_number }}
                        </td>
                        <td style="border: 1px solid ; padding: 5px; text-align: center"></td>
                        @for ($i = 1; $i <= 15; $i++)
                            <th style="border: 1px solid ;">
                                @php
                                    $v_absensi = $data_absensi[$item->id.'-'.$i] ?? '';
                                @endphp
                                @if ($v_absensi == 1)
                                    <img src="{{ public_path('assets/icon/absensi/icon-1.png') }}" alt="Hadir" width="20px" />
                                @elseif ($v_absensi == 4 || $v_absensi == 3)
                                    <img src="{{ public_path('assets/icon/absensi/icon-2.png') }}" alt="Izin" width="20px" />
                                @elseif ($v_absensi == 2)
                                    <img src="{{ public_path('assets/icon/absensi/icon-3.png') }}" alt="Alfa" width="20px" />
                                @else
                                    -
                                @endif
                            </th>
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
