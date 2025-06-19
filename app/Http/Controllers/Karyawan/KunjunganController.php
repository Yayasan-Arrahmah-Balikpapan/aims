<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\Splade\Facades\Toast;


class KunjunganController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $kunjungan = \App\Models\KaryawanKunjungan::where('user_id', $user->id)
                    ->latest('created_at')
                    ->paginate(10);
        return view('dashboard.karyawan.kunjungan.index', compact('kunjungan'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'tujuan' => ['required', 'string'],
        ]);

        try {
            \App\Models\KaryawanKunjungan::create([
                'user_id' => $user->id,
                'tanggal' => $request->tanggal,
                'tujuan' => $request->tujuan,
                'lokasi' => $request->lokasi,
                'waktu' => $request->waktu,
                'durasi' => $request->durasi,
                'keterangan' => $request->keterangan,
            ]);

            Toast::success('Data kunjungan berhasil disimpan');
        } catch (\Exception $e) {
            Toast::error('Data kunjungan gagal disimpan');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            $kunjungan = \App\Models\KaryawanKunjungan::findOrFail($id);
            if (now()->diffInDays($kunjungan->created_at) > 1) {
                Toast::error('Data kunjungan dibuat lebih dari 24 jam, tidak dapat dihapus. Hubungi HRD');
            } else {
                $kunjungan->delete();
                Toast::success('Data kunjungan berhasil dihapus');
            }
        } catch (\Exception $e) {
            Toast::error('Data kunjungan gagal dihapus');
        }

        return redirect()->back();
    }
}
