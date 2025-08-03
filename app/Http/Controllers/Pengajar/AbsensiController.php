<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index($unit) {
        $data_periode = Cache::remember('pengajar_absensi_periode.'.$unit.Auth::id(), now()->addHours(1), function () use ($unit) {
            return \App\Models\Periode::whereHas('unit', function($query) use ($unit) {
                                $query->where('slug', $unit);
                            })
                            ->whereHas('jadwal', function($query) {
                                $query->whereHas('pengajar', function($query) {
                                    $query->where('user_id', Auth::id());
                                });
                            })
                            ->latest()
                            ->paginate(10);
        });

        $data_pengajar = Cache::remember('pengajar_absensi_pengajar.'.$unit.Auth::id(), now()->addHours(1), function () use ($unit) {
            return \App\Models\Pengajar::whereHas('unit', function($query) use ($unit) {
                                $query->where('slug', $unit);
                            })
                            ->where('user_id', Auth::id())
                            ->first();
        });
        // $data_pengajar = \App\Models\Jadwal::where('periode_id', $periode)->paginate(10);


        return view('dashboard.pengajar.absensi.index', compact('unit', 'data_periode', 'data_pengajar'));
    }

    public function data($unit, $periode) {
        $data_periode = Cache::remember('pengajar_absensi_periode.'.$unit.Auth::id().'.'.$periode, now()->addHours(1), function () use ($periode) {
            return \App\Models\Periode::find($periode);
        });

        $data_pengajar = Cache::remember('pengajar_absensi_pengajar.'.$unit.Auth::id(), now()->addHours(1), function () use ($unit) {
            return \App\Models\Pengajar::whereHas('unit', function($query) use ($unit) {
                                $query->where('slug', $unit);
                            })
                            ->where('user_id', Auth::id())
                            ->first();
        });

        $data_jadwal = Cache::remember('pengajar_absensi_jadwal.'.$unit.Auth::id().'.'.$periode, now()->addHours(1), function () use ($periode, $data_pengajar) {
            return \App\Models\Jadwal::where('periode_id', $periode)
                        ->whereHas('pengajar', function($query) use ($data_pengajar) {
                            $query->where('id', $data_pengajar->id);
                        })
                        ->with('level')
                        ->paginate(10);
        });

        return view('dashboard.pengajar.absensi.data', compact('unit', 'periode', 'data_pengajar', 'data_jadwal', 'data_periode'));
    }

    public function data_kelas($unit, $periode, $kelas, Request $request) {
        $data_kelas = Cache::remember('pengajar_jadwal_kelas.'.$kelas, now()->addHours(1), function () use ($kelas) {
            return \App\Models\Jadwal::with('pengajar','level', 'periode.unit')->find($kelas);
        });
        $data_peserta = Cache::remember('pengajar_jadwal_peserta.'.$kelas, now()->addHours(1), function () use ($data_kelas) {
            return \App\Models\Kelas::with('peserta')->where('jadwal_id', $data_kelas->id)->get();
        });
        $data_level = Cache::remember('pengajar_jadwal_level.'.$kelas, now()->addHours(1), function () use ($data_kelas) {
            return \App\Models\Modules\Level::where('unit_id', $data_kelas->periode->unit->id)->get();
        });

        $data_absen = null;
        $data_absensi_peserta = [];
        $data_absensi_default = [];
        $data_pertemuan_tanggal = [];
        $data_pertemuan_tilawah = [];

        if ($request->has('ke')) {
            $data_absen = \App\Models\Absen::where('jadwal_id', $kelas)
                ->where('pertemuan_ke', $request->ke)
                ->first();
            if($data_absen) {
                $data_absensi_default = $data_absen->absensi_peserta->mapWithKeys(function ($item) {
                    return ['peserta'.$item->kelas_id => $item->absen ?? 1];
                })
                ->toArray();
                $data_absensi_default['tanggal'] = \Carbon\Carbon::parse($data_absen->tanggal_pertemuan)->format('Y-m-d');
                $data_absensi_default['tilawah'] = $data_absen->tilawah;
            } else {
                $data_absensi_default = $data_peserta->mapWithKeys(function ($item) {
                    return ['peserta'.$item->id => 1];
                })
                ->toArray();
                $data_absensi_default['tanggal'] = now()->format('Y-m-d');
                $data_absensi_default['tilawah'] = 'Surah - Ayat';
            }
            $data_absensi_default['ke'] = $request->ke;

            if ($request->ke == 'ujian') {
                $data_absensi_default = $data_peserta->mapWithKeys(function ($item) {
                    $ujian = $item->data_nilai;
                    return ['ujian'.$item->id => $ujian['ujian']];
                });
            }
        } else {
            $data_absen = Cache::remember('pengajar_absensi.'.$kelas.Auth::id(), now()->addMinutes(10), function () use ($kelas) {
                return \App\Models\Absen::where('jadwal_id', $kelas)
                    ->get();
            });
            $data_absen_id = $data_absen->pluck('id');
            $data_absensi_peserta = Cache::remember('pengajar_absensi-peserta.'.$kelas.Auth::id(), now()->addMinutes(10), function () use ($data_absen_id) {
                return \App\Models\AbsensiPeserta::whereIn('absen_id', $data_absen_id)
                    ->get()
                    ->mapWithKeys(function ($item) {
                        return [$item->kelas_id.'-'.$item->data_absen->pertemuan_ke => $item->absen];
                    })
                    ->toArray();
            });
            $data_pertemuan_tanggal = Cache::remember('pengajar_pertemuan-tanggal.'.$kelas.Auth::id(), now()->addMinutes(10), function () use ($data_absen) {
                return $data_absen->mapWithKeys(function ($item) {
                    return [$item->pertemuan_ke => $item->tanggal_pertemuan];
                })
                ->toArray();
            });
            $data_pertemuan_tilawah = Cache::remember('pengajar_pertemuan-tilawah.'.$kelas.Auth::id(), now()->addMinutes(10), function () use ($data_absen) {
                return $data_absen->mapWithKeys(function ($item) {
                    return [$item->pertemuan_ke => $item->tilawah];
                })
                ->toArray();
            });
        }

        // dd($data_pertemuan_tanggal);

        return view('dashboard.pengajar.absensi.kelas', compact('unit', 'periode', 'kelas','data_kelas', 'data_peserta', 'data_absen', 'data_absensi_default', 'data_absensi_peserta', 'data_pertemuan_tanggal', 'data_pertemuan_tilawah', 'data_level'));
    }

    public function data_kelas_store($unit, $periode, $kelas, Request $request) {

        $data_peserta = \App\Models\Kelas::where('jadwal_id', $kelas)->get();

        if($request->ke == 'ujian') {
            foreach ($data_peserta as $peserta) {
                $peserta->update([
                    'data_nilai' => [
                        'ujian' => $request->input('ujian'.$peserta->id),
                    ],
                    'status_ujian' => 'selesai ujian',
                ]);
            }
            Toast::success('Hasil Ujian Berhasil Disimpan');
        } else {
            $data_absen = \App\Models\Absen::where('jadwal_id', $kelas)
                    ->where('pertemuan_ke', $request->ke)
                    ->first();

            if($data_absen) {
                $data_absen->update([
                    'tanggal_pertemuan' => \Carbon\Carbon::parse($request->tanggal)->addHours(8)->setTimezone('Asia/Makassar')->toDateTimeString(),
                    'tilawah' => $request->tilawah,
                ]);
            } else {
                $data_absen = \App\Models\Absen::create([
                    'jadwal_id' => $kelas,
                    'pertemuan_ke' => $request->ke,
                    'tanggal_pertemuan' => \Carbon\Carbon::parse($request->tanggal)->addHours(8)->setTimezone('Asia/Makassar')->toDateTimeString(),
                    'tilawah' => $request->tilawah,
                ]);
            }

            foreach ($data_peserta as $peserta) {
                $data_absen_peserta = \App\Models\AbsensiPeserta::where('absen_id', $data_absen->id)
                    ->where('kelas_id', $peserta->id)
                    ->first();
                if($data_absen_peserta) {
                    $data_absen_peserta->update([
                        'absen' => $request->input('peserta'.$peserta->id)
                    ]);
                } else {
                    \App\Models\AbsensiPeserta::create([
                        'absen_id' => $data_absen->id,
                        'kelas_id' => $peserta->id,
                        'peserta_id' => $peserta->peserta_id,
                        'absen' => $request->input('peserta'.$peserta->id)
                    ]);
                }
            }
            Toast::success('Absensi Berhasil Disimpan');
        }

        Cache::forget('pengajar_absensi.'.$kelas.Auth::id());
        Cache::forget('pengajar_absensi-peserta.'.$kelas.Auth::id());
        Cache::forget('pengajar_pertemuan-tanggal.'.$kelas.Auth::id());
        Cache::forget('pengajar_pertemuan-tilawah.'.$kelas.Auth::id());

        return redirect()->route('pengajar.absensi.data.kelas', ['unit' => $unit, 'periode' => $periode, 'kelas' => $kelas]);
    }
}
