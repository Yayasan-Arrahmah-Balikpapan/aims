<?php

namespace App\Domain\Website\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\SEO;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\PendaftaranTahsinRequest;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Str;
use App\Models\Periode;
use App\Models\Transaksi;
use App\Models\Peserta;
use App\Models\User;
use App\Models\Jadwal;
use Throwable;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;

class DaftarUlangTahsinMigrasiController extends Controller
{
    public $description, $keywords, $sitename;
    public function __construct()
    {
        $this->description = 'Yayasan Arrahmah Balikpapan. Pusat Belajar Tahsin Tahfizh Di Kota Balikpapan. Belajar Mengaji Al-Quran Secara Terstruktur.';
        $this->keywords = 'Belajar Ngaji, Tahsin, Tahfizh, Balikpapan';
        $this->sitename = 'Pendidikan Al-quran Kota Balikpapan';
    }

    public function notifwa($nomorhp, $isipesan)
    {
        $apikey     = env('WAHA_API_KEY');
        $url        = env('WAHA_API_URL');
        $sessionApi = env('WAHA_API_SESSION');
        $requestApi = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
            'X-Api-Key'    => $apikey,
        ]);

        // try {
            // #1 Send Seen
            // // $requestApi->post($url.'/api/sendSeen', [ "session" => $sessionApi, "chatId"  => $nomorhp.'@c.us', ]);

            // #2 Start Typing
            // $requestApi->post($url.'/api/startTyping', [ "session" => $sessionApi, "chatId"  => $nomorhp.'@c.us', ]);

            // sleep(1); // jeda seolah olah ngetik

            // #3 Stop Typing
            // $requestApi->post($url.'/api/stopTyping', [ "session" => $sessionApi, "chatId"  => $nomorhp.'@c.us', ]);

            #4 Send Message
            $requestApi->get($url.'/api/sendText', [
                "session" => $sessionApi,
                "phone"  => $nomorhp.'@c.us',
                "text"    => $isipesan,
            ]);
        // } catch (Throwable $th) {
        //     // throw $th;
        // }
    }

    public function tahsin_daftar_ulang(Request $request)
    {
        $page_title = 'Daftar Ulang Tahsin - LTTQ Arrahmah Balikpapan';
        SEO::title($page_title)
            ->description($this->description)
            ->keywords($this->keywords)
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl('arrahmahbalikpapan.or.id')
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;


        // Buat session baru untuk pendaftaran tahsin
        $uuid = Str::uuid();
        session()->put('daftar-ulang-migrasi.tahsin.uuid', $uuid, now()->addDay(1));

        $json = Storage::disk('public')->get('/data/daerah-indonesia.json');
        $dataindo = json_decode($json, true);

        $periode = Periode::where('aktifkan_pendaftaran',1)->first();

        if ($periode) {
            return view('website.pages.lttq.tahsin.daftar-ulang-migrasi', compact('dataindo', 'periode'));
        } else {
            return view('website.pages.lttq.tahsin.daftar-ulang-tutup');
        }
    }

    public function tahsin_daftar_ulang_store(Request $request)
    {


        $periode = Periode::where('aktifkan_pendaftaran',1)->first();
        if ($periode) {
            // $request->validated();
            DB::beginTransaction();

            try {

                $data_format = $request->except(['_token', '_method']);
                $total = array_sum($data_format);
                $data_payment = [
                    'list' => array_map(function($item) {
                        return [
                            'name' => $item,
                            'nominal' => $item,
                        ];
                    }, $data_format),
                ];

                $data_format = [];
                $data_payment = [];
                $total = 0;
                foreach(json_decode($periode->format_pembayaran, true) as $item){
                    $label = 'pembayaran'.$item['name'];
                    $data_format[] = [
                        $item['name'] => $request->get($label) ?? 0,
                    ];
                    if($request->get($label) == 1){
                        $total += $item['value'] ?? 0;
                    }

                    if($request->get($label) == 1){
                        $data_payment['list'][] =
                            [
                                'name' => $item['label'],
                                'nominal' => $item['value'],
                            ]
                        ;
                    }

                }

                $uuid    = session()->get('daftar-ulang.tahsin.uuid');
                $ktp     = session()->get('daftar-ulang.tahsin.ktp');
                // if (!$ktp) {
                //     Toast::title('Anda Belum Upload KTP !')
                //         ->warning()
                //         ->autoDismiss(10);
                //     return redirect()->back();
                // }

                // $rekaman = session()->get('daftar-ulang.tahsin.rekaman');
                // if (!$rekaman) {
                //     Toast::title('Anda Belum Merekam / Upload Tilawah Quran !')
                //         ->warning()
                //         ->autoDismiss(10);
                //     return redirect()->back();
                // }

                // Menghapus karakter '0' dan '62' di awal nomor telepon yang dimasukkan
                $phone_number = ltrim($request->input('phone_number'), '0');
                $phone_number = ltrim($phone_number, '62');

                $user = User::where('phone_number', $request->input('phone_number'))->first();

                if (!$user) {
                    $user = User::create([
                        'phone_code'   => $request->input('phone_code') ?? '62',
                        'phone_number' => $request->input('phone_number'),
                    ]);
                }

                $biodata[] = [
                    'kota_domisili' => $request->input('kota_domisili') == null ? 'Kota Balikpapan' : $request->input('kota_domisili') ?? NULL,
                    'alamat'        => $request->input('alamat') ?? NULL,
                    'pekerjaan'     => $request->input('pekerjaan') ?? NULL,
                    // 'pembelajaran'  => $request->input('pembelajaran') ?? NULL,
                    // 'ktp'           => $ktp,
                    // 'rekaman'       => $rekaman,
                    'id_lama'       => $request->input('id_peserta') ?? NULL,
                    'notahsin'       => $request->input('notahsin') ?? NULL,
                ];

                $nomor_wa = $user->phone_code.ltrim($user->phone_number, '0');

                $peserta = Peserta::where('uuid', $uuid)->first();
                $peserta_kelas = Kelas::where('uuid', $uuid)->first();

                if(!$peserta) {
                    $peserta = Peserta::create([
                        'periode_id'      => $periode->id,
                        'user_id'         => $user->id,
                        'uuid'            => $uuid,
                        'phone_number'    => $nomor_wa,
                        'nama'            => $request->input('name'),
                        'jenis_peserta'   => $request->input('jenis_peserta'),
                        'tanggal_lahir'   => $request->input('tahun') . '-' . $request->input('bulan') . '-' . $request->input('tanggal'),
                        'biodata'         => json_encode($biodata),
                        // 'data_pembayaran' => json_encode($data_format),
                    ]);

                    $cekkuotajadwal = Jadwal::where('id', $request->input('jadwal'))
                            ->get()
                            ->filter(function($item) {
                                $jumlah_peserta = Kelas::where('jadwal_id', $item->id)->count();
                                if((int) $item->batasan_peserta <= $jumlah_peserta) {
                                    DB::rollBack();
                                    Toast::title('Kuota Jadwal Sudah Penuh !')
                                        ->danger()
                                        ->autoDismiss(10);
                                    return redirect()->back();
                                }
                                return true;
                            });

                    $peserta_kelas = Kelas::create([
                        'periode_id'      => $periode->id,
                        'peserta_id'      => $peserta->id,
                        'jadwal_id'       => $request->input('jadwal'), // daftarkan pilihan jadwal
                        'uuid'            => $uuid,
                        'data_pembayaran' => json_encode($data_format),
                        'data_absensi'    => $periode->format_absensi,
                    ]);

                    $data_payment['kode_unik'] = [
                                        'name'    => 'KODE UNIK',
                                        'nominal' => (int)($request->input('bulan').$request->input('tanggal')),
                                        'keterangan' => 'BBTT - Bulan Tanggal Lahir'
                                        ];

                    // KARENA DATA BARU JADI DIBUAT TRANSAKSI BARU
                    $uuid_transaksi = Str::uuid();
                    Transaksi::create([
                        'uuid'                     => $uuid_transaksi,
                        'periode_id'               => $periode->id,
                        'peserta_id'               => $peserta_kelas->id,
                        'user_id'                  => $user->id,
                        'nominal_total'            => $total,
                        'nominal_total_pembayaran' => $total + (int)($request->input('bulan').$request->input('tanggal')),
                        'data_pembayaran'          => json_encode($data_payment),
                        'payment_gateway_id'       => null,
                    ]);
                } else {
                    // KARENA DATA BARU TRANSAKSI BARU CUMA SATU
                    $transaksi =Transaksi::where('peserta_id', $peserta_kelas->id)->latest()->first();
                    $uuid_transaksi = $transaksi->uuid;
                }

            DB::commit();
            } catch (Throwable $e) {
                DB::rollBack();
                Toast::title('Mohon Maaf, Terjadi kesalahan, Segera Ulangi Proses Daftar Ulang')->warning()->autoDismiss(10);
                return redirect()->back();
            }


            $notif_wa = json_decode($periode->notifikasi, true);
            $this->notifwa($nomor_wa, $notif_wa[0]['pendaftaran']);

            return redirect()->route('website.lttq.invoice', ['uuid' => $uuid_transaksi]);
        } else {
            return redirect()->route('website.lttq.tahsin.pendaftaran-gagal');
        }
    }

    public function tahsin_daftar_ulang_berhasil(Request $request)
    {
        return view('website.pages.lttq.tahsin.daftar-ulang-berhasil');
    }

    public function tahsin_daftar_ulang_gagal(Request $request)
    {
        return view('website.pages.lttq.tahsin.daftar-ulang-gagal');
    }
}
