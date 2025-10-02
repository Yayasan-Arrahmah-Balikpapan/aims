<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class AdminPeserta implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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
        return \App\Models\Kelas::with(['peserta', 'jadwal'])->where('periode_id', $this->periode)->get();
    }

    public function headings(): array
    {
        return [
            'NIS',
            'Nama',
            'No Telp',
            'Jenis',
            'Jadwal',
            'Pengajar',
            'Level',
            'Status Belajar',
            'Hari',
            'Jam',
            'Peserta',
            'Tanggal Daftar',
        ];
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

    public function map($peserta_kelas): array
    {
        return [
            $peserta_kelas->nis_peserta ?? '',
            $peserta_kelas->peserta->nama ?? '',
            "'".$peserta_kelas->peserta->phone_number ?? '',
            strtoupper($peserta_kelas->peserta ? $peserta_kelas->peserta->jenis_peserta : ''),
            $peserta_kelas->jadwal ? $peserta_kelas->jadwal->nama_jadwal : '-',
            $peserta_kelas->jadwal ? $peserta_kelas->jadwal->pengajar->kode_nama_pengajar : '-',
            $peserta_kelas->jadwal ? $peserta_kelas->jadwal->status_belajar : '-',
            $peserta_kelas->jadwal ? $peserta_kelas->jadwal->hari_belajar : '-',
            $peserta_kelas->jadwal ? $peserta_kelas->jadwal->jam_mulai : '-',
            $this->getPesertaDaftar($peserta_kelas->status_daftar ?? ''),
            $peserta_kelas->created_at->format('d-m-Y'),
        ];
    }
}

