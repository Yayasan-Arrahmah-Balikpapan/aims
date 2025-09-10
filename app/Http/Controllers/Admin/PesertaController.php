<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tables\Pesertas;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\Splade\Facades\Toast;
use Maatwebsite\Excel\Facades\Excel;


class PesertaController extends Controller
{
    private function getPesertaTable($unit, $periode)
    {
        return match ($unit) {
            'tahsin' => new \App\Tables\Admin\TahsinPeserta($periode, $unit),
            'rtq' => new \App\Tables\Admin\RtqPeserta($periode, $unit),
            'tla' => new \App\Tables\Admin\TlaPeserta($periode, $unit),
            'rq' => new  \App\Tables\Admin\RqPeserta($periode, $unit),
            // default => new \App\Tables\Admin\PesertaTahsin($periode, $unit),
        };
    }

    public function index($unit, $periode)
    {
        $data_unit = \App\Models\Modules\Unit::where('slug', $unit)->first();
        $data_level = \App\Models\Modules\Level::where('unit_id', $data_unit->id)
                        ->get()
                        ->mapWithKeys(fn ($item) => [$item->id => $item->nama])
                        ->toArray();
        $data_pengajar = \App\Models\Pengajar::where('unit_id', $data_unit->id)
                        ->get()
                        ->mapWithKeys(fn ($item) => [$item->id => $item->kode_nama_pengajar])
                        ->toArray();
        $data_status_belajar = [
            'ONLINE' => 'ONLINE',
            'OFFLINE' => 'OFFLINE',
            'ONLINE / OFFLINE' => 'ONLINE / OFFLINE',
        ];
        $data_hari = [
            'SENIN' => 'Senin',
            'SELASA' => 'Selasa',
            'RABU' => 'Rabu',
            'KAMIS' => 'Kamis',
            'JUMAT' => 'Jumat',
            'SABTU' => 'Sabtu',
            'MINGGU' => 'Minggu',
        ];

        $peserta = $this->getPesertaTable($unit, $periode);
        $peserta =   \ProtoneMedia\Splade\SpladeTable::for(\App\Models\Kelas::where('periode_id', $periode)->orderBy('created_at', 'desc'))
        ->withGlobalSearch(columns: ['peserta.nama', 'peserta.jenis_peserta', 'jadwal.nama_jadwal', 'jadwal.pengajar.kode_nama_pengajar', 'peserta.user.phone_number'])
            // ->rowLink(fn (Kelas $kelas) => route('admin.peserta.show', ['unit' => $this->unit, 'periode' => $this->periode,'peserta' => $kelas->id], $kelas))
            ->column('id', sortable: true)
            ->selectFilter(
                key: 'peserta.jenis_peserta',
                label: 'Jenis',
                options: [
                    'ikhwan' => 'Ikhwan',
                    'akhwat' => 'Akhwat',
                ]
            )
            ->selectFilter(
                key: 'jadwal.level_id',
                label: 'Level',
                options: $data_level
            )
            ->selectFilter(
                key: 'jadwal.pengajar_id',
                label: 'Pengajar',
                options: $data_pengajar
            )
            ->selectFilter(
                key: 'jadwal.status_belajar',
                label: 'Status Belajar',
                options: $data_status_belajar
            )
            ->selectFilter(
                key: 'jadwal.hari_belajar',
                label: 'Hari Belajar',
                options: $data_hari
            )

            ->selectFilter(
                key: 'status_daftar',
                label: 'Status Daftar',
                options: [
                    'baru' => 'Baru Daftar',
                    'melanjutkan' => 'Peserta Lanjutan',
                ]
            )
            ->selectFilter(
                key: 'status_pendaftaran',
                label: 'Status Pendaftaran',
                options: [
                    'belum diberikan level' => 'Belum Diberikan Level',
                    'belum pilih jadwal' => 'Belum Pilih Jadwal',
                    'selesai pilih jadwal' => 'Selesai Pilih Jadwal',
                ]
            )
            ->selectFilter(
                key: 'status_ujian',
                label: 'Status Ujian',
                options: [
                    'belum ujian' => 'Belum Ujian',
                    'selesai ujian' => 'Selesai Ujian',
                ]
            )
            ->selectFilter(
                key: 'status_daftar_ulang',
                label: 'Status Daftar Ulang',
                options: [
                    'belum daftar ulang' => 'Belum Daftar Ulang',
                    'selesai daftar ulang' => 'Selesai Daftar Ulang',
                ]
            )
            ->selectFilter(
                key: 'status_aktif',
                label: 'Status Aktif',
                options: [
                    'diproses' => 'Diproses',
                    'aktif' => 'Aktif',
                    'ditangguhkan' => 'Ditangguhkan',
                    'off' => 'Off',
                ]
            )
            ->selectFilter(
                key: 'status_domisili',
                label: 'Asal Kota',
                options: [
                    '1' => 'Kota Balikpapan',
                    '0' => 'Luar Kota Balikpapan',
                ]
            )
            ->selectFilter(
                key: 'status_penerimaan',
                label: 'Status Penerimaan',
                options: [
                    'umum' => 'Umum',
                    'karyawan' => 'Karyawan',
                    'pengajar' => 'Pengajar',
                    'beasiswa' => 'Beasiswa',
                ]
            )
            ->column(label: 'Actions')
            ->column(
                key:'nis_peserta',
                label:'NIS',
            )
            ->column(
                key:'peserta.nama',
                label:'Nama',
            )
            ->column(
                key:'peserta.user.phone_number',
                label:'No. Telp',
            )
            ->column(
                key:'peserta.jenis_peserta',
                label:'Jenis',
            )
            ->column(
                key:'jadwal.nama_jadwal',
                label:'Kelas',
            )
            ->column(
                key:'jadwal.pengajar.kode_nama_pengajar',
                label:'Pengajar',
            )
            ->column(
                key:'created_at',
                label:'Tanggal Daftar',
            )
            ->column(
                key:'status_aktif',
                label:'Status',
            )
            // ->bulkAction(
            //     label: 'Kirim Notifikasi Pembayaran SPP',
            //     each: function (Kelas $kelas) {
            //         Toast::warning('Terjadi kesalahan, data gagal disimpan'.$kelas->id)->autoDismiss(5);
            //     },
            //     confirm: 'Touch kelass',
            //     confirmText: 'Are you sure you want to touch the kelass?',
            //     confirmButton: 'Yes, touch all selected rows!',
            //     cancelButton: 'No, do not touch!',
            // )
            // ->bulkAction(
            //     label: 'Kirim Notifikasi Pilih Jadwal',
            //     each: fn (Kelas $kelas) => $kelas->touch(),
            //     confirm: 'Touch kelass',
            //     confirmText: 'Are you sure you want to touch the kelass?',
            //     confirmButton: 'Yes, touch all selected rows!',
            //     cancelButton: 'No, do not touch!',
            // )
            // ->export()
            ->paginate(20)
            ;
        $dataperiode = \App\Models\Periode::find( $periode);

        return view('dashboard.admin.periode.peserta.index', compact('unit',  'periode', 'dataperiode', 'peserta'));
    }

