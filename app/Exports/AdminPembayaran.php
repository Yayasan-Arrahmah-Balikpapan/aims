<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AdminPembayaran implements FromView, ShouldAutoSize
{
    protected $dataperiode;
    protected $data_biaya;
    protected $data_peserta;
    protected $data_pembayaran_peserta;
    protected $data_transaksi_peserta;
    protected $data_level;
    protected $data_nominal;
    protected $sum_data_biaya;
    protected $expiration_time;
    protected $total_biaya_periode;
    protected $jumlah_nominal_piutang;
    protected $total_biaya_seluruh_peserta;

    public function __construct($dataperiode, $data_biaya, $data_peserta, $data_pembayaran_peserta, $data_transaksi_peserta, $data_level, $data_nominal, $sum_data_biaya, $expiration_time, $total_biaya_periode, $jumlah_nominal_piutang, $total_biaya_seluruh_peserta)
    {
        $this->dataperiode = $dataperiode;
        $this->data_biaya = $data_biaya;
        $this->data_peserta = $data_peserta;
        $this->data_pembayaran_peserta = $data_pembayaran_peserta;
        $this->data_transaksi_peserta = $data_transaksi_peserta;
        $this->data_level = $data_level;
        $this->data_nominal = $data_nominal;
        $this->sum_data_biaya = $sum_data_biaya;
        $this->expiration_time = $expiration_time;
        $this->total_biaya_periode = $total_biaya_periode;
        $this->jumlah_nominal_piutang = $jumlah_nominal_piutang;
        $this->total_biaya_seluruh_peserta = $total_biaya_seluruh_peserta;
    }

    public function view(): View
    {
        return view('dashboard.admin.periode.pembayaran.export', 
        [
            'dataperiode' => $this->dataperiode,
            'data_biaya' => $this->data_biaya,
            'data_peserta' => $this->data_peserta,
            'data_pembayaran_peserta' => $this->data_pembayaran_peserta,
            'data_transaksi_peserta' => $this->data_transaksi_peserta,
            'data_level' => $this->data_level,
            'data_nominal' => $this->data_nominal,
            'sum_data_biaya' => $this->sum_data_biaya,
            'expiration_time' => $this->expiration_time,
            'total_biaya_periode' => $this->total_biaya_periode,
            'jumlah_nominal_piutang' => $this->jumlah_nominal_piutang,
            'total_biaya_seluruh_peserta' => $this->total_biaya_seluruh_peserta,
        ]);
    }
}
