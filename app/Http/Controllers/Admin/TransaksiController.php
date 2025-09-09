<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;


class TransaksiController extends Controller
{
    public function index($unit, $periode, Request $request)
    {
        // Logika untuk menampilkan data
        $dataperiode = \App\Models\Periode::find( $periode);
        $data_transaksi = \App\Models\Transaksi::with(['periode', 'peserta', 'kelas', 'pembayaran'])
                    ->whereHas('periode', function($query) use ($dataperiode) {
                        $query->where('id', $dataperiode->id);
                    })
                    ->when($request->cari, function($query) use ($request) {
                        $query->whereHas('peserta', function($query) use ($request) {
                            $query->where('nama', 'like', '%'.$request->cari.'%')
                            ->orWhere('nis_peserta', 'like', '%'.$request->cari.'%');
                        });
                    })
                    ->when($request->jenis_peserta, function($query) use ($request) {
                        $query->whereHas('peserta', function($query) use ($request) {
                            $query->where('jenis_peserta', $request->jenis_peserta);
                        });
                    })
                    ->when($request->peserta, function($query) use ($request) {
                        $query->whereHas('kelas', function($query) use ($request) {
                            $query->where('status_daftar', $request->peserta);
                        });
                    })
                    ->latest()
                    ->paginate(10);


        return view('dashboard.admin.periode.transaksi.index', compact('unit','periode', 'dataperiode', 'data_transaksi'));
    }

    public function bukti_transfer($unit, $periode, $transaksi)
    {
        $data_periode = \App\Models\Periode::find( $periode);
        $data_transaksi = \App\Models\Transaksi::find($transaksi);

        return view('dashboard.admin.periode.transaksi.bukti-transfer', compact('unit','periode', 'data_periode', 'data_transaksi'));
    }

    public function konfirmasi($unit, $periode, $transaksi)
    {
        $data_periode = \App\Models\Periode::find( $periode);
        $data_transaksi = \App\Models\Transaksi::find($transaksi);

        $data_transaksi->status = 3;
        $data_transaksi->save();

        Toast::info('Data berhasil dikonfirmasi '.$data_transaksi->peserta->nama);
        return redirect()->back();
    }

    public function store(Request $request, $unit)
    {
        // Logika untuk menyimpan data baru
    }

    public function show($unit, $id)
    {
        // Logika untuk menampilkan data berdasarkan ID
    }

    public function update(Request $request, $unit, $id)
    {
        // Logika untuk memperbarui data berdasarkan ID
    }

    public function destroy($unit, $id)
    {
        // Logika untuk menghapus data berdasarkan ID
    }
}