    public function kehadiran($unit, $periode)
    {
        // $jadwal = $this->getJadwalTable($unit);
        $dataperiode = \App\Models\Periode::find( $periode);

        return view('dashboard.admin.periode.peserta.kehadiran', compact('unit',  'periode', 'dataperiode'));
    }

    public function create($unit, $periode)
    {
        $jadwals = \App\Models\Jadwal::select('id', 'nama_jadwal')
            ->where('periode_id', $periode)
            ->get();

        return view('dashboard.admin.periode.peserta.create', compact('unit','periode', 'jadwals'));
    }

    public function create_pilih($unit, $periode)
    {
        $jadwals = \App\Models\Jadwal::select('id', 'nama_jadwal')
            ->where('periode_id', $periode)
            ->get();

        return view('dashboard.admin.periode.peserta.create-pilih', compact('unit','periode', 'jadwals'));
    }

    public function data_api($unit, $periode)
    {
        $unit = \App\Models\Modules\Unit::where('slug', $unit)->first();
        $pesertas = \App\Models\Peserta::with('user:id,phone_number')
            ->select('id', 'nama', 'user_id', 'nis_peserta')
            ->where('unit_id', $unit->id)
            ->get()
            ->mapWithKeys(fn ($item) => [$item->id => $item->nis_peserta.' - '.$item->nama.' - '.$item->user->phone_number])
            ?? [];

        return response()->json([
            'data' => [
                'peserta' => $pesertas
            ]
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePesertaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($unit, $periode, Request $request)
    {
        $phone_number = ltrim($request->input('phone_number'), '0');
        $phone_number = ltrim($phone_number, '62');

        $periode = \App\Models\Periode::find( $periode);
        $unit = \App\Models\Modules\Unit::where('slug', $unit)->first();

        try {
            DB::beginTransaction();

            // CEK USER, JIKA TIDAK ADA MAKA CREATE USER
            $user = \App\Models\User::where('phone_number', $request->input('phone_number'))->first();
            if (!$user) {
                $user = \App\Models\User::create([
                    'phone_code'   => $request->input('phone_code') ?? '62',
                    'phone_number' => $request->input('phone_number'),
                ]);
            }
            $nomor_wa = $user->phone_code.ltrim($user->phone_number, '0');

            $data_format = [];

            $uuid= Str::uuid();
            $peserta = \App\Models\Peserta::create([
                'periode_id'      => $periode->id,
                'unit_id'         => $unit->id,
                'user_id'         => $user->id,
                'uuid'            => $uuid,
                'phone_number'    => $nomor_wa,
                'nama'            => $request->input('nama_peserta'),
                'jenis_peserta'   => $request->input('jenis_peserta'),
                'tanggal_lahir'   => $request->input('tahun') . '-' . $request->input('bulan') . '-' . $request->input('tanggal'),
            ]);

            $hitung_data_peserta = \App\Models\Kelas::where('periode_id', $periode->id)
                                                ->where('status_daftar', 'baru')
                                                ->count();
            $nomor               = $hitung_data_peserta + 1;
            $kode_peserta        = str_pad($nomor, 4, '0', STR_PAD_LEFT);
            $kode_periode        = str_pad($periode->angkatan, 4, '0', STR_PAD_LEFT);
            $kode_unit           = match ($unit->slug) {
                                        'tahsin' => $request->input('jenis_peserta') == 'ikhwan' ? 'TI' : 'TA',
                                        'rq' => 'RQ',
                                        'rtq-putra' => 'RA',
                                        'rtq-putri' => 'RI',
                                        'tla' => 'TL',
                                        default => '-',
                                    };
            $nis_peserta         = $kode_unit.$kode_periode.$kode_peserta;

            while(\App\Models\Kelas::where('nis_peserta', $nis_peserta)->where('periode_id', $periode->id)->exists()) {
                $hitung_data_peserta++;
                $nomor               = $hitung_data_peserta + 1;
                $kode_peserta        = str_pad($nomor, 4, '0', STR_PAD_LEFT);
                $nis_peserta         = $kode_unit.$kode_periode.$kode_peserta;
            }

            $peserta_kelas = \App\Models\Kelas::create([
                'periode_id'          => $periode->id,
                'peserta_id'          => $peserta->id,
                'jadwal_id'           => $request->jadwal ?? null,
                'nis_peserta'         => $nis_peserta,
                'uuid'                => $uuid,
                'data_pembayaran'     => json_encode($data_format),
                'data_absensi'        => $periode->format_absensi,
                'status_penerimaan'   => $request->penerimaan,
                'status_aktif'        => 'aktif',
                'status_daftar'       => 'baru',
                'status_pendaftaran'  => $request->jadwal ?'selesai pilih jadwal' : 'belum pilih jadwal',
                'status_ujian'        => 'belum ujian',
                'status_daftar_ulang' => 'belum daftar ulang',
                'status_domisili'     => $request->domisili,
                'kode_unik'                => $nomor,
                // 'kode_unik'                => (int)($request->input('bulan').$request->input('tanggal')), // BBTT
            ]);

            DB::commit();
            Toast::message('Data berhasil di tambahkan')->autoDismiss(5);
        } catch (\Exception $e) {
            DB::rollBack();
            Toast::warning('Terjadi kesalahan, data gagal disimpan')->autoDismiss(5);
        }
        return redirect()->back();
    }

    public function store_pilih($unit, $periode, Request $request)
    {
        $periode = \App\Models\Periode::find( $periode);
        $unit = \App\Models\Modules\Unit::where('slug', $unit)->first();

        try {
            DB::beginTransaction();
            $data_format = [];

            $uuid = Str::uuid();
            $peserta = \App\Models\Peserta::find($request->peserta);

            $peserta_kelas = \App\Models\Kelas::create([
                'periode_id'          => $periode->id,
                'peserta_id'          => $peserta->id,
                'jadwal_id'           => $request->jadwal,
                'uuid'                => $uuid,
                'data_pembayaran'     => json_encode($data_format),
                'data_absensi'        => $periode->format_absensi,
                'status_penerimaan'   => $request->penerimaan,
                'status_aktif'        => 'aktif',
                'status_daftar'       => 'baru',
                'status_pendaftaran'  => 'selesai pilih jadwal',
                'status_ujian'        => 'belum ujian',
                'status_daftar_ulang' => 'belum daftar ulang',
                'status_domisili'     => $request->domisili,
            ]);

            DB::commit();
            Toast::message('Data berhasil di tambahkan')->autoDismiss(5);
        } catch (\Exception $e) {
            DB::rollBack();
            Toast::warning('Terjadi kesalahan, data gagal disimpan')->autoDismiss(5);
        }
        return redirect()->back();
    }

    public function show($unit, $periode, $peserta)
    {
        $jadwals = \App\Models\Jadwal::select('id', 'nama_jadwal')
            ->where('periode_id', $periode)
            ->get();
        $data_peserta = \App\Models\Kelas::find($peserta);
        $dataperiode = \App\Models\Periode::find( $periode);
        $data_transaksi = \App\Models\Transaksi::where('peserta_id', $peserta)->get();
        $data_biaya = \App\Models\Biaya::where('periode_id', $data_peserta->periode->id)->get();
        $data_pembayaran_peserta = \App\Models\Pembayaran::where('kelas_id', $data_peserta->id)->get();

        return view('dashboard.admin.periode.peserta.show', compact('unit','periode', 'jadwals', 'data_peserta', 'dataperiode', 'peserta', 'data_transaksi', 'data_biaya', 'data_pembayaran_peserta'));
    }

    public function update($unit, $periode, $peserta, Request $request)
    {
        $request->validate([
            'nama_peserta' => 'required|string|max:100',
            'jenis_peserta' => 'required|in:ikhwan,akhwat',
            'phone_number' => 'required|numeric',
            'tanggal_lahir' => 'nullable|date',
            'jadwal' => 'nullable|exists:jadwals,id',
        ]);

        try {
            DB::beginTransaction();
            $peserta_kelas = \App\Models\Kelas::findOrFail($peserta);
            $peserta_kelas->jadwal_id = $request->jadwal ?? null;
            $peserta_kelas->save();

            $peserta_data = \App\Models\Peserta::find($peserta_kelas->peserta_id);
            $peserta_data->phone_number = $request->phone_number;
            $peserta_data->nama = $request->nama_peserta;
            $peserta_data->jenis_peserta = $request->jenis_peserta;
            $peserta_data->tanggal_lahir = $request->tanggal_lahir ?? null;
            $peserta_data->save();

            DB::commit();
            Toast::success('Data berhasil di update')->autoDismiss(5);
        } catch (\Exception $e) {
            DB::rollBack();
            Toast::warning('Terjadi kesalahan, data gagal diupdate')->autoDismiss(5);
        }

        return redirect()->back();
    }

    public function destroy($unit, $periode, $peserta)
    {
        try {
            $peserta = \App\Models\Kelas::findOrFail($peserta);
            if ($peserta->kelas->count() > 0) {
                Toast::warning('Data peserta ini memiliki transaksi pembayaran, belum bisa dihapus. konfirmasi dengan keuangan')->autoDismiss(5);
                return redirect()->back();
            }
            $peserta->delete();
            Toast::message('Data peserta berhasil di hapus')->autoDismiss(5);
        } catch (\Exception $e) {
            Toast::warning('Terjadi kesalahan, data gagal dihapus')->autoDismiss(5);
        }
        return redirect()->back();
    }

    public function import(Request $request, $unit)
    {
        return view('dashboard.admin.pengajar.import', compact('unit'));
    }


    public function import_store(Request $request, $unit)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $id_unit = \App\Models\Modules\Unit::where('slug', $unit)->first()->id;

        $file = $request->file('file');

        try {
            $import = new \App\Imports\PengajarImport($id_unit);
            Excel::import($import, $file);

            $results = $import->getImportResults();

            // Tampilkan hasil import menggunakan Toast atau Session
            $message = "Import selesai! " .
                    "Berhasil: {$results['imported']}, " .
                    "Gagal: {$results['failed']}, " .
                    "Duplikat: {$results['duplicates']}";

            Toast::message($message)->autoDismiss(8);

            // Simpan hasil detail di session untuk ditampilkan di halaman
            session()->flash('import_results', $results);

        } catch (\Exception $e) {
            Toast::error('Terjadi kesalahan saat import: ' . $e->getMessage())->autoDismiss(8);
        }

        return redirect()->route('admin.pengajar.index', $unit);
    }
}
