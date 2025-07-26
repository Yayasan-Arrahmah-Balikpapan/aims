<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PembayaranController extends Controller
{
    public function pembayaran_pilih_peserta(Request $request) {

        $data_peserta = \App\Models\Kelas::whereHas('peserta', function($query) {
                        $query->where('user_id', auth()->user()->id);
                    })
                    ->latest()
                    ->paginate(10);

        return view('dashboard.peserta.pembayaran-pilih-peserta', compact( 'data_peserta'));
    }

    public function pembayaran_form($uuid, Request $request) {

        $data_peserta = \App\Models\Kelas::whereHas('peserta', function($query) {
                        $query->where('user_id', auth()->user()->id);
                    })
                    ->where('uuid', $uuid)
                    ->first();
        $data_biaya = \App\Models\Biaya::where('periode_id', $data_peserta->periode->id)->get();
        $data_pembayaran_peserta = \App\Models\Pembayaran::where('kelas_id', $data_peserta->id)->get();

        return view('dashboard.peserta.pembayaran-form', compact( 'data_peserta', 'data_biaya', 'data_pembayaran_peserta'));
    }

    public function pembayaran_form_store($uuid, Request $request) {

        $data_peserta = \App\Models\Kelas::whereHas('peserta', function($query) {
                        $query->where('user_id', auth()->user()->id);
                    })
                    ->where('uuid', $uuid)
                    ->first();

        if (!$data_peserta) { Toast::warning('Terjadi Kesalahan Data, Mohon Ulangi'); }

        $data_biaya = \App\Models\Biaya::where('periode_id', $data_peserta->periode->id)->get();
        $data_pembayaran_peserta = \App\Models\Pembayaran::where('kelas_id', $data_peserta->id)->get();

        $total_nominal = 0;
        $total_pembayaran = 0;
        $donasi = 0;

        foreach ($data_biaya as $biaya) {
            if ($request->input('pembayaran' . $biaya->id)) {
                $total_nominal += $biaya->nominal;
            }
        }

        if ($total_nominal == 0) {
            Toast::warning('Anda belum memilih Pembayaran, Mohon Ulangi');
            return redirect()->back();
        }

        if ($request->input('pembayarandonasi') == 'custom') {
            $donasi += $request->input('pembayarandonasicustom');
        } else {
            $donasi += $request->input('pembayarandonasi');
        }

        $total_pembayaran = $total_nominal + $donasi + $data_peserta->kode_unik;

        DB::beginTransaction();

        try {
            // $kode_unik = rand(100, 999); // alternatif utama
            $uuid_transaksi = Str::uuid();

            $transaksi = \App\Models\Transaksi::create([
                'uuid'                     => $uuid_transaksi,
                'periode_id'               => $data_peserta->periode->id,
                'kelas_id'                 => $data_peserta->id,
                'kode_unik'                => $data_peserta->kode_unik,
                'peserta_id'               => $data_peserta->peserta->id,
                'user_id'                  => auth()->user()->id,
                'nominal_total'            => $total_nominal,
                'nominal_total_pembayaran' => $total_pembayaran,
                'donasi'                   => $donasi,
            ]);

            foreach ($data_biaya as $biaya) {
                if ($request->input('pembayaran' . $biaya->id)) {
                    if ($data_pembayaran_peserta->where('biaya_id', $biaya->id)->first()) {
                        DB::rollBack();
                        Toast::error('Terjadi kesalahan, Anda sudah melakukan proses pembayaran untuk biaya ini.');
                        return redirect()->back();
                    }

                    $pembayaran = \App\Models\Pembayaran::create([
                        'kelas_id'     => $data_peserta->id,
                        'transaksi_id' => $transaksi->id,
                        'periode_id'   => $data_peserta->periode->id,
                        'biaya_id'     => $biaya->id,
                        'nominal'      => $biaya->nominal,
                    ]);
                }
            }

            DB::commit();
            Toast::success('Transaksi dan Pembayaran berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
                dd($e);
            Toast::error('Terjadi kesalahan, mohon ulangi.');
        }

        return redirect()->route('website.lttq.invoice', ['uuid' => $uuid_transaksi]);
    }
}
