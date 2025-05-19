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

class KaryawanController extends Controller
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

    public function data()
    {
        $karyawans =\App\Tables\HRD\DataKaryawan::class;

        return view('dashboard.hrd.karyawan.data', compact('karyawans'));
    }


    public function data_create()
    {
        $divisis = \App\Models\Modules\Divisi::selectRaw("id, nama")->get();
        $karyawans = \App\Models\User::selectRaw("id, concat(name, ' (', phone_number, ')') as name")->get();

        return view('dashboard.hrd.karyawan.data-create', compact('karyawans', 'divisis'));
    }

    public function data_store(Request $request)
    {

        $karyawan = \App\Models\Karyawan::where('user_id', $request->karyawans)->first();
        if ($karyawan) {
            $user = \App\Models\User::find($request->karyawans);
            Toast::warning("User dengan nama $user->name sudah terdaftar sebagai karyawan")->autoDismiss(5);
            return redirect()->back();
        }

        $user = \App\Models\User::find($request->karyawans);
        $user->assignRole('karyawan');

        \App\Models\Karyawan::create([
            'user_id' => $request->karyawans,
            'divisi_id' => $request->divisi,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);


        return redirect()->route('hrd.karyawan.data.index')->with('success', 'Data berhasil di tambahkan');
    }

    public function cuti()
    {
        $data_cuti = \App\Models\KaryawanCuti::orderBy('created_at', 'desc')->paginate(10);
        $data_cuti_menunggu_persetujuan = \App\Models\KaryawanCuti::where('status', 'MENUNGGU PERSETUJUAN')->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.hrd.karyawan.cuti', compact('data_cuti', 'data_cuti_menunggu_persetujuan'));
    }

    public function cuti_setujui($id)
    {
        $cuti = \App\Models\KaryawanCuti::findOrFail($id);
        $cuti->update(['status' => 'DISETUJUI']);

        if ($cuti) {
            Toast::success($cuti->user->name . 'Cuti berhasil Disetujui');
        } else {
            Toast::warning($cuti->user->name . 'Proses Gagal. Kontak Asif');
        }

        return redirect()->route('hrd.karyawan.cuti.index');
    }

    public function cuti_tolak($id)
    {
        $cuti = \App\Models\KaryawanCuti::findOrFail($id);
        $cuti->update(['status' => 'DITOLAK']);

        if ($cuti) {
            Toast::success($cuti->user->name . 'Cuti berhasil Ditolak');
        } else {
            Toast::warning($cuti->user->name . 'Proses Gagal. Kontak Asif');
        }

        return redirect()->route('hrd.karyawan.cuti.index');
    }

}

