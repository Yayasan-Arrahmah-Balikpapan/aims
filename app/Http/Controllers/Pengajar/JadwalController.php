<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index($unit) {
        $data_periode = \App\Models\Periode::whereHas('unit', function($query) use ($unit) {
                            $query->where('slug', $unit);
                        })
                        ->latest()
                        ->paginate(10);
        $data_pengajar = \App\Models\Pengajar::whereHas('unit', function($query) use ($unit) {
                            $query->where('slug', $unit);
                        })
                        ->first();

        return view('dashboard.pengajar.jadwal.index', compact('unit', 'data_periode', 'data_pengajar'));
    }

    public function data($unit, $periode) {
        $data_periode = \App\Models\Periode::find($periode);
        $data_pengajar = \App\Models\Pengajar::whereHas('unit', function($query) use ($unit) {
                            $query->where('slug', $unit);
                        })
                        ->first();

        $data_jadwal = \App\Models\Jadwal::where('periode_id', $periode)->paginate(10);

        return view('dashboard.pengajar.jadwal.data', compact('unit', 'periode', 'data_pengajar', 'data_jadwal', 'data_periode'));
    }

    public function data_kelas($unit, $periode, $kelas) {
        $data_kelas = \App\Models\Jadwal::find($kelas);
        $data_peserta = \App\Models\Kelas::where('jadwal_id', $data_kelas->id)->get();
        $data_level = \App\Models\Modules\Level::where('unit_id', $data_kelas->periode->unit->id )->get();

        $data_absen = null;
        $data_absensi_peserta = [];
        $data_absensi_default = [];
        $data_pertemuan_tanggal = [];
        $data_pertemuan_tilawah = [];

        $data_absen = \App\Models\Absen::where('jadwal_id', $kelas)
            ->get();
        $data_absen_id = $data_absen->pluck('id');
        $data_absensi_peserta = \App\Models\AbsensiPeserta::whereIn('absen_id', $data_absen_id)
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->kelas_id.'-'.$item->data_absen->pertemuan_ke => $item->absen];
            })
            ->toArray();
        $data_pertemuan_tanggal = $data_absen->mapWithKeys(function ($item) {
            return [$item->pertemuan_ke => $item->tanggal_pertemuan];
        })
        ->toArray();
        $data_pertemuan_tilawah = $data_absen->mapWithKeys(function ($item) {
            return [$item->pertemuan_ke => $item->tilawah];
        })
        ->toArray();

        $data_jadwal = \App\Models\Jadwal::where('periode_id', $periode)->paginate(10);

        return view('dashboard.pengajar.jadwal.kelas', compact('unit', 'periode', 'kelas', 'data_jadwal', 'data_kelas', 'data_peserta', 'data_absen', 'data_absensi_default', 'data_absensi_peserta', 'data_pertemuan_tanggal', 'data_pertemuan_tilawah', 'data_level'));
    }
}
