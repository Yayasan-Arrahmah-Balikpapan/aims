<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AdminJadwal implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $periode;
    public function __construct( $periode)
    {
        $this->periode = $periode;
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Jumlah Peserta',
            'Batasan',
            'Pengajar',
            'Level',
            'Hari',
            'Jam',
            'Jenis',
            'Status Belajar',
        ];
    }

    public function collection()
    {
        return \App\Models\Jadwal::with(['kelas', 'pengajar'])->where('periode_id', $this->periode)->get();
    }

    public function map($jadwal): array
    {
        return [
            'nama' => $jadwal->nama_jadwal ?? '',
            'jumlah_peserta' => $jadwal->kelas->count(),
            'batasan' => $jadwal->batasan_peserta ?? '',
            'pengajar' => $jadwal->pengajar->kode_nama_pengajar ?? '',
            'level' => $jadwal->level->nama ?? '',
            'hari' => $jadwal->hari_belajar ?? '',
            'jam' => $jadwal->jam_mulai ?? '' . ' - ' . $jadwal->jam_selesai ?? '',
            'jenis' => $jadwal->jenis_peserta ?? '',
            'status_belajar' => $jadwal->status_belajar ?? '',
        ];    
    }
}
