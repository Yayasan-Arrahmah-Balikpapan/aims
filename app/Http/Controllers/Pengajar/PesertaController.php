<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class PesertaController extends Controller
{
    public function index($unit)
    {

        $data_periode = Cache::remember('pengajar_peserta_periode.'.$unit, now()->addDay(), function () use ($unit) {
            return \App\Models\Periode::whereHas('unit', function($query) use ($unit) {
                                $query->where('slug', $unit);
                            })
                            ->latest()
                            ->paginate(10);
        });
        $data_pengajar = Cache::remember('pengajar_peserta_pengajar.'.$unit, now()->addDay(), function () use ($unit) {
            return \App\Models\Pengajar::whereHas('unit', function($query) use ($unit) {
                                $query->where('slug', $unit);
                            })
                            ->first();
        });

        return view('dashboard.pengajar.peserta.index', compact( 'unit', 'data_periode', 'data_pengajar'));
    }

    public function data($unit, $periode) {
        $data_periode = Cache::remember('pengajar_peserta_periode.'.$unit.'.'.$periode, now()->addMinutes(10), function () use ($periode) {
            return \App\Models\Periode::find($periode);
        });
        $data_pengajar = Cache::remember('pengajar_peserta_pengajar.'.$unit, now()->addMinutes(10), function () use ($unit) {
            return \App\Models\Pengajar::whereHas('unit', function($query) use ($unit) {
                                $query->where('slug', $unit);
                            })
                            ->first();
        });

        $data_peserta =  \App\Models\Kelas::where('periode_id', $periode)
                        ->cari(request()->query('cari'))
                        ->jenisPeserta(request()->query('jenis_peserta'))
                        ->statusDaftarPeserta(request()->query('peserta'))
                        ->statusPendaftaran(request()->query('status'))
                        ->cariLevel(request()->query('level'))
                        ->latest()
                        ->paginate(10);

        $data_level = Cache::remember('pengajar_peserta_level.'.$unit.'.'.$periode, now()->addMinutes(10), function () use ($data_periode) {
            return \App\Models\Modules\Level::where('unit_id', $data_periode->unit_id)->get();
        });

        return view('dashboard.pengajar.peserta.data', compact('unit', 'periode', 'data_pengajar', 'data_peserta', 'data_periode', 'data_level'));
    }

    public function show($unit, $periode, $peserta)
    {
        $data_periode = Cache::remember('pengajar_peserta_periode.'.$unit.'.'.$periode, now()->addHours(1), function () use ($periode) {
            return \App\Models\Periode::find($periode);
        });
        $data_peserta = Cache::remember('pengajar_peserta.'.$unit.'.'.$periode.'.'.$peserta, now()->addHours(1), function () use ($periode, $peserta) {
            return \App\Models\Kelas::find($peserta);
        });
        $datalevel = Cache::remember('pengajar_peserta_level.'.$unit.'.'.$periode, now()->addHours(1), function () use ($data_periode) {
            return \App\Models\Modules\Level::where('unit_id', $data_periode->unit_id)->get();
        });
        return view('dashboard.pengajar.peserta.show', compact('data_peserta', 'data_periode', 'unit', 'datalevel'));
    }
}
