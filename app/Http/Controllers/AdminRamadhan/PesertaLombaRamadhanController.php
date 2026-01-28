<?php

namespace App\Http\Controllers\AdminRamadhan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use Maatwebsite\Excel\Facades\Excel;


class PesertaLombaRamadhanController extends Controller
{
    public function index(Request $request)
    {
        $data_peserta_lomba = \App\Models\LombaPeserta::with(['user', 'pendaftaran', 'pendaftaran.cabang'])
                            ->when($request->cari, function($query) use ($request) {
                                $query->where('nama', 'like', '%'.$request->cari.'%')
                                ->orWhere('alamat', 'like', '%'.$request->cari.'%');
                            })
                            ->when($request->jenis_peserta, function($query) use ($request) {
                                $query->where('jenis_kelamin', 'like', $request->jenis_peserta);
                            })
                            ->when($request->tanggal_lahir, function($query) use ($request) {
                                if (strpos($request->tanggal, ' to ') !== false) {
                                    list($date1, $date2) = explode(' to ', $request->tanggal);
                                    $query->whereBetween('created_at', [$date1.' 00:00:00', $date2.' 23:59:59']);
                                } else {
                                    $query->whereDate('created_at', '=', $request->tanggal);
                                }
                            })
                            ->latest()->paginate(15);
        $total_pendaftar    = \App\Models\LombaPeserta::count();
        $total_peserta      = \App\Models\LombaPeserta::whereHas('transaksi', function ($q2) { $q2->whereIn('status', [2, 3]); })->count();

        $data_cabang = \App\Models\LombaCabang::where('event_id', 1)->get();
        $data_per_cabang = [];
        foreach ($data_cabang as $cabang) {
            $data_per_cabang[$cabang->id] = \App\Models\LombaPeserta::
                whereHas('transaksi', function ($q2) {
                    $q2->whereIn('status', [2, 3]);
                })
                ->whereHas('pendaftaran', function ($q) use ($cabang) {
                    $q->where('cabang_id', $cabang->id);
                })->count();
        }

        return view('dashboard-ramadhan.admin.peserta-lomba.index', compact('data_peserta_lomba', 'data_per_cabang', 'data_cabang', 'total_pendaftar', 'total_peserta'));
    }

    public function export()
    {
        return Excel::download(new \App\Exports\AdminRamadhanLombaPeserta, 'Data_Peserta_Lomba_144H.xlsx');
    }
}
