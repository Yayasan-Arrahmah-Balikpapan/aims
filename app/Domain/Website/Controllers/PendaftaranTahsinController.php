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
use App\Traits\ConvertNotifikasi;
use Throwable;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class PendaftaranTahsinController extends Controller
{
    use ConvertNotifikasi;
    public $description, $keywords, $sitename;
    private $notifService;
    public function __construct( \App\Contracts\NotificationService $notifService)
    {
        $this->description = 'Yayasan Arrahmah Balikpapan. Pusat Belajar Tahsin Tahfizh Di Kota Balikpapan. Belajar Mengaji Al-Quran Secara Terstruktur.';
        $this->keywords = 'Belajar Ngaji, Tahsin, Tahfizh, Balikpapan';
        $this->sitename = 'Pendidikan Al-quran Kota Balikpapan';

        $this->notifService = $notifService;
    }

    public function tahsin_pendaftaran()
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


        $uuid = Str::uuid();
        session()->put('pendaftaran.tahsin.uuid', $uuid);

        $json = Storage::disk('public')->get('/data/daerah-indonesia.json');
        $dataindo = json_decode($json, true);

        $ayat = [
            "وَلَوْ جَعَلْنَٰهُ قُرْءَانًا أَعْجَمِيًّۭا لَّقَالُوا۟ لَوْلَا فُصِّلَتْ ءَايَٰتُهُۥٓ ۖ ءَا۬عْجَمِىٌّۭ وَعَرَبِىٌّۭ ۗ قُلْ هُوَ لِلَّذِينَ ءَامَنُوا۟ هُدًۭى وَشِفَآءٌۭ ۖ وَٱلَّذِينَ لَا يُؤْمِنُونَ فِىٓ ءَاذَانِهِمْ وَقْرٌۭ وَهُوَ عَلَيْهِمْ عَمًى ۚ أُو۟لَٰٓئِكَ يُنَادَوْنَ مِن مَّكَانٍۭ بَعِيدٍۢ",
            "وَلَقَدْ ءَاتَيْنَا مُوسَى ٱلْكِتَٰبَ فَٱخْتُلِفَ فِيهِ ۗ وَلَوْلَا كَلِمَةٌۭ سَبَقَتْ مِن رَّبِّكَ لَقُضِىَ بَيْنَهُمْ ۚ وَإِنَّهُمْ لَفِى شَكٍّۢ مِّنْهُ مُرِيبٍۢ",
            "مَّنْ عَمِلَ صَٰلِحًۭا فَلِنَفْسِهِۦ ۖ وَمَنْ أَسَآءَ فَعَلَيْهَا ۗ وَمَا رَبُّكَ بِظَلَّٰمٍۢ لِّلْعَبِيدِ",
        ];

        $periode = Periode::where('aktifkan_pendaftaran',1)
                        ->where('kategori', 'reguler')
                            ->whereHas('unit', function($query) {
                                $query->where('slug', 'tahsin');
                            })
                        ->first();

        if ($periode) {
            $data_biaya = \App\Models\Biaya::where('periode_id', $periode->id)->get();

            return view('website.pages.lttq.tahsin.pendaftaran', compact('dataindo', 'ayat', 'periode', 'data_biaya'));
        } else {
            return view('website.pages.lttq.tahsin.pendaftaran-tutup');
        }
    }

    public function tahsin_pendaftaran_store(Request $request)
    {
        // dd($request->all());
        $periode = Periode::where('aktifkan_pendaftaran',1)
                        ->where('kategori', 'reguler')
                            ->whereHas('unit', function($query) {
                                $query->where('slug', 'tahsin');
                            })
                        ->first();
        $data_biaya = \App\Models\Biaya::where('periode_id', $periode->id)->get();

        $donasi = 0;
        $pembayarandonasi = $request->input('pembayarandonasi') ? $request->input('pembayarandonasi') : 0;
        $pembayarandonasicustom = $request->input('pembayarandonasicustom') ? $request->input('pembayarandonasicustom') : 0;

        if ($periode) {

            $donasi = $pembayarandonasi > 0 ? $pembayarandonasi : $pembayarandonasicustom;

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

            if (!Auth::check()) {
                Auth::login($user);
            }

            $nomor_wa = $user->phone_code.ltrim($user->phone_number, '0');

            $peserta = Peserta::where('uuid', $uuid)->first();
            $peserta_kelas = Kelas::where('uuid', $uuid)->first();

            if ($peserta) {
                Toast::title('Terjadi Kesalahan. Mohon Ulangi !')
                    ->warning()
                    ->autoDismiss(10);
                return redirect()->back();
            }

            if(!$peserta) {
                try {
                    DB::beginTransaction();

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
                                'ktp'           => $ktp,
                                'rekaman'       => $rekaman,
                        ],
                    ]);

                    $hitung_data_peserta = Kelas::where('periode_id', $periode->id)
                                                ->where('status_daftar', 'baru')
                                                ->count();
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
                        'nis_peserta'         => $nis_peserta,
                        'kode_unik'           => $hitung_data_peserta + 1,
                        'uuid'                => $uuid,
                        'status_daftar'       => 'baru',
                        'status_pendaftaran'  => 'belum diberikan level',
                        'status_aktif'        => 'diproses',
                        'status_uji'          => 'belum ujian',
                        'status_daftar_ulang' => 'belum daftar ulang',
                        'status_penerimaan'   => 'umum',
                        'status_domisili'     => $domisili,
                        'data_nilai'          => [
                                                    'rekaman-daftar-baru' => $rekaman,
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

                    $data_notifikasi = \App\Models\Notifikasi::where('slug', 'pendaftaran-baru')
                                    ->where('unit_id',1)
                                    ->first();

                    $isi_notif_wa = $this->formatWhatsappPesertaKelasDanTransaksi($data_notifikasi->pesan_whatsapp, $peserta_kelas->id, $transaksi->id);
                    $this->notifService->kirimNotifWa($nomor_wa, $isi_notif_wa);

                    Toast::title('Pendaftaran Berhasil')
                        ->autoDismiss(10);
                    Toast::title('Segera Lakukan Pembayaran. Terima Kasih')
                        ->warning()
                        ->autoDismiss(10);

                    DB::commit();
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
            return redirect()->route('website.lttq.tahsin.pendaftaran-gagal');
        }
    }

    public function tahsin_pendaftaran_store_ktp(Request $request)
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

    public function tahsin_pendaftaran_store_rekaman(Request $request)
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

    public function tahsin_pendaftaran_berhasil(Request $request)
    {
        return view('website.pages.lttq.tahsin.pendaftaran-berhasil');
    }

    public function tahsin_pendaftaran_gagal(Request $request)
    {
        return view('website.pages.lttq.tahsin.pendaftaran-gagal');
    }
}
