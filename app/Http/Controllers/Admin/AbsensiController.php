<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{

    public function index($unit, $periode, Request $request)
    {
        // LOGIC DATA TABEL ABSEN, TRANSAKSI, KEHADIRAN, PEMBAYARAN SESUAI FORMAT KEUANGAN
        $dataperiode = \App\Models\Periode::with('jadwal')->findOrFail( $periode);
        $data_jadwal = $dataperiode->jadwal()
                        ->when($request->has('search'), function($query) use ($request) {
                            $query->where('nama_jadwal', 'like', '%'.$request->search.'%');
                        })
                        ->orderBy('nama_jadwal')
                        ->paginate(10)
                        ->withQueryString(); // Mempertahankan parameter URL;
        $data_jadwal_id = $data_jadwal->pluck('id');
        $data_absen = \App\Models\Absen::whereIn('jadwal_id', $data_jadwal_id)
                    ->get()
                    ->mapWithKeys(function ($item) {
                        return [$item->jadwal_id.'-'.$item->pertemuan_ke => $item->tanggal_pertemuan];
                    })
                    ->toArray();

        return view('dashboard.admin.periode.absensi.index', compact('unit','periode', 'dataperiode', 'data_jadwal', 'data_absen'));
    }

    public function create($unit, $periode)
    {
        return view('admin.absensi.create');
    }

    public function store(Request $request, $unit, $periode)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
        ]);

        \App\Models\AbsensiPeserta::create([
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.absensi.index')->with('success', 'Data absensi berhasil ditambahkan');
    }

    public function show($id, $unit, $periode)
    {
        $absensi = \App\Models\AbsensiPeserta::findOrFail($id);

        return view('admin.absensi.show', compact('unit','periode', 'absensi'));
    }

    public function edit($id, $unit, $periode)
    {
        $absensi = \App\Models\AbsensiPeserta::findOrFail($id);

        return view('admin.absensi.edit', compact('unit','periode', 'absensi'));
    }

    public function update(Request $request, $id, $unit, $periode)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
        ]);

        $absensi = \App\Models\AbsensiPeserta::findOrFail($id);
        $absensi->update([
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.absensi.index')->with('success', 'Data absensi berhasil diupdate');
    }

    public function destroy($id, $unit, $periode)
    {
        $absensi = \App\Models\AbsensiPeserta::findOrFail($id);
        $absensi->delete();

        return redirect()->route('admin.absensi.index')->with('success', 'Data absensi berhasil dihapus');
    }
}
