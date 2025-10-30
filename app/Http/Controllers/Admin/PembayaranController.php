<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tables\PembayaranTahsin;
use Illuminate\Support\Facades\Cache;
use App\Traits\TableTrait;
use App\Traits\FilterTable1Trait;
use App\Models\Kelas;
use ProtoneMedia\Splade\Facades\Toast;



class PembayaranController extends Controller
{
    // use TableTrait;
    use FilterTable1Trait;
    public function index_b(Request $request, $unit)
    {
        // $columns = [
        //     ['key' => 'id', 'label' => 'ID', 'filter' => true],
        //     ['key' => 'peserta.nama', 'label' => 'Peserta Name', 'filter' => true],
        //     ['key' => 'periode.nama', 'label' => 'Periode Name', 'filter' => true],
        //     // ['key' => 'unit.nama', 'label' => 'Unit Name', 'filter' => true],
        //     // ['key' => 'jadwal.nama', 'label' => 'Jadwal Name', 'filter' => true],
        //     // ['key' => 'pengajar.nama', 'label' => 'Pengajar Name', 'filter' => true],
        //     // ['key' => 'json.data_pembayaran.pendaftaran', 'label' => 'Payment Registration Status', 'filter' => true],
        //     // ['key' => 'json.data_absen.1', 'label' => 'Attendance Status', 'filter' => true],
        //     // ['key' => 'json.data_nilai.ujian', 'label' => 'Exam Status', 'filter' => true],
        //     ['key' => 'created_at', 'label' => 'Created At', 'filter' => true, 'filter_type' => 'date_range'],
        // ];

        // $filters = [];
        // foreach ($columns as $column) {
        //     if (isset($column['filter']) && $column['filter']) {
        //         $key = $column['key'];
        //         if (isset($column['filter_type']) && $column['filter_type'] === 'date_range') {
        //             $filters[$key] = [
        //                 'start' => $request->get('filter.' . $key . '.start', ''),
        //                 'end' => $request->get('filter.' . $key . '.end', ''),
        //             ];
        //         } else {
        //             $filters[$key] = $request->get('filter.' . $key, '');
        //         }
        //     }
        // }

        // $relations = [
        //     'peserta',
        //     'periode',
        //     'periode.unit',
        //     'jadwal',
        //     'jadwal.pengajar'
        // ];

        // $model = new Kelas;
        // $kelas = $this->getFilteredData($model, $filters, $columns, $relations);

        // $rows = $this->prepareRows($kelas, $columns);

        // $baseDetailUrl = '#';

        // return view('modules.pembayaran.index', [
        //     'columns' => $columns,
        //     'rows' => $rows,
        //     'baseDetailUrl' => $baseDetailUrl
        // ]);

        // $pembayaran = PembayaranTahsin::class;
        // return view('modules.pembayaran.index', compact('unit', 'pembayaran'));

        $tableConfig = [
            'columns' => [
                'peserta_id' => [
                    'label' => 'ID Peserta',
                    'type' => 'text',
                ],
                'nama_peserta' => [
                    'label' => 'Nama Peserta',
                    'type' => 'relation',
                    'relation' => 'peserta.nama',
                ],
                'jenis_peserta' => [
                    'label' => 'Jenis Kelamin',
                    'type' => 'dropdown',
                    'relation' => 'peserta.jenis_peserta',
                    'options' => [
                        'laki-laki' => 'Laki-laki',
                        'perempuan' => 'Perempuan',
                    ],
                ],
                'data_pembayaran' => [
                    'label' => 'Pendaftaran',
                    'type' => 'json',
                    'json_key' => 'pendaftaran',
                ],
                'data_nilai' => [
                    'label' => 'Ujian',
                    'type' => 'json',
                    'json_key' => 'ujian',
                ],
                'data_absensi' => [
                    'label' => 'Absensi',
                    'type' => 'json',
                    'json_key' => '1',
                ],
                'nama_unit' => [
                    'label' => 'Nama Unit',
                    'type' => 'relation',
                    'relation' => 'periode.unit.nama',
                ],
                'pengajar_nama' => [
                    'label' => 'Nama Pengajar',
                    'type' => 'relation',
                    'relation' => 'jadwal.pengajar.nama',
                ],
                'created_at' => [
                    'label' => 'Tanggal',
                    'type' => 'range',
                ],
            ]
        ];

        $query = Kelas::with(['peserta', 'periode.unit', 'jadwal.pengajar']);

        // Terapkan filter dinamis menggunakan trait
        $query = $this->applyFilters($query, $request, $tableConfig['columns']);

        $kelas = $query->paginate(10);

        return view('modules.pembayaran.data', compact('kelas', 'tableConfig', 'unit'));
    }

