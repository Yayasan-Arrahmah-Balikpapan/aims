<?php

namespace App\Domain\Website\Controllers\Ramadhan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\SEO;
use Illuminate\Support\Str;
use ProtoneMedia\Splade\Facades\Toast;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Throwable;


class RamadhanController extends Controller
{
    public function kirimNotifWaPendaftaran($nomorhp, $uuid){

    $isipesan = "Assalamualaikum Wr. Wb.,
Terima kasih telah melakukan pendaftaran Lomba Semarak Ramadhan 1447H.
Segera lakukan pembayaran sesuai dengan invoice yang telah diberikan.

Invoice Anda:
".url('/ramadhan/lomba/invoice/'.$uuid)."

Untuk informasi lebih lanjut, silakan hubungi admin kami.

Ustadzah Widya
wa.me/6285750223866

Ustad Zaky
wa.me/6285750223866

Yayasan Arrahmah Balikpapan
    ";
        $url        = env('WA_API_URL');
        $requestApi = Http::withBasicAuth(env('WA_API_USER'), env('WA_API_PASSWORD'))
                            ->withHeaders([
                                'Content-Type' => 'application/json',
                                'Accept'       => 'application/json',
                            ]);

        try {
            $response = $requestApi->post($url . '/send/message', [
                "phone" => $nomorhp . '@s.whatsapp.net',
                "message" => $isipesan,
            ]);
            $message = json_decode($response->body());
            return response()->json(['success' => true, 'message' => $message], 200);
        } catch (Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }
    public function index()
    {
        $page_title = 'LTTQ Arrahmah Balikpapan';
        SEO::title($page_title)
            ->description('Semarak Ramadhan Bersama Yayasan Arrahmah Balikpapan')
            ->keywords('Belajar Ngaji, Tahsin, Tahfizh, Balikpapan')
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl('arrahmahbalikpapan.or.id')
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;
        
        return view('website.pages.ramadhan.index');
    }

    public function lomba()
    {
        $page_title = 'Lomba Ramadhan Arrahmah Balikpapan';
        SEO::title($page_title)
            ->description('Semarak Ramadhan Bersama Yayasan Arrahmah Balikpapan')
            ->keywords('Belajar Ngaji, Tahsin, Tahfizh, Balikpapan')
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl('arrahmahbalikpapan.or.id')
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        $uuid = Str::uuid();
        session()->put('pendaftaran.lomba.ramadhan.uuid', $uuid);

        return view('website.pages.ramadhan.lomba');
    }

    public function lomba_daftar()
    {
        $page_title = 'Daftar Lomba Ramadhan Arrahmah Balikpapan';
        SEO::title($page_title)
            ->description('Semarak Ramadhan Bersama Yayasan Arrahmah Balikpapan')
            ->keywords('Belajar Ngaji, Tahsin, Tahfizh, Balikpapan')
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl('arrahmahbalikpapan.or.id')
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        $uuid = Str::uuid();
        session()->put('pendaftaran.lomba.ramadhan.uuid', $uuid);

        return view('website.pages.ramadhan.lomba-daftar');
    }

    public function lomba_daftar_store(Request $request)
    {
        // dd($request->all());
        $donasi = 0;
        $pembayarandonasi = $request->input('pembayarandonasi') ? $request->input('pembayarandonasi') : 0;
        $pembayarandonasicustom = $request->input('pembayarandonasicustom') ? $request->input('pembayarandonasicustom') : 0;

        // if ($periode) {

            $donasi = $pembayarandonasi > 0 ? $pembayarandonasi : $pembayarandonasicustom;

            $uuid    = session()->get('pendaftaran.lomba.ramadhan.uuid');

            // Menghapus karakter '0' dan '62' di awal nomor telepon yang dimasukkan
            $phone_number = ltrim($request->input('phone_number'), '0');
            $phone_number = ltrim($phone_number, '62');

            $user = User::where('phone_number', $request->input('phone_number'))->first();

            if (!$user) {
                $user = User::create([
                    'phone_code'   => $request->input('phone_code') ?? '62',
                    'phone_number' => $request->input('phone_number'),
                ]);

                Auth::login($user);
            }

            $nomor_wa = $user->phone_code.ltrim($user->phone_number, '0');

            $cek_peserta = \App\Models\LombaPeserta::where('uuid', $uuid)->first();

            if ($cek_peserta) {
                Toast::title('Data Sudah Terdaftar. Mohon Ulangi !')
                    ->warning()
                    ->autoDismiss(10);
                return redirect()->back();
            }

            if(!$cek_peserta) {
                // try {
                //     DB::beginTransaction();

                    $lock_peserta = \App\Models\LombaPeserta::lockForUpdate()->latest()->first();

                    $data_peserta = \App\Models\LombaPeserta::create([
                        'uuid'            => $uuid,
                        'nama'            => $request->input('name'),
                        'user_id'         => Auth::id(),
                        'jenis_kelamin'   => $request->input('jenis_peserta'),
                        'tanggal_lahir'   => $request->input('tahun') . '-' . $request->input('bulan') . '-' . $request->input('tanggal'),
                        'alamat'          => $request->input('alamat'),
                    ]);

                    $nominal_total = 0;

                    for ($i = 1; $i <= 8; $i++) {
                        if($request->input('pembayaran'.$i) == '1') {
                            $nominal_total = $nominal_total + 50000;
                            \App\Models\LombaPendaftaran::create([
                            'peserta_id'          => $data_peserta->id,
                            'cabang_id'           => $i,
                            'nomor_peserta'       => null,
                            'status'              => 'MENDAFTAR',
                            'biaya'               => 50000,
                        ]); 
                        }
                    }

                    if($request->input('pembayaran9') == '1') {
                        $nominal_total = $nominal_total + 100000; 
                        $daftar_peserta_sd = \App\Models\LombaPendaftaran::create([
                            'peserta_id'          => $data_peserta->id,
                            'cabang_id'           => 9,
                            'nomor_peserta'       => null,
                            'status'              => 'MENDAFTAR',
                            'biaya'               => 100000,
                        ]);
                        $nama_peserta_sd = $daftar_peserta_sd->data;
                        $nama_peserta_sd['nama_1'] = $request->input('namapesertasd1');
                        $nama_peserta_sd['nama_2'] = $request->input('namapesertasd2');
                        $nama_peserta_sd['nama_3'] = $request->input('namapesertasd3');
                        $daftar_peserta_sd->data = $nama_peserta_sd;
                        $daftar_peserta_sd->save();

                    }elseif($request->input('pembayaran10') == '1') {
                        $nominal_total = $nominal_total + 100000; 
                        $daftar_peserta_smp = \App\Models\LombaPendaftaran::create([
                            'peserta_id'          => $data_peserta->id,
                            'cabang_id'           => 10,
                            'nomor_peserta'       => null,
                            'status'              => 'MENDAFTAR',
                            'biaya'               => 100000,
                        ]);

                        $nama_peserta_smp = $daftar_peserta_smp->data;
                        $nama_peserta_smp['nama_1'] = $request->input('namapesertasmp1');
                        $nama_peserta_smp['nama_2'] = $request->input('namapesertasmp2');
                        $nama_peserta_smp['nama_3'] = $request->input('namapesertasmp3');
                        $daftar_peserta_smp->data = $nama_peserta_smp;
                        $daftar_peserta_smp->save();
                    }

                    $uuid_transaksi = Str::uuid();
                    $transaksi = \App\Models\LombaTransaksi::create([
                        'uuid'                     => $uuid_transaksi,
                        'peserta_id'               => $data_peserta->id,
                        'user_id'                  => $user->id,
                        'status'                   => 1,
                        'nominal_total'            => $nominal_total,
                        'donasi'                   => $donasi,
                        'nominal_total_pembayaran' => $nominal_total + $donasi,
                    ]);

                    // $data_notifikasi = \App\Models\Notifikasi::where('slug', 'pendaftaran-baru')
                    //                 ->where('unit_id',1)
                    //                 ->first();

                    // $isi_notif_wa = $this->formatWhatsappPesertaKelasDanTransaksi($data_notifikasi->pesan_whatsapp, $peserta_kelas->id, $transaksi->id);
                    $this->kirimNotifWaPendaftaran($nomor_wa, $uuid_transaksi);

                    Toast::title('Pendaftaran Berhasil')
                        ->autoDismiss(10);
                    Toast::title('Segera Lakukan Pembayaran. Terima Kasih')
                        ->warning()
                        ->autoDismiss(10);

                //     DB::commit();
                // } catch (\Exception $e) {
                //     DB::rollBack();
                //     Toast::title('Terjadi Kesalahan. Mohon Ulangi !')
                //         ->warning()
                //         ->autoDismiss(10);
                //     return redirect()->back();

                //     // return $e;
                // }
            } else {
                // KARENA DATA BARU TRANSAKSI BARU CUMA SATU
                $transaksi = \App\Models\LombaTransaksi::where('pendaftaran_id', $cek_peserta->id)->latest()->first();
                $uuid_transaksi = $transaksi->uuid;
            }

            return redirect()->route('website.ramadhan.lomba.invoice', ['uuid' => $uuid_transaksi]);
        // } else {
        //     return redirect()->route('website.lttq.tahsin.pendaftaran-gagal');
        // }
    }

    public function lomba_invoice($uuid, Request $request)
    {
        $page_title = 'Invoice Lomba Ramadhan Arrahmah Balikpapan';
        SEO::title($page_title)
            ->description('Semarak Ramadhan Bersama Yayasan Arrahmah Balikpapan')
            ->keywords('Belajar Ngaji, Tahsin, Tahfizh, Balikpapan')
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl('arrahmahbalikpapan.or.id')
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        $data = \App\Models\LombaTransaksi::where('uuid', $uuid)->first();
        $data_lomba = \App\Models\LombaPendaftaran::where('peserta_id', $data->peserta_id)->get();
        if($data) {
            return view('website.pages.ramadhan.invoice', compact('uuid', 'data', 'data_lomba'));
        } else {
            abort(404);
        }
    }

    public function lomba_invoice_store($uuid, Request $request)
    {
        $buktitransfer     = session()->get('invoice.buktitransfer');
        if (!$buktitransfer) {
            Toast::title('Anda Belum Upload Bukti Transfer !')
                ->warning()
                ->autoDismiss(10);
        } else {
            DB::beginTransaction();
            try {
                $transaksi = \App\Models\LombaTransaksi::where('uuid', $uuid)->first();
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

    public function lomba_invoice_store_bukti_transfer($uuid, Request $request)
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
