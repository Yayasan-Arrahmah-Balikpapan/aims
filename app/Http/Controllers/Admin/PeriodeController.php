<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Str;


class PeriodeController extends Controller
{
    public function index($unit)
    {
        // if($unit == 'tahsin') {
        //     $periode = PeriodeTahsin::class;
        // } else {
        //     $periode = TablePeriode::class;
        // }

        $periode = \App\Models\Periode::whereHas('unit', function($query) use ($unit) {
                                $query->where('slug', $unit);
                            })
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        return view('dashboard.admin.periode.index', compact('unit', 'periode'));
    }

    public function create($unit)
    {
        return view('dashboard.admin.periode.create', compact('unit'));
    }

    public function store(Request $request, $unit)
    {

        $d_unit = \App\Models\Modules\Unit::where('slug', $unit)->first();

        if($request->aktifkan_pendaftaran == 1) {
            \App\Models\Periode::where('unit_id', $d_unit->id)->update(['aktifkan_pendaftaran' => 0]);
        }


        $periode = \App\Models\Periode::create([
            'unit_id'              => $d_unit->id,
            'nama'                 => $request->nama,
            'slug'                 => Str::slug($request->nama),
            'aktifkan_pendaftaran' => $request->aktifkan_pendaftaran,
            'tahun_ajaran'         => $request->tahun_ajaran,
            'waktu_start'          => $request->waktu_start,
            'waktu_end'            => $request->waktu_end,
            'angkatan'             => $request->angkatan,

            'form_biodata_daftar'  => json_encode([]),
            'format_nilai'         => json_encode([]),
            'format_rapot'         => json_encode([]),
            'format_absensi'       => json_encode([
                                            [
                                                '1' => '',
                                                '2' => '',
                                                '3' => '',
                                                '4' => '',
                                                '5' => '',
                                                '6' => '',
                                                '7' => '',
                                                '8' => '',
                                                '9' => '',
                                                '10' => '',
                                                '11' => '',
                                                '12' => '',
                                                '13' => '',
                                                '14' => '',
                                                '15' => '',
                                                '16' => '',
                                            ],
                                        ]),
            'format_pembayaran'    => json_encode([
                                            ['name' => 'pendaftaran', 'label' => 'PENDAFTARAN', 'value' => 100000, 'disabled' => false, 'checked' => false, 'required' => true],
                                            ['name' => 'spp1', 'label' => 'SPP BULAN I', 'value' => 100000, 'disabled' => false, 'checked' => false, 'required' => true],
                                            ['name' => 'spp2', 'label' => 'SPP BULAN II', 'value' => 100000, 'disabled' => false, 'checked' => false, 'required' => true],
                                            ['name' => 'spp3', 'label' => 'SPP BULAN III', 'value' => 100000, 'disabled' => false, 'checked' => false, 'required' => false],
                                            ['name' => 'spp4', 'label' => 'SPP BULAN IV', 'value' => 100000, 'disabled' => false, 'checked' => false, 'required' => false],
                                        ]),
            'notifikasi'    => json_encode([[
                                                'pendaftaran' => 'Assalamualaikum Warrohmarullah Wabarokatuh

Terima kasih telah mendaftarkan diri sebagai *Calon Peserta Tahsin Baru di angkatan 25*.

Anda akan kami hubungi kembali secara otomatis melalui pesan WhatsApp setelah hasil bacaan Al Qur\'an dikoreksi oleh tim penguji kami beserta konfirmasi transfer pembayaran.

Silahkan akses ke dalam dashbboard sistem kami menggunakan nomor yang telah terdaftar
https://arrahmahbalikpapan.or.id/akses

Syukron, Jazaakumullah Khoiron Katsiron,
Wassalamualaikum warahmatullahi wabarakatuh.

Salam,
Panitia Pendaftaran Baru
Tahsin Ar Rahmah Balikpapan',
                                                'penempatan-level' => '',
                                                'pembayaran-spp' => ''
        ]]),

        ]);


        Toast::title('Data Berhasil Ditambahkan');
        return redirect()->route('admin.periode.index', $unit);
    }

    public function show($unit, $periode)
    {
        $data_periode = \App\Models\Periode::find($periode);
        $item_biaya = \App\Models\Biaya::where('periode_id', $periode)->get();
        $list_notifikasi = \App\Models\Notifikasi::whereHas('unit', function($query) use ($unit) {
                        $query->where('slug', $unit);
                    })->orderBy('id', 'asc')->get();

        return view('dashboard.admin.periode.show', compact('unit', 'data_periode', 'item_biaya', 'list_notifikasi'));
    }