    public function export(Request $request)
    {
        $columns = [
            ['key' => 'id', 'label' => 'ID', 'filter' => true],
            ['key' => 'peserta.nama', 'label' => 'Peserta Name', 'filter' => true],
            ['key' => 'periode.nama', 'label' => 'Periode Name', 'filter' => true],
            // ['key' => 'unit.nama', 'label' => 'Unit Name', 'filter' => true],
            // ['key' => 'jadwal.nama', 'label' => 'Jadwal Name', 'filter' => true],
            // ['key' => 'pengajar.nama', 'label' => 'Pengajar Name', 'filter' => true],
            ['key' => 'json.data_pembayaran.pendaftaran', 'label' => 'Payment Registration Status', 'filter' => true],
            ['key' => 'json.data_absen.1', 'label' => 'Attendance Status', 'filter' => true],
            ['key' => 'json.data_nilai.ujian', 'label' => 'Exam Status', 'filter' => true],
            ['key' => 'created_at', 'label' => 'Created At', 'filter' => true, 'filter_type' => 'date_range'],
        ];

        $filters = [];
        foreach ($columns as $column) {
            if (isset($column['filter']) && $column['filter']) {
                $key = $column['key'];
                if (isset($column['filter_type']) && $column['filter_type'] === 'date_range') {
                    $filters[$key] = [
                        'start' => $request->get('filter.' . $key . '.start', ''),
                        'end' => $request->get('filter.' . $key . '.end', ''),
                    ];
                } else {
                    $filters[$key] = $request->get('filter.' . $key, '');
                }
            }
        }

        // return $this->exportToExcel($filters, KelasExport::class, 'kelas.xlsx');
    }

    private function getPembayaranRekapTable($unit)
    {
        return match ($unit) {
            'tahsin' => new \App\Tables\Admin\TahsinPembayaranRekap(),
            default => new \App\Tables\Admin\TahsinPembayaranRekap(),
        };
    }

