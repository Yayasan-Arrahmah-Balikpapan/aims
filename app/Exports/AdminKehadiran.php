<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AdminKehadiran implements FromView, ShouldAutoSize
{
    protected $dataperiode;
    protected $data_peserta;
    protected $data_absensi_peserta;
    protected $data_absensi_tanggal;

    public function __construct($dataperiode, $data_peserta, $data_absensi_peserta, $data_absensi_tanggal)
    {
        $this->dataperiode = $dataperiode;
        $this->data_peserta = $data_peserta;
        $this->data_absensi_peserta = $data_absensi_peserta;
        $this->data_absensi_tanggal = $data_absensi_tanggal;
    }

    public function view(): View
    {
        return view('dashboard.admin.periode.kehadiran.export', 
        [
            'dataperiode' => $this->dataperiode,
            'data_peserta' => $this->data_peserta,
            'data_absensi_peserta' => $this->data_absensi_peserta,
            'data_absensi_tanggal' => $this->data_absensi_tanggal,
        ]);
    }
}
