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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\Contracts\NotificationService;
use App\Traits\FormatPesanNotifTahsinDaftarBaruTrait;
use App\Traits\ConvertNotifikasi;


class DaftarUlangTahsinController extends Controller
{
    use FormatPesanNotifTahsinDaftarBaruTrait;
    use ConvertNotifikasi;
    public $description, $keywords, $sitename, $notifService;
    public function __construct(NotificationService $notifService)
    {
        $this->description = 'Yayasan Arrahmah Balikpapan. Pusat Belajar Tahsin Tahfizh Di Kota Balikpapan. Belajar Mengaji Al-Quran Secara Terstruktur.';
        $this->keywords = 'Belajar Ngaji, Tahsin, Tahfizh, Balikpapan';
        $this->sitename = 'Pendidikan Al-quran Kota Balikpapan';

        $this->notifService = $notifService;
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

    public function tahsin_daftar_ulang_migrasi_data(Request $request)
    {

        // NGECEK DATA VALID
        $data_peserta_lama = DB::connection('mysql2')
                            ->table('tahsin')
                            ->where('id', $request->id)
                            ->where('nohp_peserta', $request->nohp_peserta)
                            ->first();

        if (!$data_peserta_lama) {
                Toast::title('Terjadi Keslahan Data. Silahkan Hubungi Admin.')
                    ->warning()
                    ->autoDismiss(10);
                return redirect()->back();
        }

        // MOMEN PENDAFTARAN ULNG DIBUKA
        $periode = Periode::where('aktifkan_pendaftaran',1)
                        ->where('kategori', 'reguler')
                            ->whereHas('unit', function($query) {
                                $query->where('slug', 'tahsin');
                            })
                        ->first();
        if (!$periode) {
                Toast::title('Daftar Ulang Sedang Ditutup. Silahkan Hubungi Admin.')
                    ->warning()
                    ->autoDismiss(10);
                return redirect()->back();
        }

        // Menghapus karakter '0' dan '62' di awal nomor telepon yang dimasukkan
        $phone_number = (substr($data_peserta_lama->nohp_peserta, 0, 1) == '0')
                        ? $data_peserta_lama->nohp_peserta
                        : '0'.$data_peserta_lama->nohp_peserta;

        $tanggal_lahir = \Carbon\Carbon::createFromFormat('Y-m-d', $data_peserta_lama->tanggal_lahir);

        $uuid = Str::uuid()->toString();
        Cache::put('peserta_'.$uuid, [
            'nama' => $data_peserta_lama->nama_peserta,
            'phone_code' => '62',
            'phone_number' => $phone_number,
            'tanggal' => $tanggal_lahir->day,
            'bulan' => $tanggal_lahir->month,
            'tahun' => $tanggal_lahir->year,
            'pekerjaan' => $data_peserta_lama->tanggal_lahir,
        ], now()->addHours(2)); // hanya berlaku 2 jam

        return redirect()->route('website.lttq.tahsin.daftar-ulang', ['uuid' => $uuid]);
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

        // NGECEK DATA VALID
        $data_peserta_lama = DB::connection('mysql2')
                            ->table('tahsins')
                            ->where('id', $request->id)
                            ->where('nohp_peserta', $request->nohp_peserta)
                            ->first();
        if(!$data_peserta_lama || $data_peserta_lama->kenaikan_level_peserta == 'TAJWIDI 1'){
            return view('website.pages.lttq.tahsin.daftar-ulang-tidak-valid');
        }



        $phone_number = (substr($data_peserta_lama->nohp_peserta, 0, 1) == '0')
                        ? $data_peserta_lama->nohp_peserta
                        : '0'.$data_peserta_lama->nohp_peserta;

        $tanggal_lahir = \Carbon\Carbon::createFromFormat('j-n-Y', $data_peserta_lama->waktu_lahir_peserta);

        // Buat session baru untuk pendaftaran tahsin
        $uuid = Str::uuid();

        $json = Storage::disk('public')->get('/data/daerah-indonesia.json');
        $dataindo = json_decode($json, true);

        $periode = Periode::where('aktifkan_pendaftaran',1)
                        ->where('kategori', 'reguler')
                        ->whereHas('unit', function($query) {
                                $query->where('slug', 'tahsin');
                            })
                        ->first();
        if(!$periode){
            return view('website.pages.lttq.tahsin.daftar-ulang-ditutup');
        }

        $data_biaya = \App\Models\Biaya::where('periode_id', $periode->id)->get();

        $datajadwal = Jadwal::where('periode_id', $periode->id)->with('level', 'kelas', 'pengajar')
                            ->where('jenis_peserta', $data_peserta_lama->jenis_peserta)
                            ->whereHas('level', function($query) use ($data_peserta_lama) {
                                $query->where('nama', $data_peserta_lama->kenaikan_level_peserta ?? $data_peserta_lama->level_peserta);
                            })
                            ->get()
                            // ->filter(function($item) {
                            //     return (int) $item->batasan_peserta > Kelas::where('jadwal_id', $item->id)->count();
                            // })
                            ;

        // dd($data_peserta_lama, $data_peserta_lama->kenaikan_level_peserta, $datajadwal);

        if ($periode) {
            return view('website.pages.lttq.tahsin.daftar-ulang',
            compact('dataindo', 'periode', 'data_peserta_lama', 'datajadwal', 'data_biaya', 'phone_number', 'tanggal_lahir', 'uuid'));
        } else {
            return view('website.pages.lttq.tahsin.daftar-ulang-tutup');
        }
    }

    public function tahsin_daftar_ulang_store(Request $request)
    {
        // dd($request->all());
        $periode = Periode::where('aktifkan_pendaftaran',1)->first();
        if(!$periode){
            return view('website.pages.lttq.tahsin.daftar-ulang-ditutup');
        }
        $data_biaya = \App\Models\Biaya::where('periode_id', $periode->id)->get();

        $donasi = 0;
        $pembayarandonasi = $request->input('pembayarandonasi') ? $request->input('pembayarandonasi') : 0;
        $pembayarandonasicustom = $request->input('pembayarandonasicustom') ? $request->input('pembayarandonasicustom') : 0;

        if ($periode) {



            $donasi = $pembayarandonasi > 0 ? $pembayarandonasi : $pembayarandonasicustom;

            $uuid    = Str::uuid()->toString();

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

            $nomor_wa = $user->phone_code.ltrim($user->phone_number, '0');

            $peserta = Peserta::where('uuid', $uuid)->first();
            $peserta_kelas = Kelas::where('uuid', $uuid)->first();

            if ($peserta) {
                Toast::title('Data Ini Sudah Terdaftar.')
                    ->warning()
                    ->autoDismiss(10);
                return redirect()->back();
            }

            // NGECEK KUOTA
            $hitung_data_kelas   = Kelas::where('jadwal_id', $request->input('jadwal'))->count();
            $data_jadwal         = Jadwal::find( $request->input('jadwal'));
            $data_bertambah      = $hitung_data_kelas + 1;
            if($data_bertambah > $data_jadwal->batasan_peserta){
                Toast::title('Kuota Kelas Sudah Penuh !')
                    ->warning()
                    ->autoDismiss(10);
                return redirect()->back();
            }

            if(!$peserta) {
                try {
                    DB::beginTransaction();

                    // NGECEK DATA VALID
                    $data_peserta_lama = DB::connection('mysql2')
                                        ->table('tahsins')
                                        ->where('id', $request->id_lama)
                                        ->first();

                    if ($data_peserta_lama->migrasi == null) {
                        DB::connection('mysql2')->table('tahsins')
                            ->where('id', $request->id_lama)
                            ->update(['migrasi' => date('Y-m-d H:i:s')]);
                    }
                    // else {
                    //     Toast::title('Data Ini Sudah Terdaftar Ulang !')
                    //         ->warning()
                    //         ->autoDismiss(10);
                    //     return redirect()->back();
                    // }

                    $lock_peserta = Peserta::lockForUpdate()->latest()->first();
                    $lock_kelas = Kelas::lockForUpdate()->latest()->first();

                    $peserta = Peserta::create([
                        'periode_id'      => $periode->id,
                        'user_id'         => $user->id,
                        'unit_id'         => $periode->unit_id,
                        'uuid'            => $uuid,
                        'phone_number'    => $nomor_wa,
                        'nama'            => $request->input('name'),
                        'jenis_peserta'   => $request->input('jenis_peserta'),
                        'tanggal_lahir'   => $request->input('tahun') . '-' . $request->input('bulan') . '-' . $request->input('tanggal'),
                        'biodata'         => [
                                'kota_domisili' => $request->input('kota_domisili'),
                                'alamat'        => $request->input('alamat'),
                                'pekerjaan'     => $request->input('pekerjaan'),
                                'pembelajaran'  => $request->input('pembelajaran'),
                                'ktp'           => '',
                                'rekaman'       => '',
                                'id_lama'       => $request->input('id_lama'),
                        ],
                    ]);

                    $hitung_data_peserta = Kelas::where('periode_id', $periode->id)->count();
                    $nomor               = $hitung_data_peserta + 1;
                    $kode_peserta        = str_pad($nomor, 4, '0', STR_PAD_LEFT);
                    $kode_periode        = str_pad($periode->angkatan, 4, '0', STR_PAD_LEFT);
                    $kode_unit           = $request->input('jenis_peserta') == 'ikhwan' ? 'TI' : 'TA';
                    $nis_peserta         = $kode_unit.$kode_periode.$kode_peserta;

                    while(Kelas::where('nis_peserta', $nis_peserta)->where('periode_id', $periode->id)->exists()) {
                        $hitung_data_peserta++;
                        $nomor               = $hitung_data_peserta + 1;
                        $kode_peserta        = str_pad($nomor, 4, '0', STR_PAD_LEFT);
                        $nis_peserta         = $kode_unit.$kode_periode.$kode_peserta;
                    }

                    if($request->input('kota_domisili')  == 'Kota Balikpapan') {
                        $domisili = 1;
                    } else {
                        $domisili = 0;
                    }

                    $peserta_kelas = Kelas::create([
                        'periode_id'          => $periode->id,
                        'peserta_id'          => $peserta->id,
                        'jadwal_id'           => $request->input('jadwal'),
                        'nis_peserta'         => $nis_peserta,
                        'kode_unik'           => $hitung_data_peserta + 1,
                        'uuid'                => $uuid,
                        'status_daftar'       => 'melanjutkan',
                        'status_pendaftaran'  => 'selesai pilih jadwal',
                        'status_aktif'        => 'aktif',
                        'status_uji'          => 'belum ujian',
                        'status_daftar_ulang' => 'belum daftar ulang',
                        'status_penerimaan'   => 'umum',
                        'status_domisili'     => $domisili,
                        'data_nilai'          => [
                                                    'rekaman-daftar-baru' => '',
                                                ]
                    ]);

                    $uuid_transaksi = Str::uuid();
                    $transaksi = Transaksi::create([
                        'uuid'                     => $uuid_transaksi,
                        'periode_id'               => $periode->id,
                        'kelas_id'                 => $peserta_kelas->id,
                        'peserta_id'               => $peserta->id,
                        'user_id'                  => $user->id,
                        'donasi'                   => $donasi,
                        'kode_unik'                => $nomor,
                        // 'kode_unik'                => (int)($request->input('bulan').$request->input('tanggal')), // BBTT
                    ]);

                    $total_nominal = 0;
                    $total_nominal_pembayaran = 0;
                    foreach($data_biaya as $item_biaya) {
                        if($item_biaya->wajib_dibayar_awal == true || $item_biaya->id == $request->input('pembayaran'.$item_biaya->id)){
                            $data_pembayaran_peserta = \App\Models\Pembayaran::create([
                                'periode_id' => $periode->id,
                                'transaksi_id' => $transaksi->id,
                                'biaya_id' => $item_biaya->id,
                                'nominal' => $item_biaya->nominal,
                                'kelas_id' => $peserta_kelas->id
                            ]);
                            $total_nominal += $item_biaya->nominal;
                        }
                    }
                    $total_nominal_pembayaran = $total_nominal + $nomor + $donasi;

                    $transaksi->update([
                        'nominal_total' => $total_nominal,
                        'nominal_total_pembayaran' => $total_nominal_pembayaran
                    ]);

                    Toast::title('Pendaftaran Berhasil')
                        ->autoDismiss(10);
                    Toast::title('Segera Lakukan Pembayaran. Terima Kasih')
                        ->warning()
                        ->autoDismiss(10);

                    if(!Auth::check()){
                        Auth::login($user);
                    }
                    DB::commit();
                    try {
                        $data_notifikasi = \App\Models\Notifikasi::where('unit_id', $periode->unit_id)
                                    ->where('slug', 'pendaftar-lanjutan')
                                    ->first();
                        $isi_notif_wa = $this->formatWhatsappPesertaKelas($data_notifikasi->pesan_whatsapp, $peserta_kelas->id);
                        $kirim_notif_wa = $this->notifService->kirimNotifWa($nomor_wa, $isi_notif_wa);

                        // dd($kirim_notif_wa, $data_notifikasi, $peserta_kelas, $nomor_wa, $isi_notif_wa);
                    } catch (\Exception $e) {
                        // skip
                    }
                } catch (\Exception $e) {
                    DB::rollBack();
                    Toast::title('Terjadi Kesalahan. Mohon Ulangi !')
                        ->warning()
                        ->autoDismiss(10);
                    return redirect()->back();

                    // return $e;
                }
            } else {
                // KARENA DATA BARU TRANSAKSI BARU CUMA SATU
                $transaksi =Transaksi::where('peserta_id', $peserta_kelas->id)->latest()->first();
                $uuid_transaksi = $transaksi->uuid;
            }



            return redirect()->route('website.lttq.invoice', ['uuid' => $uuid_transaksi]);
        } else {
            return redirect()->route('website.lttq.tahsin.daftar-ulang-gagal');
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
