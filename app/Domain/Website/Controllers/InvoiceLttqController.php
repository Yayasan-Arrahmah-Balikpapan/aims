<?php

namespace App\Domain\Website\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Storage;




class InvoiceLttqController extends Controller
{
    public function index($uuid, Request $request)
    {
        $data = \App\Models\Transaksi::where('uuid', $uuid)->first();
        $data_pembayaran = \App\Models\Pembayaran::where('transaksi_id', $data->id)->get();
        if($data) {
            return view('website.pages.lttq.invoice', compact('uuid', 'data', 'data_pembayaran'));
        } else {
            abort(404);
        }
    }


    public function store($uuid, Request $request)
    {
        $buktitransfer     = session()->get('invoice.buktitransfer');
        if (!$buktitransfer) {
            Toast::title('Anda Belum Upload Bukti Transfer !')
                ->warning()
                ->autoDismiss(10);
        } else {
            DB::beginTransaction();
            try {
                $transaksi = \App\Models\Transaksi::where('uuid', $uuid)->first();
                if($transaksi){

                    $data_pembayaran = $transaksi->data_pembayaran;
                    $data_pembayaran['bukti_transfer'] = $buktitransfer;
                    $transaksi->update([
                        'data_pembayaran' => $data_pembayaran,
                        'status' => 2
                    ]);

                    DB::commit();
                    Toast::title('Upload Bukti Transfer Berhasil !')
                    ->autoDismiss(10);
                } else {
                    DB::rollBack();
                    Toast::title('Terjadi Kesalahan Data Transaksi. Mohon Ulangi')
                        ->warning()
                        ->autoDismiss(10);
                }
            } catch (\Exception $e) {
                DB::rollBack();
                Toast::title('Terjadi Kesalahan. Kontak Admin !')
                    ->warning()
                    ->autoDismiss(10);
            }
        }
        return redirect()->back();
        // return view('website.pages.lttq.tahsin');
    }

    public function store_bukti_transfer($uuid, Request $request)
    {
        // FIX SETELAH PROSES MELELAHKAN
        $request->validate([
            'buktitransfer' => 'required|image|mimes:jpeg,png,jpg,svg|max:5012', // maksimal 20MB
        ]);

        // Tentukan folder path dengan hierarki tahun/bulan/tanggal
        $year  = now()->format('Y');
        $month = now()->format('m');
        $day   = now()->format('d');
        $folderPath = "$year/$month/$day";

        // Generate nama file unik
        $fileName = $uuid . '.' . $request->file('buktitransfer')->getClientOriginalExtension();

        // Simpan file di storage
        try {
            $filePath = $request->file('buktitransfer')->storeAs($folderPath, $fileName, 'public');
            session()->put('invoice.buktitransfer', $filePath);

            // Kembalikan response sukses
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di-upload.',
                'file_path' => Storage::url($filePath),
            ]);
        } catch (\Exception $e) {

            // Kembalikan response gagal
            return response()->json([
                'success' => false,
                'message' => 'Gagal Upload',
                'error' => $e->getMessage(),
            ], 500);
        }
        // return view('website.pages.lttq.tahsin');
    }
}
