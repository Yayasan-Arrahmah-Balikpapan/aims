<?php

namespace App\Domain\Website\Controllers;

use App\Http\Controllers\Controller;
use ProtoneMedia\Splade\Facades\SEO;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Requests\PendaftaranTahsinRequest;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Spatie\Image\Image;
use App\Models\Periode;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\Peserta;
use App\Models\User;
use App\Models\PaymentGateway;
use Throwable;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
class WebController extends Controller
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
    public function home()
    {
        $page_title = 'Yayasan Arrahmah | Pendidikan Al-quran Kota Balikpapan';
        SEO::title($page_title)
            ->description($this->description)
            ->keywords($this->keywords)
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl('arrahmahbalikpapan.or.id')
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        return view('website.pages.home');
    }

    public function yayasan()
    {
        $page_title = 'Yayasan Arrahmah Balikpapan';
        SEO::title($page_title)
            ->description($this->description)
            ->keywords($this->keywords)
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl('arrahmahbalikpapan.or.id')
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        return view('website.pages.yayasan');
    }

    public function lttq()
    {
        $page_title = 'LTTQ Arrahmah Balikpapan';
        SEO::title($page_title)
            ->description($this->description)
            ->keywords($this->keywords)
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl('arrahmahbalikpapan.or.id')
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        return view('website.pages.lttq.index');
    }

    public function lttq_tahsin()
    {
        return view('website.pages.lttq.tahsin.index');
    }

    public function lttq_tahsin_pendaftaran()
    {
        $page_title = 'Daftar Tahsin - LTTQ Arrahmah Balikpapan';
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
        session()->put('pendaftaran.tahsin.uuid', $uuid);

        $json = Storage::disk('public')->get('/data/daerah-indonesia.json');
        $dataindo = json_decode($json, true);

        // $chapterNumber = 41;
        // $startAyat = 44;
        // $endAyat = 48;

        // // Request API untuk mendapatkan ayat dari 44 sampai 48
        // $response = Http::get("https://api.quran.com/api/v4/verses/by_chapter/$chapterNumber", [
        //     'language' => 'ar',
        //     'verse_key' => "$chapterNumber:$startAyat-$chapterNumber:$endAyat"
        // ]);

        // $dataayat = $response->json();

        // $ayat = Cache::remember('ayat', 60, function () {
        //     $ayat = [];
        //     for ($i = 44; $i <= 48; $i++) {
        //         $dataayat = Http::get("http://api.alquran.cloud/v1/ayah/41:{$i}/editions/quran-uthmani");
        //         $data = $dataayat->json();
        //         foreach ($data['data'] as $ayat_) {
        //             $ayat[] = $ayat_['text'];
        //         }
        //     }
        //     return $ayat;
        // });
        // dd($ayat);
        $ayat = [
            "وَلَوْ جَعَلْنَٰهُ قُرْءَانًا أَعْجَمِيًّۭا لَّقَالُوا۟ لَوْلَا فُصِّلَتْ ءَايَٰتُهُۥٓ ۖ ءَا۬عْجَمِىٌّۭ وَعَرَبِىٌّۭ ۗ قُلْ هُوَ لِلَّذِينَ ءَامَنُوا۟ هُدًۭى وَشِفَآءٌۭ ۖ وَٱلَّذِينَ لَا يُؤْمِنُونَ فِىٓ ءَاذَانِهِمْ وَقْرٌۭ وَهُوَ عَلَيْهِمْ عَمًى ۚ أُو۟لَٰٓئِكَ يُنَادَوْنَ مِن مَّكَانٍۭ بَعِيدٍۢ",
            "وَلَقَدْ ءَاتَيْنَا مُوسَى ٱلْكِتَٰبَ فَٱخْتُلِفَ فِيهِ ۗ وَلَوْلَا كَلِمَةٌۭ سَبَقَتْ مِن رَّبِّكَ لَقُضِىَ بَيْنَهُمْ ۚ وَإِنَّهُمْ لَفِى شَكٍّۢ مِّنْهُ مُرِيبٍۢ",
            "مَّنْ عَمِلَ صَٰلِحًۭا فَلِنَفْسِهِۦ ۖ وَمَنْ أَسَآءَ فَعَلَيْهَا ۗ وَمَا رَبُّكَ بِظَلَّٰمٍۢ لِّلْعَبِيدِ",
            "۞ إِلَيْهِ يُرَدُّ عِلْمُ ٱلسَّاعَةِ ۚ وَمَا تَخْرُجُ مِن ثَمَرَٰتٍۢ مِّنْ أَكْمَامِهَا وَمَا تَحْمِلُ مِنْ أُنثَىٰ وَلَا تَضَعُ إِلَّا بِعِلْمِهِۦ ۚ وَيَوْمَ يُنَادِيهِمْ أَيْنَ شُرَكَآءِى قَالُوٓا۟ ءَاذَنَّٰكَ مَا مِنَّا مِن شَهِيدٍۢ",
            "وَضَلَّ عَنْهُم مَّا كَانُوا۟ يَدْعُونَ مِن قَبْلُ ۖ وَظَنُّوا۟ مَا لَهُم مِّن مَّحِيصٍۢ"
        ];

        $periode = Periode::where('aktifkan_pendaftaran',1)
                        ->where('unit_id', 1)
                        ->first();
        if ($periode) {
            return view('website.pages.lttq.tahsin.pendaftaran', compact('dataindo', 'ayat', 'periode'));
        } else {
            return view('website.pages.lttq.tahsin.pendaftaran-tutup');
        }
    }

    public function lttq_tahsin_pendaftaran_store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            // 'pembayaran_*' => 'required',
            // Add other fields and validation rules as needed
            'phone_number' => 'required|digits_between:9,15',
            'jenis_peserta' => 'required|in:ikhwan,akhwat',
            'pembelajaran' => 'required',
            'name' => 'required',
            'kota_domisili' => 'required|string',
            'pembayaranpendaftaran' => 'required|boolean',
            'pembayaranspp1' => 'required|boolean',
            'pembayaranspp2' => 'nullable|boolean',
            'pembayaranspp3' => 'nullable|boolean',
            'pembayaranspp4' => 'nullable|boolean',
            'pembayarandonasicustom' => 'nullable|numeric',
        ], [
            'phone_number.required' => 'Harap masukkan nomor hp yang benar',
            'phone_number.digits_between' => 'Nomor hp harus berjumlah 9-15 digit',
            'jenis_peserta.required' => 'Harap pilih jenis peserta',
            'jenis_peserta.in' => 'Jenis peserta tidak valid',
            'pembelajaran.required' => 'Harap pilih metode pembelajaran',
            'name.required' => 'Harap masukkan nama lengkap',
            'kota_domisili.required' => 'Harap masukkan kota domisili',
            'pembayaranpendaftaran.required' => 'Harap pilih metode pembayaran pendaftaran',
            'pembayaranpendaftaran.boolean' => 'Metode pembayaran pendaftaran terjadi kesalahan input',
            'pembayaranspp1.required' => 'Harap pilih metode pembayaran spp 1',
            'pembayaranspp1.boolean' => 'Metode pembayaran spp 1 terjadi kesalahan input',
            'pembayaranspp2.boolean' => 'Metode pembayaran spp 2 terjadi kesalahan input',
            'pembayaranspp3.boolean' => 'Metode pembayaran spp 3 terjadi kesalahan input',
            'pembayaranspp4.boolean' => 'Metode pembayaran spp 4 terjadi kesalahan input',
            'pembayarandonasicustom.numeric' => 'Biaya donasi harus berupa angka',
        ]);


        $periode = Periode::where('aktifkan_pendaftaran',1)->first();
        if ($periode) {
            // $request->validated();

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


            if($request->get('pembayarandonasi') == 'custom'){
                $total += $request->get('pembayarandonasicustom');
                $data_payment['list'][] =
                    [
                        'name' => 'INFAQ',
                        'nominal' => $request->get('pembayarandonasicustom'),
                    ]
                ;
            } elseif($request->get('pembayarandonasi') != null){
                $total += $request->get('pembayarandonasi');
                $data_payment['list'][] =
                    [
                        'name' => 'INFAQ',
                        'nominal' => $request->get('pembayarandonasi'),
                    ]
                ;
            }


            // dd($data_format,$data_payment,$total,$request->all());

            $uuid    = session()->get('pendaftaran.tahsin.uuid');
            $ktp     = session()->get('pendaftaran.tahsin.ktp');
            if (!$ktp) {
                Toast::title('Anda Belum Upload KTP !')
                    ->warning()
                    ->autoDismiss(10);
                return redirect()->back();
            }

            $rekaman = session()->get('pendaftaran.tahsin.rekaman');
            if (!$rekaman) {
                Toast::title('Anda Belum Merekam / Upload Tilawah Quran !')
                    ->warning()
                    ->autoDismiss(10);
                return redirect()->back();
            }


            if (auth()->check()) {
                $user = User::where('phone_number', auth()->user()->phone_number )->first();
            } else {
                // Menghapus karakter '0' dan '62' di awal nomor telepon yang dimasukkan
                // $phone_number = ltrim($request->input('phone_number'), '0');
                // $phone_number = ltrim($phone_number, '62');

                $user = User::where('phone_number', $request->input('phone_number'))->first();

                if (!$user) {
                    $user = User::create([
                        'phone_code'   => $request->input('phone_code') ?? '62',
                        'phone_number' => $request->input('phone_number'),
                    ]);
                }
            }

            $biodata[] = [
                'kota_domisili' => $request->input('kota_domisili') == null ? 'Kota Balikpapan' : $request->input('kota_domisili'),
                'alamat'        => $request->input('alamat'),
                'pekerjaan'     => $request->input('pekerjaan'),
                'pembelajaran'  => $request->input('pembelajaran'),
                'ktp'           => $ktp,
                'rekaman'       => $rekaman,
            ];

            $nomor_wa = $user->phone_code.ltrim($user->phone_number, '0');

            $peserta = Peserta::where('uuid', $uuid)->first();
            $peserta_kelas = Kelas::where('uuid', $uuid)->first();


                if(!$peserta) {
                    DB::beginTransaction();
                    try {
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

                        $peserta_kelas = Kelas::create([
                            'periode_id'      => $periode->id,
                            'peserta_id'      => $peserta->id,
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
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                        return redirect()->route('website.lttq.tahsin.pendaftaran-gagal');
                    }

                } else {
                    // KARENA DATA BARU TRANSAKSI BARU CUMA SATU
                    $transaksi =Transaksi::where('peserta_id', $peserta_kelas->id)->latest()->first();
                    $uuid_transaksi = $transaksi->uuid;
                }

            $notif_wa = json_decode($periode->notifikasi, true);
            try {
                $this->notifwa($nomor_wa, $notif_wa[0]['pendaftaran']);
            } catch (\Exception $e) {
                // Skip on error, do nothing
            }

            return redirect()->route('website.lttq.invoice', ['uuid' => $uuid_transaksi]);
        } else {
            return redirect()->route('website.lttq.tahsin.pendaftaran-gagal');
        }
    }

    public function lttq_tahsin_pendaftaran_store_ktp(Request $request)
    {
        // FIX SETELAH PROSES MELELAHKAN
        $request->validate([
            'ktp' => 'required|image|mimes:jpeg,png,jpg,svg|max:5012', // maksimal 20MB
        ]);

        // Tentukan folder path dengan hierarki tahun/bulan/tanggal
        $year  = now()->format('Y');
        $month = now()->format('m');
        $day   = now()->format('d');
        $folderPath = "$year/$month/$day";

        // Generate nama file unik
        $fileName = session('pendaftaran.tahsin.uuid') . '.' . $request->file('ktp')->getClientOriginalExtension();

        // Simpan file di storage
        try {
            $filePath = $request->file('ktp')->storeAs($folderPath, $fileName, 'public');
            session()->put('pendaftaran.tahsin.ktp', $filePath);

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

    public function lttq_tahsin_pendaftaran_store_rekaman(Request $request)
    {
        // FIX SETELAH PROSES MELELAHKAN
        $request->validate([
            'audio' => 'required|file|max:20480', // maksimal 20MB
        ]);

        // Decode base64 audio data
        $audioData = $request->input('audio');
        $audioData = str_replace('data:audio/wav;base64,', '', $audioData);
        $audioData = base64_decode($audioData);

        // Tentukan folder path dengan hierarki tahun/bulan/tanggal
        $year  = now()->format('Y');
        $month = now()->format('m');
        $day   = now()->format('d');
        $folderPath = "$year/$month/$day";

        // Generate nama file unik
        $fileName = session('pendaftaran.tahsin.uuid') . '.' . $request->file('audio')->getClientOriginalExtension();

        // Simpan file di storage
        try {
            $filePath = $request->file('audio')->storeAs($folderPath, $fileName, 'public');
            session()->put('pendaftaran.tahsin.rekaman', $filePath);

            Toast::title('Rekaman Berhasil Tersimpan !')
                    ->autoDismiss(15);
            // Kembalikan response sukses
            return response()->json([
                'success' => true,
                'message' => 'Rekaman berhasil di-upload.',
                'file_path' => Storage::url($filePath),
            ]);
        } catch (\Exception $e) {
            Toast::title('Maaf, Terjadi Kesalahan !')
                    ->message('Rekaman Gagal Terupload. Jika terus berulang. Mohon Kirim Rekaman Ke Admin Via Whatsapp.')
                    ->warning()
                    ->autoDismiss(15);
            // Kembalikan response gagal
            return response()->json([
                'success' => false,
                'message' => 'Gagal meng-upload rekaman.',
                'error' => $e->getMessage(),
            ], 500);
        }
        // return view('website.pages.lttq.tahsin');
    }

    public function lttq_tahsin_pendaftaran_berhasil(Request $request)
    {
        return view('website.pages.lttq.tahsin.pendaftaran-berhasil');
    }

    public function lttq_tahsin_pendaftaran_gagal(Request $request)
    {
        return view('website.pages.lttq.tahsin.pendaftaran-gagal');
    }

    public function lttq_invoice(Request $request, $uuid)
    {
        $data = Transaksi::where('uuid', $uuid)->first();
        if($data) {
            // dd(json_decode($data->payment_gateway->data));
            return view('website.pages.lttq.invoice', compact('uuid', 'data'));
        } else {
            abort(404);
        }
    }

    public function lttq_invoice_store(Request $request, $uuid)
    {
        $buktitransfer     = session()->get('invoice.buktitransfer');
        if (!$buktitransfer) {
            Toast::title('Anda Belum Upload Bukti Transfer !')
                ->warning()
                ->autoDismiss(10);
        } else {
            $transaksi = Transaksi::where('uuid', $uuid)->first();
            if($transaksi){

                $bukti_transfer = $transaksi->data_pembayaran;
                $bukti_transfer_array = json_decode($bukti_transfer, true);
                $bukti_transfer_array['bukti_transfer'] = [ 'file' => $buktitransfer ];

                $transaksi->update([
                    'data_pembayaran' => json_encode($bukti_transfer_array),
                    'status' => 2,
                ]);
                Toast::title('Upload Bukti Transfer Berhasil !')
                ->autoDismiss(10);
            } else {
            Toast::title('Terjadi Kesalahan. Kontak Admin !')
                ->warning()
                ->autoDismiss(10);
            }
        }
        return redirect()->back();
        // return view('website.pages.lttq.tahsin');
    }

    public function lttq_invoice_store_bukti_transfer(Request $request, $uuid)
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

    public function lttq_rq()
    {
        return view('website.pages.lttq.rq');
    }

    public function lttq_tla()
    {
        return view('website.pages.lttq.tla');
    }

    public function lttq_rtq_putra()
    {
        return view('website.pages.lttq.rtq-putra');
    }

    public function lttq_rtq_putri()
    {
        return view('website.pages.lttq.rtq-putri');
    }

    public function kontak()
    {
        $page_title = 'Kontak Yayasan Arrahmah';
        SEO::title($page_title)
            ->description($this->description)
            ->keywords($this->keywords)
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl('arrahmahbalikpapan.or.id')
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        return view('website.pages.kontak');
    }

    public function informasi()
    {
        $page_title = 'Informasi Yayasan Arrahmah';
        SEO::title($page_title)
            ->description($this->description)
            ->keywords($this->keywords)
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl('arrahmahbalikpapan.or.id')
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        return view('website.pages.informasi.index');
    }

    public function informasi_slug($slug)
    {
        $page_title = 'Informasi Yayasan Arrahmah';
        SEO::title($page_title)
            ->description($this->description)
            ->keywords($this->keywords)
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl('arrahmahbalikpapan.or.id')
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;
        $konten = [
            'instalasi-aims' => 'Instalasi AIMS',
            'persyaratan-pendaftaran' => 'Persyaratan Pendaftaran',
            'cara-pendaftaran' => 'Cara Pendaftaran',
            'petunjuk-pendaftaran' => 'Petunjuk Pendaftaran',
        ];
        // $page_title = array_key_exists($slug, $konten) ? $konten[$slug] : $page_title;
        if( array_key_exists('instalasi-aims', $konten) ) {
            return view('website.pages.informasi.petunjuk.instalasi-aims');
        } else {
            return view('website.pages.informasi.konten');
        }


    }

    public function informasi_tag_slug($slug)
    {
        $page_title = $slug;
        SEO::title($page_title)
            ->description($this->description)
            ->keywords($this->keywords)
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl('arrahmahbalikpapan.or.id')
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        return view('website.pages.informasi.tag');
    }


    public function quranic_camp()
    {
        $page_title = 'Quranic Camp 2 | Yayasan Arrahmah';
        SEO::title($page_title)
            ->description('Kegiatan Berkemah bersama keluarga dan teman sekaligus mengkhatamkan 30 juz al-quran')
            ->keywords('camping quran, camping balikpapan, mengaji balikpapan')
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl('arrahmahbalikpapan.or.id')
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        return view('website.pages.kegiatan.quranic-camp');
    }
}
