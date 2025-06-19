<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \ProtoneMedia\Splade\Facades\Toast;

class KunjunganKaryawanController extends Controller
{

    public function index()
    {
        $kunjungans = new \App\Tables\HRD\DataKaryawanKunjungan();
        return view('dashboard.hrd.kunjungan.index', compact('kunjungans'));
    }

    public function destroy($id)
    {
        $kunjungan = \App\Models\KaryawanKunjungan::findOrFail($id);
        if (now()->diffInDays($kunjungan->created_at) > 1) {
            $kunjungan->delete();
            Toast::success('Data kunjungan karyawan berhasil dihapus');
        } else {
            Toast::warning('Data kunjungan dibuat bElum lebih dari 24 jam, tdapat dihapus oleh karyawan')->autoDismiss(5);
        }
        return redirect()->back();
    }
}
