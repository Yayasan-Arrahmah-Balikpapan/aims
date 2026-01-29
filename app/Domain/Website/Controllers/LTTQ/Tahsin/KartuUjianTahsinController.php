<?php

namespace App\Domain\Website\Controllers\LTTQ\Tahsin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;


class KartuUjianTahsinController extends Controller
{
    public function index($uuid)
    {
        $data = \App\Models\Kelas::with('peserta', 'jadwal', 'jadwal.pengajar', 'jadwal.level', 'periode')->where('uuid', $uuid)->first();
        if(!$data){
            abort(404);
        }

         $pdf = Pdf::loadView('website.pages.lttq.tahsin.kartu-ujian', compact('data'))->setPaper('a4', 'potrait');
        // return $pdf->download('medium.pdf');
        return $pdf->stream('Kartu Ujian Tahsin LTTQ Angkatan ' . $data->periode->angkatan . ' - '. $data->peserta->nama . '.pdf');
        // return view('website.pages.lttq.tahsin.kartu-ujian', compact('data'));
    }
}
