<?php

namespace App\Http\Controllers\AdminIrma;

use App\Http\Controllers\Controller;
use App\Models\DaftarAnggotaIrma;
use Illuminate\Http\Request;

class AnggotaIrmaController extends Controller
{
    public function index(Request $request)
    {
        $query = DaftarAnggotaIrma::query()
            ->when($request->filled('cari'), function ($q) use ($request) {
                $q->where(function($sub) use ($request) {
                    $sub->where('nama', 'like', '%'.$request->cari.'%')
                        ->orWhere('telepon', 'like', '%'.$request->cari.'%')
                        ->orWhere('instansi', 'like', '%'.$request->cari.'%');
                });
            })
            ->when($request->filled('jenis_kelamin'), function ($q) use ($request) {
                $q->where('gender', $request->jenis_kelamin);
            })
            ->when($request->filled('divisi'), function ($q) use ($request) {
                $q->where('divisi', $request->divisi);
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->orderBy('created_at', 'desc');

        $pendaftars = $query->paginate(10);
        
        return view('dashboard-irma.admin.anggota-irma.index', compact('pendaftars'));
    }
}
