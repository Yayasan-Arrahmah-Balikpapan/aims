<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AdminAbsensi implements FromView, ShouldAutoSize
{
    protected $dataperiode;
    protected $data_jadwal;
    protected $data_absen;
    protected $data_absen_tanggal;

    public function __construct($dataperiode, $data_jadwal, $data_absen, $data_absen_tanggal)
    {
        $this->dataperiode = $dataperiode;
        $this->data_jadwal = $data_jadwal;
        $this->data_absen = $data_absen;
        $this->data_absen_tanggal = $data_absen_tanggal;
    }

    public function view(): View
    {
        return view('dashboard.admin.periode.absensi.export', 
        [
            'dataperiode' => $this->dataperiode,
            'data_jadwal' => $this->data_jadwal,
            'data_absen' => $this->data_absen,
            'data_absen_tanggal' => $this->data_absen_tanggal,
        ]);
    }
}