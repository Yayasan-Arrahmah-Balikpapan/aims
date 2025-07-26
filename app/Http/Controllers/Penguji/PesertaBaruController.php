<?php

namespace App\Http\Controllers\Penguji;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Modules\Unit;
use App\Tables\Penguji\DataPengujiPesertaBaru;
use App\Traits\CekUnitTrait;
use App\Models\Modules\Level;
use ProtoneMedia\Splade\Facades\Toast;
use App\Contracts\NotificationService;
use App\Traits\FormatPesanNotifTahsinDaftarBaruTrait;
use App\Traits\ConvertNotifikasi;




class PesertaBaruController extends Controller
{
    use CekUnitTrait;
    use FormatPesanNotifTahsinDaftarBaruTrait;
    use ConvertNotifikasi;

    private $notifService;

    public function __construct(NotificationService $notifService)
    {
        $this->notifService = $notifService;
    }
    public function index($unit)
    {
        $pesertas = new DataPengujiPesertaBaru($this->cekUnit($unit));

        $data_periode = \App\Models\Periode::whereHas('unit', function($query) use ($unit) {
                            $query->where('slug', $unit);
                        })
                        ->latest()
                        ->paginate(10);
        $data_pengajar = \App\Models\Pengajar::whereHas('unit', function($query) use ($unit) {
                            $query->where('slug', $unit);
                        })
                        ->first();

        return view('dashboard.penguji.peserta-baru.index', compact('pesertas', 'unit', 'data_periode', 'data_pengajar'));
    }

    public function data($unit, $periode) {
        $data_periode = \App\Models\Periode::find($periode);
        $data_pengajar = \App\Models\Pengajar::whereHas('unit', function($query) use ($unit) {
                            $query->where('slug', $unit);
                        })
                        ->first();

        $data_peserta_baru = Kelas::where('periode_id', $periode)
                        ->where('status_daftar', 'baru')
                        ->latest()
                        ->paginate(10);

        return view('dashboard.penguji.peserta-baru.data', compact('unit', 'periode', 'data_pengajar', 'data_peserta_baru', 'data_periode'));
    }



    public function show($unit, $periode, $peserta)
    {
        $data_periode = \App\Models\Periode::find($periode);
        $data_peserta = Kelas::find($peserta);
        $datalevel = Level::where('unit_id', $data_periode->unit_id)->get();
        return view('dashboard.penguji.peserta-baru.show', compact('data_peserta', 'data_periode', 'unit', 'datalevel'));
    }

    public function update($unit, $periode, $peserta, Request $request)
    {
        $data_periode = \App\Models\Periode::find($periode);
        $data_notifikasi = \App\Models\Notifikasi::where('unit_id', $data_periode->unit_id)
                ->where('slug', 'mendapatkan-level')
                ->first();
        $peserta_baru = Kelas::findOrFail($peserta);
        $peserta_baru->update([
                    'data_nilai' => [
                        'penempatan-level' => $request->level,
                    ],
                    'status_pendaftaran' =>  'belum pilih jadwal'
                ]);

        $isi_notif_wa = $this->formatWhatsappPesertaKelas($data_notifikasi->pesan_whatsapp, $peserta_baru->id);
        $this->notifService->kirimNotifWa($peserta_baru->peserta->phone_number, $isi_notif_wa);

        Toast::title('Hasil Berhasil Disimpan & Notif Hasil Berhasil Dikirim ke peserta baru !');
        return redirect()->back();
    }

    public function destroy($unit, $id)
    {
        $pesertaBaru = Kelas::find($id);
        $pesertaBaru->delete();

        return redirect()->route('dashboard.penguji.peserta-baru.index')->with('success', 'Peserta Baru berhasil dihapus');
    }
}
