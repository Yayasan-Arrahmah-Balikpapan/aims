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
                        $namaAnggota1 = isset($dataCabang[$pendaftaran->cabang_id]['peserta_1']) ? $dataCabang[$pendaftaran->cabang_id]['peserta_1']['nama'] : '';
                        $jenisAnggota1 = isset($dataCabang[$pendaftaran->cabang_id]['peserta_1']) ? $dataCabang[$pendaftaran->cabang_id]['peserta_1']['jenis'] : '';
                        $kelasAnggota1 = isset($dataCabang[$pendaftaran->cabang_id]['peserta_1']) ? $dataCabang[$pendaftaran->cabang_id]['peserta_1']['kelas'] : '';
                        $sekolahAnggota1 = isset($dataCabang[$pendaftaran->cabang_id]['peserta_1']) ? $dataCabang[$pendaftaran->cabang_id]['peserta_1']['asalsekolah'] : '';

                        $namaAnggota2 = isset($dataCabang[$pendaftaran->cabang_id]['peserta_2']) ? $dataCabang[$pendaftaran->cabang_id]['peserta_2']['nama'] : '';
                        $jenisAnggota2 = isset($dataCabang[$pendaftaran->cabang_id]['peserta_2']) ? $dataCabang[$pendaftaran->cabang_id]['peserta_2']['jenis'] : '';
                        $kelasAnggota2 = isset($dataCabang[$pendaftaran->cabang_id]['peserta_2']) ? $dataCabang[$pendaftaran->cabang_id]['peserta_2']['kelas'] : '';
                        $sekolahAnggota2 = isset($dataCabang[$pendaftaran->cabang_id]['peserta_2']) ? $dataCabang[$pendaftaran->cabang_id]['peserta_2']['asalsekolah'] : '';

                        $namaAnggota3 = isset($dataCabang[$pendaftaran->cabang_id]['peserta_3']) ? $dataCabang[$pendaftaran->cabang_id]['peserta_3']['nama'] : '';
                        $jenisAnggota3 = isset($dataCabang[$pendaftaran->cabang_id]['peserta_3']) ? $dataCabang[$pendaftaran->cabang_id]['peserta_3']['jenis'] : '';
                        $kelasAnggota3 = isset($dataCabang[$pendaftaran->cabang_id]['peserta_3']) ? $dataCabang[$pendaftaran->cabang_id]['peserta_3']['kelas'] : '';
                        $sekolahAnggota3 = isset($dataCabang[$pendaftaran->cabang_id]['peserta_3']) ? $dataCabang[$pendaftaran->cabang_id]['peserta_3']['asalsekolah'] : '';
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
                    'status_pembayaran' => $lombaPeserta->transaksi->status == 1 ? 'Menunggu Pembayaran' : ($lombaPeserta->transaksi->status == 2 ? 'Menunggu Konfirmasi' : 'Lunas'),
                    'nama_tim'  => $namaTim,
                    'nama_anggota_1'    => $namaAnggota1 ?? '',
                    'jenis_anggota_1'   => $jenisAnggota1 ?? '',
                    'kelas_anggota_1'   => $kelasAnggota1 ?? '',
                    'sekolah_anggota_1' => $sekolahAnggota1 ?? '',
                    'nama_anggota_2'    => $namaAnggota2 ?? '',
                    'jenis_anggota_2'   => $jenisAnggota2 ?? '',
                    'kelas_anggota_2'   => $kelasAnggota2 ?? '',
                    'sekolah_anggota_2' => $sekolahAnggota2 ?? '',
                    'nama_anggota_3'    => $namaAnggota3 ?? '',
                    'jenis_anggota_3'   => $jenisAnggota3 ?? '',
                    'kelas_anggota_3'   => $kelasAnggota3 ?? '',
                    'sekolah_anggota_3' => $sekolahAnggota3 ?? '',
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
            'Nama Anggota 1',
            'Jenis Anggota 1',
            'Kelas Anggota 1',
            'Sekolah Anggota 1',
            'Nama Anggota 2',
            'Jenis Anggota 2',
            'Kelas Anggota 2',
            'Sekolah Anggota 2',
            'Nama Anggota 3',
            'Jenis Anggota 3',
            'Kelas Anggota 3',
            'Sekolah Anggota 3',
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
            $row['nama_anggota_1'],
            $row['jenis_anggota_1'],
            $row['kelas_anggota_1'],
            $row['sekolah_anggota_1'],
            $row['nama_anggota_2'],
            $row['jenis_anggota_2'],
            $row['kelas_anggota_2'],
            $row['sekolah_anggota_2'],
            $row['nama_anggota_3'],
            $row['jenis_anggota_3'],
            $row['kelas_anggota_3'],
            $row['sekolah_anggota_3'],
        ];
    }
}

