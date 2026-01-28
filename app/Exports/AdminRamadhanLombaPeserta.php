<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class AdminRamadhanLombaPeserta implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{


    public function __construct()
    {
    }

    public function collection()
    {
        return \App\Models\LombaPeserta::with([
            'user',
            'pendaftaran.cabang'
        ])
        ->whereHas('transaksi', function ($q) {
            $q->whereIn('status', [2, 3]);
        })
        ->get()
        ->flatMap(function ($lombaPeserta) {

            return $lombaPeserta->pendaftaran->map(function ($pendaftaran) use ($lombaPeserta) {

                $namaTim = '-';

                // KHUSUS CABANG BEREGU
                if (in_array($pendaftaran->cabang_id, [9, 10])) {

                    /*
                     * Struktur JSON:
                     * data: {
                     *   "9": { ... } atau "10": { ... }
                     * }
                     */

                    $dataCabang = $pendaftaran->data[$pendaftaran->cabang_id] ?? null;

                    if ($dataCabang) {
                        // contoh: nama tim disimpan di key "nama_tim"
                        $namaTim = $dataCabang['nama_tim']
                            ?? 'TIM ' . strtoupper($pendaftaran->cabang->nama);
                    }
                }

                return [
                    'tanggal'   => $pendaftaran->created_at,
                    'telp'      => $lombaPeserta->user->phone_number ?? '',
                    'nama'      => $lombaPeserta->nama ?? '',
                    'jenis'     => $lombaPeserta->jenis_kelamin ?? '',
                    'alamat'    => $lombaPeserta->alamat ?? '',
                    'cabang'    => $pendaftaran->cabang->nama ?? '',
                    'nama_tim'  => $namaTim,
                ];
            });
        });
    }

    public function headings(): array
    {
        return [
            'Tanggal Daftar',
            'No Telp',
            'Nama',
            'Jenis',
            'Alamat',
            'Cabang Lomba',
        ];
    }


    public function map($row): array
    {
        return [
            \Carbon\Carbon::parse($row['tanggal'])->format('d-m-Y H:i'),
            $row['nama'],
            "'" . $row['telp'],
            strtoupper($row['jenis']),
            $row['alamat'],
            $row['cabang'],
        ];
    }
}