    public function update(Request $request, $unit, $id)
    {
        $periode = \App\Models\Periode::find($id);

        if ($request->aktifkan_pendaftaran == true) {
            \App\Models\Periode::where('aktifkan_pendaftaran', true)->update(['aktifkan_pendaftaran' => false]);
        }

        $periode->update([
            'aktifkan_pendaftaran' => $request->aktifkan_pendaftaran,
            'tahun_ajaran'         => $request->tahun_ajaran,
            'waktu_start'          => $request->waktu_start,
            'waktu_end'            => $request->waktu_end,
            'angkatan'             => $request->angkatan,
        ]);

        Toast::title('Data Berhasil Diupdate');
        return redirect()->route('admin.periode.index', $unit);
    }

    public function notifikasi($unit, $periode, $notifikasi)
    {
        $data_periode = \App\Models\Periode::find($periode);
        $notifikasi = \App\Models\Notifikasi::whereHas('unit', function($query) use ($unit) {
                        $query->where('slug', $unit);
                    })->where('slug', $notifikasi)->first();

        return view('dashboard.admin.periode.notifikasi', compact('unit', 'data_periode','periode', 'notifikasi'));
    }

    public function notifikasi_update(Request $request, $unit, $periode, $notifikasi)
    {
        $notifikasi = \App\Models\Notifikasi::whereHas('unit', function($query) use ($unit) {
                        $query->where('slug', $unit);
                    })->where('slug', $notifikasi)->first();

        $notifikasi->update([
            'pesan_whatsapp' => $request->pesan,
        ]);

        Toast::title('Pesan Berhasil Diupdate');
        return redirect()->back();
    }

    public function destroy($unit, $id)
    {
        // Logika untuk menghapus data berdasarkan ID
    }

     public function biaya_store($unit, $periode, Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'wajib_dibayar_awal' => 'required|boolean',
            'wajib_dibayar_oleh' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        \App\Models\Biaya::create([
            'periode_id' => $periode,
            'nama' => strtoupper($request->nama),
            'nominal' => $request->nominal,
            'wajib_dibayar_awal' => $request->wajib_dibayar_awal,
            'wajib_dibayar_oleh' => $request->wajib_dibayar_oleh,
            'status_dicicil' => $request->status_dicicil,
            'keterangan' => $request->keterangan,
            'slug' => Str::slug($request->nama),
        ]);

        Toast::title('Biaya Berhasil Ditambahkan');
        return redirect()->back();
    }
    public function biaya_daftar_store($unit, $periode, Request $request)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:0',
        ]);

        \App\Models\Biaya::create([
            'periode_id' => $periode,
            'nama' => 'DAFTAR',
            'nominal' => $request->nominal,
            'wajib_dibayar_awal' => 1,
            'status_dicicil' => 0,
            'wajib_dibayar_oleh' => $request->wajib_dibayar_oleh,
            'slug' => 'daftar',
        ]);

        Toast::title('Item Biaya Daftar Berhasil Ditambahkan');
        return redirect()->back();
    }

    public function biaya_destroy($unit, $periode, $id)
    {
        // Logika untuk menghapus data berdasarkan ID
        try {
            $biaya = \App\Models\Biaya::find($id);
            if ($biaya->pembayaran->count() > 0) {
                Toast::warnig('Biaya ini tidak bisa dihapus karena sudah ada pembayaran, Gagal Dihapus');
                return redirect()->back();
            }
            $biaya->delete();
            Toast::title('Item Biaya Berhasil Dihapus');
        } catch (\Exception $e) {
            Toast::warning('Item Biaya Gagal Dihapus');
        }
        return redirect()->back();
    }

    public function statistik($unit, $periode)
    {
        $dataperiode = \App\Models\Periode::find($periode);
        return view('dashboard.admin.periode.statistik', compact('unit', 'periode', 'dataperiode'));
    }

    public function getTahsinDashboardChartData1()
    {
        return response()->json([
            'labels' => ['16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26'],
            'datasets' => [
                [
                    'label' => 'Jumlah Peserta Aktif',
                    'data' => [1634, 1427, 1353, 1167, 1116, 933, 796, 806, 763, 767, 645],
                ],
                [
                    'label' => 'Daftar Ulang',
                    'data' => [0, 1195, 1051, 943, 873, 760, 649, 559, 567, 542, 525],
                ],
                [
                    'label' => 'Daftar Baru',
                    'data' => [1634, 238, 226, 251, 102, 74, 250, 207, 76, 239, 124],
                ],
                [
                    'label' => 'Ikhwan',
                    'data' => [84, 110, 69, 64, 66, 102, 74, 61, 76, 52, 0],
                ],
                [
                    'label' => 'Akhwat',
                    'data' => [1550, 1317, 1284, 1103, 1050, 831, 722, 745, 687, 715, 645],
                ],
                [
                    'label' => 'Al-Haq',
                    'data' => [84, 110, 69, 64, 66, 102, 74, 61, 76, 52, 0],
                ]
            ]
        ]);
    }

    public function getTahsinDashboardChartData2()
    {
        return response()->json([
            'labels' => ['Laki-laki', 'Perempuan'],
            'values' => [530, 120],
        ]);
    }



}