    private function getPembayaranTransaksiTable($unit)
    {
        return match ($unit) {
            'tahsin' => new \App\Tables\Admin\TahsinPembayaranTransaksi(),
            default => new \App\Tables\Admin\TahsinPembayaranTransaksi(),
        };
    }
    public function index($unit, $periode, Request $request)
    {
        $table = $this->getPembayaranRekapTable($unit);
        $dataperiode = \App\Models\Periode::find( $periode);
        $data_level = \App\Models\Modules\Level::where('unit_id', $dataperiode->unit_id)->get();
        $data_biaya = \App\Models\Biaya::where('periode_id', $dataperiode->id)->get();
        $data_peserta = Kelas::where('periode_id', $periode)
                            // ->when($request->has('search'), function($q) use ($request) {
                            //     $search = $request->search;
                            //     $q->whereHas('peserta', function($q) use ($search) {
                            //         $q->where('nis', 'like', "%{$search}%")
                            //             ->orWhere('nama', 'like', "%{$search}%");
                            //     });
                            // })
                            ->cari(request()->query('cari'))
                            ->jenisPeserta(request()->query('jenis_peserta'))
                            ->statusDaftarPeserta(request()->query('peserta'))
                            ->statusPendaftaran(request()->query('status'))
                            ->cariLevel(request()->query('level'))
                            ->latest()
                            ->paginate(10);
        $data_biaya_id = $data_biaya->pluck('id');
        $data_peserta_id = $data_peserta->pluck('id');
        $data_pembayaran_peserta = \App\Models\Pembayaran::whereIn('kelas_id', $data_peserta_id)
                                ->whereHas('transaksi', function($q) {
                                    $q->where('status', 3);
                                })
                                ->select('kelas_id', 'biaya_id', 'nominal')
                                ->get()
                                ->groupBy('kelas_id')
                                ->map(function ($items, $kelas_id) {
                                    return $items->mapWithKeys(function ($item) {
                                        return [$item->biaya_id => $item->nominal];
                                    });
                                })
                                ->toArray();
        $data_transaksi_peserta = \App\Models\Transaksi::whereIn('kelas_id', $data_peserta_id)
                                ->where('status', 3)
                                ->get()
                                ->groupBy('kelas_id')
                                ->map(function ($items, $kelas_id) {
                                    return $items->mapWithKeys(function ($item) {
                                        return [
                                                'potongan' => $item->potongan,
                                                'donasi' => $item->donasi,
                                                'nominal_total' => $item->nominal_total,
                                                'nominal_total_pembayaran' => $item->nominal_total_pembayaran
                                                ];
                                    });
                                })
                                ->toArray();
                                // dd($data_transaksi_peserta);
        
        $jumlah_nominal_transfer = \App\Models\Transaksi::where('periode_id', $dataperiode->id)
                                ->where('status', 3)
                                ->sum('nominal_total_pembayaran');
        $jumlah_nominal_bruto = \App\Models\Transaksi::where('periode_id', $dataperiode->id)
                                ->where('status', 3)
                                ->sum('nominal_total');
        $jumlah_nominal_donasi = \App\Models\Transaksi::where('periode_id', $dataperiode->id)
                                ->where('status', 3)
                                ->sum('donasi');
        $jumlah_nominal_potongan = \App\Models\Transaksi::where('periode_id', $dataperiode->id)
                                ->where('status', 3)
                                ->sum('potongan');

        $cache_biaya = 'cache_sum_biaya_periode_' . $periode;
        $cache_expiration_key = $cache_biaya . '_expiration';

        if (Cache::has($cache_biaya)) {
            $sum_data_biaya = Cache::get($cache_biaya);
        } else {
            $sum_data_biaya = [];  // Inisialisasi sebagai array kosong

            foreach ($data_biaya as $biaya) {
                $sum_data_biaya[$biaya->id] = \App\Models\Pembayaran::where('periode_id', $periode)
                                            ->where('biaya_id', $biaya->id)
                                            ->whereHas('transaksi', function($q) {
                                                $q->where('status', 3);
                                            })
                                            ->sum('nominal');
            }

            // Simpan ke cache dengan durasi
            Cache::put($cache_biaya, $sum_data_biaya, now()->addDays(7));

            // Simpan waktu kedaluwarsa cache secara manual
            Cache::put($cache_expiration_key, now()->addDays(7), now()->addDays(7));
        }

        // Mengambil waktu kedaluwarsa cache
        $expiration_time = Cache::get($cache_expiration_key) ? \Carbon\Carbon::parse(Cache::get($cache_expiration_key))->subDays(7) : null;

        // dd( $expiration_time);

        $cache_nominal = 'cache_sum_nominal_periode_' . $periode;
        if (Cache::has($cache_nominal)) {
            $data_nominal = Cache::get($cache_nominal);
        } else {
            $data_nominal = [
                'jumlah_nominal_transfer' => $jumlah_nominal_transfer,
                'jumlah_nominal_donasi' => $jumlah_nominal_donasi,
                'jumlah_nominal_potongan' => $jumlah_nominal_potongan,
                'jumlah_nominal_bruto' => $jumlah_nominal_bruto,
            ];
            Cache::put($cache_nominal, $data_nominal, now()->addDays(7));
        }

        return view('dashboard.admin.periode.pembayaran.index', compact('unit', 'table', 'periode', 'dataperiode', 'data_biaya', 'data_peserta', 'data_biaya_id', 'data_peserta_id', 'data_pembayaran_peserta', 'data_transaksi_peserta', 'data_level', 'data_nominal', 'sum_data_biaya', 'expiration_time'));
    }

    public function hapus_cache($unit, $periode)
    {
        $cache_biaya = 'cache_sum_biaya_periode_' . $periode;
        $cache_expiration_key = $cache_biaya . '_expiration';
        $cache_nominal = 'cache_sum_nominal_periode_' . $periode;

        Cache::forget($cache_biaya);
        Cache::forget($cache_expiration_key);
        Cache::forget($cache_nominal);

        Toast::info('Data Pembayaran Berhasil Diperbaruhi');

        return redirect()->back();
    }

    public function rekap($unit, $periode)
    {
        $table = $this->getPembayaranRekapTable($unit);
        $dataperiode = \App\Models\Periode::find( $periode);
        return view('dashboard.admin.periode.pembayaran.rekap', compact('unit', 'table', 'periode', 'dataperiode'));
    }

    public function transaksi($unit, $periode)
    {
        $table = $this->getPembayaranTransaksiTable($unit);
        $dataperiode = \App\Models\Periode::find( $periode);
        return view('dashboard.admin.periode.pembayaran.transaksi', compact('unit', 'table', 'periode', 'dataperiode'));
    }

    public function peserta($unit, $peserta)
    {
        $peserta = \App\Models\Peserta::findOrFail($peserta);
        return view('dashboard.admin.pembayaran.peserta', compact('unit', 'peserta'));
    }
}
