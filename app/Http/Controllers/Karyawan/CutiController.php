<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\Splade\Facades\Toast;

class CutiController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $data_cuti = \App\Models\KaryawanCuti::where('user_id', $user->id)->paginate(10);
        return view('dashboard.karyawan.cuti.index', compact('data_cuti'));
    }

    public function create()
    {
        return view('dashboard.karyawan.cuti.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'alasan' => 'required',
        ]);

        $cuti = \App\Models\KaryawanCuti::create([
            'user_id' => Auth::user()->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
        ]);

        if ($cuti) { Toast::success('Cuti berhasil diajukan'); }

        return redirect()->route('karyawan.cuti.index');
    }

    public function destroy($id)
    {
        \App\Models\KaryawanCuti::findOrFail($id)->delete();

        return redirect()->route('karyawan.cuti.index')->with('success', 'Data Berhasil di Hapus');
    }
}
