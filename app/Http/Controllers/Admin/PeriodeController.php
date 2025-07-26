<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;


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
        $item_kategori = \App\Models\PeriodeKategori::select('nama', 'slug')->get();


        return view('dashboard.admin.periode.create', compact('unit', 'item_kategori'));
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
            'slug'                 => Str::slug($request->nama).$request->tahun_ajaran,
            'aktifkan_pendaftaran' => $request->aktifkan_pendaftaran,
            'tahun_ajaran'         => $request->tahun_ajaran,
            'waktu_start'          => $request->waktu_start,
            'waktu_end'            => $request->waktu_end,
            'angkatan'             => $request->angkatan,
            'kategori'             => $request->kategori,

            'form_biodata_daftar'  => json_encode([]),
            'format_nilai'         => json_encode([]),
            'format_rapot'         => json_encode([]),
            'format_absensi'       => json_encode([]),
            'format_pembayaran'    => json_encode([]),
            'notifikasi'           => json_encode([]),
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
        $item_kategori = \App\Models\PeriodeKategori::select('nama', 'slug')->get();

        return view('dashboard.admin.periode.show', compact('unit', 'data_periode', 'item_biaya', 'list_notifikasi', 'item_kategori'));
    }

    public function update(Request $request, $unit, $id)
    {
        $periode = \App\Models\Periode::find($id);

        if ($request->aktifkan_pendaftaran == true) {
            \App\Models\Periode::where('kategori', $request->kategori)
                    ->where('aktifkan_pendaftaran', true)
                    ->update(['aktifkan_pendaftaran' => false])
                    ;
        }

        $periode->update([
            'aktifkan_pendaftaran' => $request->aktifkan_pendaftaran,
            'tahun_ajaran'         => $request->tahun_ajaran,
            'waktu_start'          => $request->waktu_start,
            'waktu_end'            => $request->waktu_end,
            'angkatan'             => $request->angkatan,
            'kategori'             => $request->kategori,
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

        $cacheKey = 'data_statistik_' . $periode;
        $data_statistik = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($periode) {
            $jumlah_peserta = \App\Models\Kelas::where('periode_id', $periode)->count();
            $jumlah_peserta_daftar_baru = \App\Models\Kelas::where('periode_id', $periode)
                                    ->where('status_daftar', 'baru')
                                    ->count();
            $jumlah_peserta_daftar_ulang = \App\Models\Kelas::where('periode_id', $periode)
                                    ->where('status_daftar', 'melanjutkan')
                                    ->count();
            $jumlah_peserta_ujian = \App\Models\Kelas::where('periode_id', $periode)
                                    ->where('status_ujian', 'selesai ujian')
                                    ->count();
            $jumlah_peserta_ikhwan = \App\Models\Kelas::whereHas('peserta', function($q){
                                        $q->where('jenis_peserta', 'ikhwan');
                                    })
                                    ->where('periode_id', $periode)
                                    ->count();
            $jumlah_peserta_akhwat = \App\Models\Kelas::whereHas('peserta', function($q){
                                        $q->where('jenis_peserta', 'akhwat');
                                    })
                                    ->where('periode_id', $periode)
                                    ->count();
            $jumlah_peserta_daftar_baru_ikhwan = \App\Models\Kelas::whereHas('peserta', function($q){
                                        $q->where('jenis_peserta', 'ikhwan');
                                    })
                                    ->where('periode_id', $periode)
                                    ->where('status_daftar', 'baru')
                                    ->count();
            $jumlah_peserta_daftar_ulang_ikhwan = \App\Models\Kelas::whereHas('peserta', function($q){
                                        $q->where('jenis_peserta', 'ikhwan');
                                    })
                                    ->where('periode_id', $periode)
                                    ->where('status_daftar', 'melanjutkan')
                                    ->count();
            $jumlah_peserta_ujian_ikhwan = \App\Models\Kelas::whereHas('peserta', function($q){
                                        $q->where('jenis_peserta', 'ikhwan');
                                    })
                                    ->where('periode_id', $periode)
                                    ->where('status_ujian', 'selesai ujian')
                                    ->count();
            $jumlah_peserta_daftar_baru_akhwat = \App\Models\Kelas::whereHas('peserta', function($q){
                                        $q->where('jenis_peserta', 'akhwat');
                                    })
                                    ->where('periode_id', $periode)
                                    ->where('status_daftar', 'baru')
                                    ->count();
            $jumlah_peserta_daftar_ulang_akhwat = \App\Models\Kelas::whereHas('peserta', function($q){
                                        $q->where('jenis_peserta', 'akhwat');
                                    })
                                    ->where('periode_id', $periode)
                                    ->where('status_daftar', 'melanjutkan')
                                    ->count();
            $jumlah_peserta_ujian_akhwat = \App\Models\Kelas::whereHas('peserta', function($q){
                                        $q->where('jenis_peserta', 'akhwat');
                                    })
                                    ->where('periode_id', $periode)
                                    ->where('status_ujian', 'selesai ujian')
                                    ->count();
            return [
                'jumlah_peserta' => $jumlah_peserta,
                'jumlah_peserta_daftar_baru' => $jumlah_peserta_daftar_baru,
                'jumlah_peserta_daftar_ulang' => $jumlah_peserta_daftar_ulang,
                'jumlah_peserta_ujian' => $jumlah_peserta_ujian,
                'jumlah_peserta_ikhwan' => $jumlah_peserta_ikhwan,
                'jumlah_peserta_akhwat' => $jumlah_peserta_akhwat,
                'jumlah_peserta_daftar_baru_ikhwan' => $jumlah_peserta_daftar_baru_ikhwan,
                'jumlah_peserta_daftar_ulang_ikhwan' => $jumlah_peserta_daftar_ulang_ikhwan,
                'jumlah_peserta_ujian_ikhwan' => $jumlah_peserta_ujian_ikhwan,
                'jumlah_peserta_daftar_baru_akhwat' => $jumlah_peserta_daftar_baru_akhwat,
                'jumlah_peserta_daftar_ulang_akhwat' => $jumlah_peserta_daftar_ulang_akhwat,
                'jumlah_peserta_ujian_akhwat' => $jumlah_peserta_ujian_akhwat
            ];
        });





        return view('dashboard.admin.periode.statistik', compact('unit', 'periode', 'dataperiode', 'data_statistik'));
    }

    public function getTahsinDashboardChartData1()
    {
        return response()->json([
            'labels' => \App\Models\Periode::pluck('nama')->toArray(),
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
