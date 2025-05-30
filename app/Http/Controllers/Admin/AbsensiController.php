<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{

    public function index($unit, $periode)
    {
        $absensi = \App\Models\AbsensiPeserta::all();
        $dataperiode = \App\Models\Periode::find( $periode);

        return view('dashboard.admin.periode.absensi.index', compact('unit','periode', 'absensi', 'dataperiode'));
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
