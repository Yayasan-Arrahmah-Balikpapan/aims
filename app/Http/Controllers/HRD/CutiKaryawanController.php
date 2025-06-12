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

class CutiKaryawanController extends Controller
{

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

