<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tables\Pesertas;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\Splade\Facades\Toast;

class PesertaController extends Controller
{
    private function getPesertaTable($unit, $periode)
    {
        if ($unit == 'tahsin') {
            return new \App\Tables\Admin\TahsinPeserta($periode, $unit);
        }
    }

    public function index($unit, $periode)
    {
        $peserta = $this->getPesertaTable($unit, $periode);
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

    public function show($unit, $id)
    {
        // Logika untuk menampilkan data berdasarkan ID
    }

    public function update(Request $request, $unit, $id)
    {
        // Logika untuk memperbarui data berdasarkan ID
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
}
