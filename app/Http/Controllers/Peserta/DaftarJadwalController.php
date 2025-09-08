<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\DB;

class DaftarJadwalController extends Controller
{
    public function index($peserta)
    {
        $peserta = \App\Models\Kelas::where('uuid',$peserta)->first();
        $data_jadwal = \App\Models\Jadwal::whereHas('level', function ($query) use ($peserta) {
                                $query->where('nama', $peserta->data_nilai['penempatan-level'] ?? '');
                            })
                    ->whereRaw('LOWER(jenis_peserta) = ?', strtolower($peserta->peserta->jenis_peserta))
                    ->where('periode_id', $peserta->periode->id)
                    ->get();

        $data_jumlah_jadwal =  $data_jadwal->mapWithKeys(function ($item) {
                return [$item->id => $item->kelas->count()];
            })
            ->toArray();
        if($peserta->jadwal_id !== null) {
            Toast::warning('Anda Sudah Memilih Jadwal');
            return redirect()->route('dashboard.peserta', ['uuid' => $peserta->uuid]);
        }

        return view('dashboard.peserta.daftar-jadwal', compact('peserta', 'data_jadwal', 'data_jumlah_jadwal'));
    }

    public function store($peserta, $jadwal)
    {
        $data_jadwal = \App\Models\Jadwal::findOrFail($jadwal);
        $peserta = \App\Models\Kelas::where('uuid', $peserta)->first();

        DB::beginTransaction();

        try {
            if($peserta->jadwal_id !== null) {
                Toast::warning('Anda Sudah Memilih Jadwal');
                return redirect()->route('dashboard.peserta', ['uuid' => $peserta->uuid]);
            }
            if($data_jadwal->kelas->count() < $data_jadwal->batasan_peserta) {
                $peserta->update([
                    'jadwal_id' => $jadwal,
                    'status_pendaftaran' => 'selesai pilih jadwal'
                ]);

                DB::commit();
                Toast::success('Pemilihan jadwal selesai');
                return redirect()->route('dashboard.peserta', ['uuid' => $peserta->uuid]);
            } else {
                DB::rollBack();
                Toast::warning('Maaf, Jadwal sudah penuh');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Toast::warning('Maaf, Terjadi Kesalahan, Mohon Ulangi');
            return redirect()->back();
        }

    }
}
