<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class JadwalController extends Controller
{
    public function index($unit) {
        $data_periode = Cache::remember('pengajar_jadwal_periode.'.$unit, now()->addHours(1), function () use ($unit) {
            return \App\Models\Periode::whereHas('unit', function($query) use ($unit) {
                                $query->where('slug', $unit);
                            })
                            ->with('jadwal')
                            ->latest()
                            ->paginate(10);
        });

        return view('dashboard.pengajar.jadwal.index', compact('unit', 'data_periode'));
    }

    public function data($unit, $periode) {
        $data_periode = Cache::remember('pengajar_jadwal_periode.'.$unit.'.'.$periode, now()->addHours(1), function () use ($periode) {
            return \App\Models\Periode::find($periode);
        });
        $data_pengajar = Cache::remember('pengajar_jadwal_pengajar.'.$unit, now()->addHours(1), function () use ($unit) {
            return \App\Models\Pengajar::whereHas('unit', function($query) use ($unit) {
                                $query->where('slug', $unit);
                            })
                            ->get();
        });

        $data_jadwal = \App\Models\Jadwal::with('pengajar','level', 'periode.unit', 'kelas.peserta')
                    ->where('periode_id', $periode)
                    ->when(request()->query('cari'), function($query, $cari) {
                        $query->where('nama_jadwal', 'like', "%$cari%");
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
                    ->paginate(10);

        $data_level = Cache::remember('pengajar_jadwal_level.'.$unit.'.'.$periode, now()->addHours(1), function () use ($data_periode) {
            return \App\Models\Modules\Level::where('unit_id', $data_periode->unit_id)->get();
        });

        return view('dashboard.pengajar.jadwal.data', compact('unit', 'periode', 'data_pengajar', 'data_jadwal', 'data_periode', 'data_level'));
    }

    public function data_kelas($unit, $periode, $kelas) {
        $data_kelas = Cache::remember('pengajar_jadwal_kelas.'.$kelas, now()->addHours(1), function () use ($kelas) {
            return \App\Models\Jadwal::with('pengajar','level', 'periode.unit')->find($kelas);
        });
        $data_peserta = Cache::remember('pengajar_jadwal_peserta.'.$kelas, now()->addHours(1), function () use ($data_kelas) {
            return \App\Models\Kelas::with('peserta')->where('jadwal_id', $data_kelas->id)->get();
        });
        $data_level = Cache::remember('pengajar_jadwal_level.'.$kelas, now()->addHours(1), function () use ($data_kelas) {
            return \App\Models\Modules\Level::where('unit_id', $data_kelas->periode->unit->id )->get();
        });

        $data_absen = null;
        $data_absensi_peserta = [];
        $data_absensi_default = [];
        $data_pertemuan_tanggal = [];
        $data_pertemuan_tilawah = [];

        $data_absen = Cache::remember('pengajar_absensi.'.$kelas, now()->addMinutes(10), function () use ($kelas) {
            return \App\Models\Absen::where('jadwal_id', $kelas)
                ->get();
        });
        $data_absen_id = $data_absen->pluck('id');
        $data_absensi_peserta = Cache::remember('pengajar_absensi-peserta.'.$kelas, now()->addMinutes(10), function () use ($data_absen_id) {
            return \App\Models\AbsensiPeserta::whereIn('absen_id', $data_absen_id)
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->kelas_id.'-'.$item->data_absen->pertemuan_ke => $item->absen];
                })
                ->toArray();
        });
        $data_pertemuan_tanggal = Cache::remember('pengajar_pertemuan-tanggal.'.$kelas, now()->addMinutes(10), function () use ($data_absen) {
            return $data_absen->mapWithKeys(function ($item) {
                return [$item->pertemuan_ke => $item->tanggal_pertemuan];
            })
            ->toArray();
        });
        $data_pertemuan_tilawah = Cache::remember('pengajar_pertemuan-tilawah.'.$kelas, now()->addMinutes(10), function () use ($data_absen) {
            return $data_absen->mapWithKeys(function ($item) {
                return [$item->pertemuan_ke => $item->tilawah];
            })
            ->toArray();
        });

        return view('dashboard.pengajar.jadwal.kelas', compact('unit', 'periode', 'kelas', 'data_kelas', 'data_peserta', 'data_absen', 'data_absensi_default', 'data_absensi_peserta', 'data_pertemuan_tanggal', 'data_pertemuan_tilawah', 'data_level'));
    }
}
