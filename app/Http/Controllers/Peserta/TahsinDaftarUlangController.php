<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\ConvertNotifikasi;
use ProtoneMedia\Splade\Facades\SEO;
use Illuminate\Support\Str;



class TahsinDaftarUlangController extends Controller
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

    public function index()
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

        $data_peserta = \App\Models\Kelas::whereHas('peserta', function($query) {
                        $query->where('user_id', Auth::user()->id);
                    })
                    ->latest()
                    ->paginate(10);
        $data_periode =  \App\Models\Periode::
                        where('kategori', 'reguler')
                            ->whereHas('unit', function($query) {
                                $query->where('slug', 'tahsin');
                            })
                        ->where('aktifkan_pendaftaran',1)
                        // ->latest()
                        ->first();
        if (!$data_periode) {
                Toast::title('Pendaftaran Ulang Sedang Ditutup.')
                    ->warning()
                    ->autoDismiss(10);
                return redirect()->route('dashboard.peserta.data');
        }
        $data_level =  \App\Models\Modules\Level::get()->mapWithKeys(function ($item) {
                return [$item->id => $item->nama];
            })
            ->toArray();

        return view('dashboard.peserta.lttq.tahsin.daftar-ulang-pilih-peserta', compact('data_peserta', 'data_periode', 'data_level'));
    }

    public function form($peserta)
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

        $data_peserta = \App\Models\Kelas::where('uuid',$peserta)->first();

        // $data_peserta = \App\Models\Kelas::whereHas('peserta', function($query) {
        //                 $query->where('user_id', Auth::user()->id);
        //             })
        //             ->latest()
        //             ->paginate(10);

        $data_periode =  \App\Models\Periode::
                        where('kategori', 'reguler')
                            ->whereHas('unit', function($query) {
                                $query->where('slug', 'tahsin');
                            })
                        ->where('aktifkan_pendaftaran',1)
                        // ->latest()
                        ->first();

        if (!$data_periode) {
                Toast::title('Pendaftaran Ulang Sedang Ditutup.')
                    ->warning()
                    ->autoDismiss(10);
                return redirect()->route('dashboard.peserta.data');
        }

        $data_biaya = \App\Models\Biaya::where('periode_id', $data_periode->id)->get();


        $data_jadwal = \App\Models\Jadwal::whereHas('level', function ($query) use ($data_peserta) {
                                $query->where('id', $data_peserta->data_nilai['ujian'] ?? '');
                            })
                    ->whereRaw('LOWER(jenis_peserta) = ?', strtolower($data_peserta->peserta->jenis_peserta))
                    ->where('periode_id', $data_periode->id)
                    ->get();

        $data_jumlah_jadwal =  $data_jadwal->mapWithKeys(function ($item) {
                return [$item->id => $item->kelas->count()];
            })
            ->toArray();
        $data_level =  \App\Models\Modules\Level::get()->mapWithKeys(function ($item) {
                return [$item->id => $item->nama];
            })
            ->toArray();

        $data_peserta_sudah_daftar = \App\Models\Kelas::where('periode_id', $data_periode->id)
                                        ->where('peserta_id', $data_peserta->peserta_id)
                                        ->with('jadwal')
                                        ->first();
        // dd($data_level);


        return view('dashboard.peserta.lttq.tahsin.daftar-ulang-form', compact('peserta', 'data_level', 'data_jadwal', 'data_jumlah_jadwal', 'data_peserta', 'data_periode', 'data_biaya', 'data_peserta_sudah_daftar'));
    }

    public function form_store($peserta, Request $request)
    {
        $data_jadwal = \App\Models\Jadwal::findOrFail($request->input('jadwal'));
        $data_peserta_kelas_lama = \App\Models\Kelas::where('uuid', $peserta)->first();

        if($data_peserta_kelas_lama->status_daftar_ulang == 'selesai daftar ulang')   {
            Toast::title('Peserta sudah melakukan daftar ulang.')
                ->warning()
                ->autoDismiss(10);
            return redirect()->back();
        }

        $data_peserta_kelas_lama->status_daftar_ulang = 'selesai daftar ulang';

        $periode = \App\Models\Periode::
                        where('kategori', 'reguler')
                            ->whereHas('unit', function($query) {
                                $query->where('slug', 'tahsin');
                            })
                        ->where('aktifkan_pendaftaran',1)
                        // ->latest()
                        ->first();
        if (!$periode) {
                Toast::title('Pendaftaran Ulang Sedang Ditutup. Silahkan Hubungi Admin.')
                    ->warning()
                    ->autoDismiss(10);
                return redirect()->back();
        }

        $data_biaya = \App\Models\Biaya::where('periode_id', $periode->id)->get();

        $donasi = 0;
        $pembayarandonasi = $request->input('pembayarandonasi') ? $request->input('pembayarandonasi') : 0;
        $pembayarandonasicustom = $request->input('pembayarandonasicustom') ? $request->input('pembayarandonasicustom') : 0;

        $donasi = $pembayarandonasi > 0 ? $pembayarandonasi : $pembayarandonasicustom;
        $user = Auth::user();
        $nomor_wa = $user->phone_code.ltrim($user->phone_number, '0');

        $uuid_kelas_baru = Str::uuid();

        if ($periode) {

            try {
                DB::beginTransaction();

                $lock_peserta = \App\Models\Peserta::lockForUpdate()->latest()->first();
                $lock_kelas = \App\Models\Kelas::lockForUpdate()->latest()->first();

                if($data_jadwal->kelas->count() < $data_jadwal->batasan_peserta) {

                    $data_peserta_kelas_baru = \App\Models\Kelas::create([
                        'periode_id'          => $periode->id,
                        'peserta_id'          => $data_peserta_kelas_lama->peserta_id,
                        'jadwal_id'           => $request->input('jadwal'),
                        'uuid'                => $uuid_kelas_baru,
                        'nis_peserta'         => $data_peserta_kelas_lama->nis_peserta,
                        'kode_unik'           => $data_peserta_kelas_lama->kode_unik,
                        'status_domisili'     => $data_peserta_kelas_lama->status_domisili,
                        'status_daftar'       => 'melanjutkan',
                        'status_pendaftaran'  => 'selesai pilih jadwal',
                        'status_aktif'        => 'aktif',
                        'status_ujian'        => 'belum ujian',
                        'status_daftar_ulang' => 'belum daftar ulang',
                        'status_penerimaan'   => $data_peserta_kelas_lama->status_penerimaan ?? 'umum',
                    ]);

                    $data_peserta_kelas_lama->update([
                        'status_daftar_ulang' => 'selesai daftar ulang',
                    ]);

                    $uuid_transaksi = Str::uuid();
                    $transaksi = \App\Models\Transaksi::create([
                        'uuid'                     => $uuid_transaksi,
                        'periode_id'               => $periode->id,
                        'kelas_id'                 => $data_peserta_kelas_baru->id,
                        'peserta_id'               => $data_peserta_kelas_baru->peserta_id,
                        'user_id'                  => $user->id,
                        'donasi'                   => $donasi,
                        'kode_unik'                => $data_peserta_kelas_lama->kode_unik,
                    ]);

                    $total_nominal = 0;
                    $total_nominal_pembayaran = 0;
                    foreach($data_biaya as $item_biaya) {
                        if($item_biaya->wajib_dibayar_awal == true || $item_biaya->id == $request->input('pembayaran'.$item_biaya->id)){
                            $data_pembayaran_peserta = \App\Models\Pembayaran::create([
                                'periode_id'   => $periode->id,
                                'transaksi_id' => $transaksi->id,
                                'biaya_id'     => $item_biaya->id,
                                'nominal'      => $item_biaya->nominal,
                                'kelas_id'     => $data_peserta_kelas_baru->id
                            ]);
                            $total_nominal += $item_biaya->nominal;
                        }
                    }
                    $total_nominal_pembayaran = $total_nominal + $data_peserta_kelas_lama->kode_unik + $donasi;

                    $transaksi->update([
                        'nominal_total' => $total_nominal,
                        'nominal_total_pembayaran' => $total_nominal_pembayaran
                    ]);


                    $data_notifikasi = \App\Models\Notifikasi::where('slug', 'daftar-ulang')
                                    ->where('unit_id',1)
                                    ->first();

                    try {
                        $isi_notif_wa = $this->formatWhatsappPesertaKelasDanTransaksi($data_notifikasi->pesan_whatsapp,  $data_peserta_kelas_baru->id, $transaksi->id);
                        $this->notifService->kirimNotifWa($nomor_wa, $isi_notif_wa);
                    }
                    catch (\Exception $e)
                    {
                        //log error but don't interrupt the main process
                        // \Log::error('Failed to create notification: '.$e->getMessage());
                    }


                    Toast::title('Daftar Ulang Berhasil')
                        ->autoDismiss(10);
                    Toast::title('Segera Lakukan Pembayaran. Terima Kasih')
                        ->warning()
                        ->autoDismiss(10);

                    DB::commit();
                } else {
                    DB::rollBack();
                    Toast::warning('Maaf, Jadwal sudah penuh');
                    return redirect()->back();
                }

            } catch (\Exception $e) {
                DB::rollBack();
                Toast::title('Terjadi Kesalahan. Bisa jadi mengalami gangguan jaringan internet. Mohon Ulangi.')
                    ->warning()
                    ->autoDismiss(10);
                Toast::title('Jika kesalahan berulang, gunakan perangkat lain atau hubungin admin.')
                    ->warning()
                    ->autoDismiss(10);
                return redirect()->back();
                // return $e;
            }

            return redirect()->route('website.lttq.invoice', ['uuid' => $uuid_transaksi]);
        } else {
            return redirect()->route('website.lttq.tahsin.pendaftaran-gagal');
        }
    }
}
