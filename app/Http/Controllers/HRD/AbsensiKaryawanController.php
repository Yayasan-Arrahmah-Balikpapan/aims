<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\Splade\Facades\Toast;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiKaryawanController extends Controller
{
    public function absensi()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $data_karyawan = \App\Models\User::role('karyawan')->get();
        $tanggal = request('tanggal') ?? $today->toDateString();
        $bulan = request('bulan') ?? $today->month;
        $tahun = request('tahun') ?? $today->year;

        $karyawan_hadir_hari_ini = \App\Models\KaryawanAbsensi::whereDate('created_at', $tanggal)->get();
        $karyawan_hadir_hari_ini_id = \App\Models\KaryawanAbsensi::select('user_id')
            ->whereDate('created_at', $tanggal)
            ->whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->pluck('user_id');
        $data_karyawan_hadir_hari_ini = $data_karyawan->whereIn('id', $karyawan_hadir_hari_ini_id);
        $data_karyawan_tidak_hadir_hari_ini = $data_karyawan->whereNotIn('id', $karyawan_hadir_hari_ini_id);

        $data_absensi = \App\Models\KaryawanAbsensi::whereDate('created_at', '>=', $today)->get();

        return view('dashboard.hrd.karyawan.absensi', compact('data_absensi', 'data_karyawan_hadir_hari_ini', 'data_karyawan_tidak_hadir_hari_ini', 'karyawan_hadir_hari_ini'));
    }

    public function absensi_detail($absensi)
    {
        $absensi = \App\Models\KaryawanAbsensi::find($absensi);
        return view('dashboard.hrd.karyawan.absensi-detail', compact('absensi'));
    }

    public function absensi_export(Request $request)
    {
        $bulan = $request->input('bulan', now()->month);
        $tahun = $request->input('tahun', now()->year);

        $users = \App\Models\User::whereHas('roles', function ($query) {
            $query->where('name', 'karyawan');
        })->with(['karyawan_absensi' => function ($query) use ($bulan, $tahun) {
            $query->whereMonth('waktu_datang', $bulan)
                ->whereYear('waktu_datang', $tahun);
        }])->get();
        return Excel::download(new \App\Exports\KaryawanAbsensi($users,$bulan, $tahun), "Absensi_Karyawan_{$bulan}_{$tahun}.xlsx");
    }

    public function hari_libur_create()
    {
        return view('dashboard.hrd.karyawan.hari-libur-create');
    }

    public function hari_libur_store()
    {
        $data = request()->validate([
            'tanggal' => 'required|date',
        ]);

        \App\Models\Kalender::create([
            'tanggal' => $data['tanggal']
        ]);

        Toast::success('Data berhasil disimpan');

        return redirect()->back();
    }

    public function hari_libur_delete()
    {

    }

}

