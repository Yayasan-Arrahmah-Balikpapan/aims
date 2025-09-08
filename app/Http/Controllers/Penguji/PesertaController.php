<?php

namespace App\Http\Controllers\Penguji;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class PesertaController extends Controller
{

    public function index($unit)
    {

        $data_periode = Cache::remember('penguji_peserta_periode.'.$unit, now()->addDays(1), function () use ($unit) {
            return \App\Models\Periode::whereHas('unit', function($query) use ($unit) {
                                $query->where('slug', $unit);
                            })
                            ->latest()
                            ->paginate(10);
        });
        $data_pengajar = Cache::remember('penguji_peserta_pengajar.'.$unit, now()->addDays(1), function () use ($unit) {
            return \App\Models\Pengajar::whereHas('unit', function($query) use ($unit) {
                                $query->where('slug', $unit);
                            })
                            ->first();
        });

        return view('dashboard.penguji.peserta.index', compact( 'unit', 'data_periode', 'data_pengajar'));
    }

    public function data($unit, $periode) {
        $data_periode = Cache::remember('penguji_peserta_periode.'.$unit.'.'.$periode, now()->addHours(1), function () use ($periode) {
            return \App\Models\Periode::find($periode);
        });
        $data_pengajar = Cache::remember('penguji_peserta_pengajar.'.$unit, now()->addHours(1), function () use ($unit) {
            return \App\Models\Pengajar::whereHas('unit', function($query) use ($unit) {
                                $query->where('slug', $unit);
                            })
                            ->first();
        });

        $data_peserta_baru = \App\Models\Kelas::where('periode_id', $periode)
                        ->cari(request()->query('cari'))
                        ->jenisPeserta(request()->query('jenis_peserta'))
                        ->statusPendaftaran(request()->query('status'))
                        ->cariLevel(request()->query('level'))
                        ->latest()
                        ->paginate(10);

        $data_level = Cache::remember('penguji_peserta_level.'.$unit.'.'.$periode, now()->addHours(1), function () use ($data_periode) {
            return \App\Models\Modules\Level::where('unit_id', $data_periode->unit_id)->get();
        });

        return view('dashboard.penguji.peserta.data', compact('unit', 'periode', 'data_pengajar', 'data_peserta_baru', 'data_periode', 'data_level'));
    }

    public function show($unit, $periode, $peserta)
    {
        $data_periode = Cache::remember('penguji_peserta_periode.'.$unit.'.'.$periode, now()->addHours(1), function () use ($periode) {
            return \App\Models\Periode::find($periode);
        });
        $data_peserta = Cache::remember('penguji_peserta.'.$unit.'.'.$periode.'.'.$peserta, now()->addHours(1), function () use ($periode, $peserta) {
            return \App\Models\Kelas::find($peserta);
        });
        $datalevel = Cache::remember('penguji_peserta_level.'.$unit.'.'.$periode, now()->addHours(1), function () use ($data_periode) {
            return \App\Models\Modules\Level::where('unit_id', $data_periode->unit_id)->get();
        });
        return view('dashboard.penguji.peserta-baru.show', compact('data_peserta', 'data_periode', 'unit', 'datalevel'));
    }

    public function create()
    {
        return view('dashboard.penguji.peserta.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pesertas',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        \App\Models\Peserta::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('dashboard.penguji.peserta.index')->with('success', 'Peserta berhasil ditambahkan');
    }

    public function edit(\App\Models\Peserta $peserta)
    {
        return view('dashboard.penguji.peserta.edit', compact('peserta'));
    }

    public function update(Request $request, \App\Models\Peserta $peserta)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pesertas,email,' . $peserta->id
        ]);

        $peserta->update([
            'nama' => $request->nama,
            'email' => $request->email
        ]);

        return redirect()->route('dashboard.penguji.peserta.index')->with('success', 'Peserta berhasil diupdate');
    }

    public function destroy(\App\Models\Peserta $peserta)
    {
        $peserta->delete();

        return redirect()->route('dashboard.penguji.peserta.index')->with('success', 'Peserta berhasil dihapus');
    }
}
