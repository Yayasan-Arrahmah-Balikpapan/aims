<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AdminTransaksi implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
     * @param \App\Models\Periode $periode
     * @return \Illuminate\Support\Collection
     */

    protected $periode;

    public function __construct( $periode)
    {
        $this->periode = $periode;
    }

    public function collection()
    {
        return \App\Models\Transaksi::with(['kelas', 'peserta', 'kelas.jadwal'])->where('periode_id', $this->periode)->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'No Telp',
            'Jenis',
            'Jadwal',
            'Peserta',
            'Total Biaya',
            'Total Transfer',
            'Status Transaksi',
            'Tanggal Transaksi',
        ];
    }
    private function getStatus($transaksi)
    {
        switch ($transaksi) {
            case 1:
                return 'Menunggu Pembayaran';
            case 2:
                return 'Menunggu Konfirmasi';
            case 3:
                return 'Lunas';
            case 4:
                return 'Kadaluarsa';
            default:
                return '';
        }
    }

    private function getPesertaDaftar($peserta)
    {
        switch ($peserta) {
            case 'baru':
                return 'BARU';
            case 'melanjutkan':
                return 'DAFTAR ULANG';
            default:
                return '';
        }
    }

    public function map($transaksi): array
    {
        return [
            $transaksi->peserta->nama ?? '',
            "'".$transaksi->peserta->phone_number ?? '',
            strtoupper($transaksi->peserta ? $transaksi->peserta->jenis_peserta : ''),
            $transaksi->kelas->jadwal ? $transaksi->kelas->jadwal->nama_jadwal : '-',
            $this->getPesertaDaftar($transaksi->kelas->status_daftar ?? ''),
            $transaksi->nominal_total ?? '',
            $transaksi->nominal_total_pembayaran ?? '',
            $this->getStatus($transaksi->status ?? ''),
            $transaksi->created_at->format('d-m-Y'),
        ];
    }
}

