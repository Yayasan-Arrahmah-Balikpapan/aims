<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index($unit)
    {

        $data_periode = \App\Models\Periode::whereHas('unit', function($query) use ($unit) {
                            $query->where('slug', $unit);
                        })
                        ->latest()
                        ->paginate(10);
        $data_pengajar = \App\Models\Pengajar::whereHas('unit', function($query) use ($unit) {
                            $query->where('slug', $unit);
                        })
                        ->first();

        return view('dashboard.pengajar.peserta.index', compact( 'unit', 'data_periode', 'data_pengajar'));
    }

    public function data($unit, $periode) {
        $data_periode = \App\Models\Periode::find($periode);
        $data_pengajar = \App\Models\Pengajar::whereHas('unit', function($query) use ($unit) {
                            $query->where('slug', $unit);
                        })
                        ->first();

        $data_peserta = \App\Models\Kelas::where('periode_id', $periode)
                        ->cari(request()->query('cari'))
                        ->jenisPeserta(request()->query('jenis_peserta'))
                        ->statusPendaftaran(request()->query('status'))
                        ->cariLevel(request()->query('level'))
                        ->latest()
                        ->paginate(10);
        $data_level = \App\Models\Modules\Level::where('unit_id', $data_periode->unit_id)->get();

        return view('dashboard.pengajar.peserta.data', compact('unit', 'periode', 'data_pengajar', 'data_peserta', 'data_periode', 'data_level'));
    }

    public function show($unit, $periode, $peserta)
    {
        $data_periode = \App\Models\Periode::find($periode);
        $data_peserta = \App\Models\Kelas::find($peserta);
        $datalevel = \App\Models\Modules\Level::where('unit_id', $data_periode->unit_id)->get();
        return view('dashboard.pengajar.peserta.show', compact('data_peserta', 'data_periode', 'unit', 'datalevel'));
    }
}
