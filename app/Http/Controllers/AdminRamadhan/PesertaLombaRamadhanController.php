<?php

namespace App\Http\Controllers\AdminRamadhan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\Facades\Toast;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;


class PesertaLombaRamadhanController extends Controller
{
    public function index(Request $request)
    {
        $sortBy  = $request->get('sort_by', 'created_at'); // default kolom
        $sortDir = $request->get('sort_dir', 'desc');      // default arah

        // whitelist kolom yang boleh di-sort
        $allowedSorts = ['created_at', 'nama', 'tanggal_lahir'];

        if (! in_array($sortBy, $allowedSorts)) {
            $sortBy = 'created_at';
        }

        if (! in_array(strtolower($sortDir), ['asc', 'desc'])) {
            $sortDir = 'desc';
        }
        $data_peserta_lomba = \App\Models\LombaPeserta::with(['user', 'pendaftaran', 'pendaftaran.cabang'])
                            ->when($request->cari, function($query) use ($request) {
                                $query->where('nama', 'like', '%'.$request->cari.'%')
                                ->orWhere('alamat', 'like', '%'.$request->cari.'%');
                            })
                            ->when($request->jenis_peserta, function($query) use ($request) {
                                $query->where('jenis_kelamin', 'like', $request->jenis_peserta);
                            })
                            ->when($request->cabang, function($query) use ($request) {
                                $query->whereHas('pendaftaran', function ($q) use ($request) {
                                    $q->whereIn('cabang_id', $request->cabang);
                                });
                            })
                            ->when($request->tanggal_lahir, function($query) use ($request) {
                                if (strpos($request->tanggal, ' to ') !== false) {
                                    list($date1, $date2) = explode(' to ', $request->tanggal);
                                    $query->whereBetween('created_at', [$date1.' 00:00:00', $date2.' 23:59:59']);
                                } else {
                                    $query->whereDate('created_at', '=', $request->tanggal);
                                }
                            })

                            ->orderBy($sortBy, $sortDir)
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

        $data_per_cabang_pendaftar = [];
        foreach ($data_cabang as $cabang_pendaftar) {
            $data_per_cabang_pendaftar[$cabang_pendaftar->id] = \App\Models\LombaPeserta::
                whereHas('pendaftaran', function ($q) use ($cabang_pendaftar) {
                    $q->where('cabang_id', $cabang_pendaftar->id);
                })->count();
        }

        return view('dashboard-ramadhan.admin.peserta-lomba.index', compact('data_peserta_lomba', 'data_per_cabang', 'data_cabang', 'total_pendaftar', 'total_peserta', 'data_per_cabang_pendaftar'));
    }

    public function export()
    {
        return Excel::download(new \App\Exports\AdminRamadhanLombaPeserta, 'Data_Peserta_Lomba_144H.xlsx');
    }

    public function destroy($peserta)
    {
        try {
            DB::transaction(function () use ($peserta) {
                $peserta_lomba = \App\Models\LombaPeserta::with([
                    'pendaftaran',
                    'transaksi'
                ])->findOrFail($peserta);

                // 1. hapus transaksi dulu
                $peserta_lomba->transaksi()->delete();

                // 2. hapus pendaftaran
                $peserta_lomba->pendaftaran()->delete();

                // 3. hapus peserta
                $peserta_lomba->delete();

            });
            Toast::message('Data berhasil di hapus')->autoDismiss(10);
        } catch (\Throwable $th) {
            DB::rollBack();
            Toast::warning('Data gagal di hapus')->autoDismiss(10);
            throw $th;
        }
        return redirect()->back();

    }


    public function data_cabang_lomba($cabang)
    {
        $data_cabang = \App\Models\LombaCabang::find($cabang);
        $data_peserta_lomba = \App\Models\LombaPeserta::
            whereHas('transaksi', function ($q2) {
                $q2->whereIn('status', [2, 3]);
            })
            ->whereHas('pendaftaran', function ($q) use ($data_cabang) {
                $q->where('cabang_id', $data_cabang->id);
            })
            ->orderBy('nama', 'asc')
            ->get();
        return view('dashboard-ramadhan.admin.peserta-lomba.data-cabang-lomba', compact('data_peserta_lomba', 'data_cabang'));
    }
}
