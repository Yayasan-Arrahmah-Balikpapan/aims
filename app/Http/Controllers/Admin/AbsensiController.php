<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class AbsensiController extends Controller
{

    public function index($unit, $periode, Request $request)
    {
        // LOGIC DATA TABEL ABSEN, TRANSAKSI, KEHADIRAN, PEMBAYARAN SESUAI FORMAT KEUANGAN
        $dataperiode = \App\Models\Periode::with('jadwal')->findOrFail( $periode);
        $data_jadwal = \App\Models\Jadwal::with('pengajar', 'level', 'periode.unit', 'kelas.peserta')
                        ->where('periode_id', $periode)
                        ->when(request()->query('cari'), function($query, $cari) {
                            $query->where('nama_jadwal', 'like', strtoupper("%$cari%"));
                        })
                        ->when(request()->query('jenis_peserta'), function($query, $jenis_peserta) {
                            $query->whereHas('kelas.peserta', function($query) use ($jenis_peserta) {
                                $query->where('jenis_peserta', $jenis_peserta);
                            });
                        })
                        ->when(request()->query('level'), function($query, $level) {
                            $query->where('level_id', $level);
                        })
                        ->when(request()->query('hari'), function($query, $hari) {
                            $query->where('hari_belajar', $hari);
                        })
                        ->when(request()->query('pengajar'), function($query, $pengajar) {
                            $query->where('pengajar_id', $pengajar);
                        })
                        ->paginate(10)
                        ->withQueryString(); // Mempertahankan parameter URL;

        $data_level = \App\Models\Modules\Level::where('unit_id', $dataperiode->unit_id)->get();
        $data_pengajar = \App\Models\Pengajar::whereHas('unit', function($query) use ($unit) {
                                $query->where('slug', $unit);
                            })
                            ->get();
        $data_jadwal_id = $data_jadwal->pluck('id');
        $data_absen = \App\Models\Absen::whereIn('jadwal_id', $data_jadwal_id)
                    ->get()
                    ->mapWithKeys(function ($item) {
                        return [$item->jadwal_id.'-'.$item->pertemuan_ke => $item->tanggal_pertemuan];
                    })
                    ->toArray();

        $data_absen_tanggal = \App\Models\Absen::whereIn('jadwal_id', $data_jadwal_id)
                    ->get()
                    ->mapWithKeys(function ($item) {
                        return [$item->jadwal_id.'-'.Carbon::parse($item->tanggal_pertemuan)->format('d-m-Y') => $item->tanggal_pertemuan];
                    })
                    ->toArray();

        return view('dashboard.admin.periode.absensi.index', compact('unit','periode', 'dataperiode', 'data_jadwal', 'data_absen', 'data_level', 'data_pengajar', 'data_absen_tanggal'));
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
    public function export($unit, $periode, Request $request)
    {
        $dataperiode = \App\Models\Periode::with('jadwal')->findOrFail( $periode);
        $data_jadwal = \App\Models\Jadwal::with('pengajar', 'level', 'periode.unit', 'kelas.peserta')
                        ->where('periode_id', $periode)
                        ->get();
                        
        $data_jadwal_id = $data_jadwal->pluck('id');
        $data_absen = \App\Models\Absen::whereIn('jadwal_id', $data_jadwal_id)
                    ->get()
                    ->mapWithKeys(function ($item) {
                        return [$item->jadwal_id.'-'.$item->pertemuan_ke => $item->tanggal_pertemuan];
                    })
                    ->toArray();

        $data_absen_tanggal = \App\Models\Absen::whereIn('jadwal_id', $data_jadwal_id)
                    ->get()
                    ->mapWithKeys(function ($item) {
                        return [$item->jadwal_id.'-'.Carbon::parse($item->tanggal_pertemuan)->format('d-m-Y') => $item->tanggal_pertemuan];
                    })
                    ->toArray();
        return Excel::download(new \App\Exports\AdminAbsensi($dataperiode, $data_jadwal, $data_absen, $data_absen_tanggal), 'Data_Absensi_Admin_' . $unit . '_' . $dataperiode->nama . '.xlsx');
    }
}
