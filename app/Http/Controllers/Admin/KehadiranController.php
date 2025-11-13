<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KehadiranController extends Controller
{

    public function index($unit, $periode, Request $request)
    {
        $dataperiode = \App\Models\Periode::findOrFail( $periode);
        $data_level = \App\Models\Modules\Level::where('unit_id', $dataperiode->unit->id )->get();

        $data_peserta = \App\Models\Kelas::where('periode_id', $periode)
                            ->cari(request()->query('cari'))
                            ->jenisPeserta(request()->query('jenis_peserta'))
                            ->statusDaftarPeserta(request()->query('peserta'))
                            ->statusPendaftaran(request()->query('status'))
                            ->cariLevel(request()->query('level'))
                            ->paginate(10);
        $data_peserta_id = $data_peserta->pluck('id');
        $data_absensi_peserta = \App\Models\AbsensiPeserta::whereIn('kelas_id', $data_peserta_id)
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->kelas_id.'-'.$item->data_absen->pertemuan_ke => $item->absen];
            })
            ->toArray();

        $data_absensi_tanggal = \App\Models\AbsensiPeserta::whereIn('kelas_id', $data_peserta_id)
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->kelas_id.'-'.$item->data_absen->pertemuan_ke => $item->absen];
            })
            ->toArray();
            
        return view('dashboard.admin.periode.kehadiran.index', compact('unit','periode', 'dataperiode', 'data_peserta', 'data_absensi_peserta','data_absensi_tanggal', 'data_level'));
    }

    public function create($unit, $periode)
    {
        return view('dashboard.admin.periode.kehadiran.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // Add other fields validation here
        ]);

        $kehadiran = \App\Models\Absen::create($validated);

        return redirect()->route('admin.kehadiran.index')
                        ->with('success', 'Kehadiran created successfully.');
    }

    public function show($id)
    {
        $kehadiran = \App\Models\Absen::findOrFail($id);
        return view('admin.kehadiran.show', compact('kehadiran'));
    }

    public function edit($id)
    {
        $kehadiran = \App\Models\Absen::findOrFail($id);
        return view('admin.kehadiran.edit', compact('kehadiran'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // Add other fields validation here
        ]);

        $kehadiran = \App\Models\Absen::findOrFail($id);
        $kehadiran->update($validated);

        return redirect()->route('admin.kehadiran.index')
                        ->with('success', 'Kehadiran updated successfully.');
    }

    public function destroy($id)
    {
        $kehadiran = \App\Models\Absen::findOrFail($id);
        $kehadiran->delete();

        return redirect()->route('admin.kehadiran.index')
                        ->with('success', 'Kehadiran deleted successfully.');
    }
    public function export($unit, $periode)
    {
        $dataperiode = \App\Models\Periode::findOrFail( $periode);
        $data_peserta = \App\Models\Kelas::where('periode_id', $periode)
                            ->get();
        $data_peserta_id = $data_peserta->pluck('id');
        $data_absensi_peserta = \App\Models\AbsensiPeserta::whereIn('kelas_id', $data_peserta_id)
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->kelas_id.'-'.$item->data_absen->pertemuan_ke => $item->absen];
            })
            ->toArray();

        $data_absensi_tanggal = \App\Models\AbsensiPeserta::whereIn('kelas_id', $data_peserta_id)
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->kelas_id.'-'.$item->data_absen->pertemuan_ke => $item->absen];
            })
            ->toArray();
        return Excel::download(new \App\Exports\AdminKehadiran($dataperiode, $data_peserta, $data_absensi_peserta, $data_absensi_tanggal), 'Data_Kehadiran_Admin_' . $unit . '_' . $dataperiode->nama . '.xlsx');
    }

}
