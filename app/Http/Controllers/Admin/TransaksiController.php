<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;



class TransaksiController extends Controller
{
    public function index($unit, $periode, Request $request)
    {
        // Logika untuk menampilkan data
        $dataperiode = \App\Models\Periode::find( $periode);
        $data_transaksi = \App\Models\Transaksi::with(['periode', 'periode.unit', 'kelas', 'kelas.peserta', 'kelas.jadwal', 'pembayaran'])
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
                    ->when($request->tanggal, function($query) use ($request) {
                        if (strpos($request->tanggal, ' to ') !== false) {
                            list($date1, $date2) = explode(' to ', $request->tanggal);
                            $query->whereBetween('created_at', [$date1.' 00:00:00', $date2.' 23:59:59']);
                        } else {
                            $query->whereDate('created_at', '=', $request->tanggal);
                        }
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

    public function show($unit, $periode, $transaksi)
    {
        $dataperiode = \App\Models\Periode::find( $periode);
        $data_transaksi = \App\Models\Transaksi::with(['peserta', 'kelas', 'kelas.jadwal', 'pembayaran', 'periode'])->find( $transaksi);
        $data_biaya = \App\Models\Biaya::where('periode_id', $data_transaksi->periode->id)->get();
        $data_pembayaran = \App\Models\Pembayaran::where('transaksi_id', $transaksi)->get();

        $biaya_pembayaran = \App\Models\Pembayaran::where('transaksi_id', $transaksi)
                                ->get()
                                ->mapWithKeys(function ($item) {
                                    return ['pembayaran'.$item->biaya_id => true];
                                })
                                ->toArray();
        $biaya_pembayaran['potongan'] = $data_transaksi->potongan;
        $biaya_pembayaran['donasi'] = $data_transaksi->donasi;
        // dd($data_transaksi, $data_biaya, $data_pembayaran, $biaya_pembayaran);

        return view('dashboard.admin.periode.transaksi.show', compact('unit','periode', 'dataperiode', 'data_transaksi', 'data_biaya', 'data_pembayaran', 'biaya_pembayaran'));
    }

    public function update($unit, $periode, $transaksi, Request $request)
    {
        // dd($request->all());

        $data_periode = \App\Models\Periode::find($periode);
        $data_biaya = \App\Models\Biaya::where('periode_id', $data_periode->id)->get();

        try {
            DB::beginTransaction();
            $data_transaksi = \App\Models\Transaksi::with(['kelas'])->find( $transaksi);
            $data_transaksi->potongan = $request->input('potongan');
            $data_transaksi->donasi = $request->input('donasi');
            $data_transaksi->save();

            $total_nominal = 0;
            $total_nominal_pembayaran = 0;
            foreach($data_biaya as $item_biaya) {
                if($request->input('pembayaran'.$item_biaya->id) == '1'){
                    $data_pembayaran_peserta = \App\Models\Pembayaran::where([
                        'periode_id' => $data_periode->id,
                        'transaksi_id' => $data_transaksi->id,
                        'biaya_id' => $item_biaya->id,
                        'kelas_id' => $data_transaksi->kelas->id
                    ])->firstOrCreate([
                        'periode_id' => $data_periode->id,
                        'transaksi_id' => $data_transaksi->id,
                        'biaya_id' => $item_biaya->id,
                        'kelas_id' => $data_transaksi->kelas->id,
                        'nominal' => $item_biaya->nominal,
                    ]);
                    $total_nominal += $item_biaya->nominal;
                }else{
                    $data_pembayaran_peserta = \App\Models\Pembayaran::where([
                        'periode_id' => $data_periode->id,
                        'transaksi_id' => $data_transaksi->id,
                        'biaya_id' => $item_biaya->id,
                        'kelas_id' => $data_transaksi->kelas->id
                    ])->delete();
                }
            }
            $total_nominal_pembayaran = $total_nominal + $data_transaksi->kelas->kode_unik + $request->input('donasi');
            $total_nominal_pembayaran = $total_nominal_pembayaran - $request->input('potongan');

            $data_transaksi->update([
                'nominal_total' => $total_nominal,
                'nominal_total_pembayaran' => $total_nominal_pembayaran
            ]);

            DB::commit();
            Toast::title('Update Berhasil !')->autoDismiss(10);
        } catch (Throwable $e) {
            DB::rollBack();
            Toast::title('Terjadi kesalahan, Update Gagal, tanya asif !')
                    ->warning()
                    ->autoDismiss(10);
            throw $e;
        }
        return redirect()->back();
    }

    public function destroy($unit, $periode, $transaksi)
    {
        \App\Models\Transaksi::where('id', $transaksi)
            ->with('pembayaran')
            ->first()
            ->pembayaran()
            ->each(function ($item) {
                $item->delete();
            });
        \App\Models\Transaksi::where('id', $transaksi)->delete();

        Toast::info('Data berhasil dihapus');
        return redirect()->route('admin.transaksi.index', ['unit' => $unit,'periode' => $periode]);
    }

    public function export($unit, $periode)
    {
        $data_periode = \App\Models\Periode::find($periode);
        return Excel::download(new \App\Exports\AdminTransaksi($periode), 'Data_Transaksi_Admin_' . $data_periode->nama . '.xlsx');
    }
}
