<?php

namespace App\Http\Controllers\AdminRamadhan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Http;
use Throwable;



class TransaksiLombaRamadhanController extends Controller
{
    public function kirimNotifWa($nomorhp, $peserta){
        $data_lomba_pendaftaran = \App\Models\LombaPendaftaran::where('peserta_id', $peserta)->get();

        $grup_lomba = [];
        foreach($data_lomba_pendaftaran as $lomba){
            if ($lomba->cabang_id == 1 || $lomba->cabang_id == 2) {
                $grup_lomba[] = 'Silahkan Masuk grup lomba:  Menggambar & Mewarnai https://chat.whatsapp.com/EKi96gyLtpK54wmitCklYE
';
            } elseif ($lomba->cabang_id == 3 || $lomba->cabang_id == 4 || $lomba->cabang_id == 5) {
                $grup_lomba[] = 'Silahkan Masuk grup lomba:  Adzan & Iqomah https://chat.whatsapp.com/KlVvCURMO5K4Voa4UKRPlE
';
            } elseif ($lomba->cabang_id == 6 || $lomba->cabang_id == 7 || $lomba->cabang_id == 8) {
                $grup_lomba[] = 'Silahkan Masuk grup lomba:  Tahfidz https://chat.whatsapp.com/BftbT8qgsafBoLRo1ZXHR6
';
            }  elseif ($lomba->cabang_id == 9 || $lomba->cabang_id == 10) {
                $grup_lomba[] = 'Silahkan Masuk grup lomba:  Cerdas Cermat https://chat.whatsapp.com/JECFiwrjdMA2tzlvSVQsIx
';
            }
         }


    $isipesan = "Assalamualaikum Wr. Wb.,
Terima kasih, kami telah mengkonfirmasi pendaftaran Lomba Semarak Ramadhan 1447H.

". implode("\n", $grup_lomba) . "


Kontak CS Lomba :

Ustadzah Widya
wa.me/6285750223866

Ustad Zaky
wa.me/6281649329520

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

    public function kirimNotifWaPembayaran($nomorhp, $uuid){

    $isipesan = "Assalamualaikum Wr. Wb.,
Ini adalah notifikasi automatis.
Segera lakukan pembayaran sesuai dengan invoice yang telah diberikan.

Invoice Anda:
".url('/ramadhan/lomba/invoice/'.$uuid)."

Untuk informasi lebih lanjut, silakan hubungi admin kami.

Kontak CS Lomba :

Ustadzah Widya
wa.me/6285750223866

Ustad Zaky
wa.me/6281649329520

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
    public function index(Request $request)
    {
        $data_transaksi = \App\Models\LombaTransaksi::with(['user', 'peserta'])
                            ->when($request->cari, function($query) use ($request) {
                                $query->whereHas('peserta',  function ($q) use ($request) {
                                    $q->where('nama', 'like', '%'.$request->cari.'%')
                                    ->orWhere('alamat', 'like', '%'.$request->cari.'%');
                                });
                            })
                            ->when($request->jenis_peserta, function($query) use ($request) {
                                $query->whereHas('peserta',  function ($q) use ($request) {
                                    $q->where('jenis_kelamin', 'like', $request->jenis_peserta);
                                });
                            })
                            ->when($request->status, function($query) use ($request) {
                                $query->where('status', 'like', $request->status);
                            })
                            ->when($request->tanggal_lahir, function($query) use ($request) {
                                if (strpos($request->tanggal, ' to ') !== false) {
                                    list($date1, $date2) = explode(' to ', $request->tanggal);
                                    $query->whereBetween('created_at', [$date1.' 00:00:00', $date2.' 23:59:59']);
                                } else {
                                    $query->whereDate('created_at', '=', $request->tanggal);
                                }
                            })
                            ->latest()->paginate(10);
        return view('dashboard-ramadhan.admin.transaksi-lomba.index', compact('data_transaksi'));
    }

    public function konfirmasi($transaksi)
    {
        $data_transaksi = \App\Models\LombaTransaksi::find($transaksi);
        $data_transaksi->status = 3;
        $data_transaksi->save();

        $nowa = $data_transaksi->user->phone_code.ltrim($data_transaksi->user->phone_number, '0');

        $this->kirimNotifWa($nowa, $data_transaksi->peserta_id);

        Toast::info('Data berhasil dikonfirmasi '.$data_transaksi->peserta->nama);
        return redirect()->back();
    }

    public function notif_pengingat_pembayaran($transaksi)
    {
        $data_transaksi = \App\Models\LombaTransaksi::find($transaksi);
        $notif_pembayaran = $data_transaksi->data_pembayaran;
        $notif_pembayaran['notif_pengingat_pembayaran'] = isset($notif_pembayaran['notif_pengingat_pembayaran']) ? $notif_pembayaran['notif_pengingat_pembayaran'] + 1 : 1;
        $data_transaksi->data_pembayaran = $notif_pembayaran;
        $data_transaksi->save();

        $nowa = $data_transaksi->user->phone_code.ltrim($data_transaksi->user->phone_number, '0');

        $this->kirimNotifWaPembayaran($nowa, $data_transaksi->uuid);

        Toast::info('Notifikasi berhasil dikirim '.$data_transaksi->peserta->nama);
        return redirect()->back();
    }
}
