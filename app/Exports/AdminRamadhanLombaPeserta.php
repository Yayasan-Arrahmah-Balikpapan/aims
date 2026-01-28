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
            'pendaftaran.cabang',
            'transaksi'
        ])
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

                    $dataCabang = $pendaftaran->data ?? null;

                    if ($dataCabang) {
                        // contoh: nama tim disimpan di key "nama_tim"
                        $namaTim = $dataCabang[$pendaftaran->cabang_id]
                            ?? 'TIM ' . strtoupper($pendaftaran->cabang->nama);
                    }
                }

                return [
                    'tanggal'   => $pendaftaran->created_at,
                    'telp'      => $lombaPeserta->user->phone_number ?? '',
                    'nama'      => $lombaPeserta->nama ?? '',
                    'tanggal_lahir'  => $lombaPeserta->tanggal_lahir ?? '',
                    'jenis'     => $lombaPeserta->jenis_kelamin ?? '',
                    'alamat'    => $lombaPeserta->alamat ?? '',
                    'cabang'    => $pendaftaran->cabang->nama ?? '',
                    'nama_tim'  => $namaTim,
                    'status_pembayaran' => $lombaPeserta->transaksi->status == 1 ? 'Menunggu Pembayaran' : ($lombaPeserta->transaksi->status == 2 ? 'Menunggu Konfirmasi' : 'Lunas'),
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
            'Tanggal Lahir',
            'Jenis',
            'Alamat',
            'Cabang Lomba',
            'Status Pembayaran',
            'Nama Tim',
        ];
    }


    public function map($row): array
    {
        return [
            \Carbon\Carbon::parse($row['tanggal'])->format('d-m-Y H:i'),
            "'" . $row['telp'],
            $row['nama'],
            $row['tanggal_lahir'],
            strtoupper($row['jenis']),
            $row['alamat'],
            $row['cabang'],
            $row['status_pembayaran'],
            $row['nama_tim'],
        ];
    }
}

