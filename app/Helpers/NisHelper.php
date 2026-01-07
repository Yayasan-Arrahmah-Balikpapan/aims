<?php

namespace App\Helpers;

use App\Models\NisCounter;
use Illuminate\Support\Facades\DB;
use App\Models\Periode;
use App\Helpers\KodeUnitHelper;

class NisHelper
{
    public static function generateNIS(string $kodePeriode): string
    {
        return DB::transaction(function () use ($kodePeriode) {
            // Ambil data periode & counter
            $dataPeriode = Periode::with('unit')->findOrFail($kodePeriode);
            $counter = NisCounter::lockForUpdate()
                ->firstOrCreate(
                    ['periode_id' => $kodePeriode],
                    ['last_number' => 0]
                );

            // Naikkan nomor urut terakhir
            $counter->last_number += 1;
            $counter->save();

            // Ambil kode divisi dan angkatan
            $kodeDivisi = KodeUnitHelper::generateKodeUnit($dataPeriode->unit->slug);
            $kodeAngkatan = $dataPeriode->angkatan;

            // Format nomor urut jadi 4 digit, misal: 0001, 0002, ...
            $nomorUrut = str_pad($counter->last_number, 4, '0', STR_PAD_LEFT);
            
            $NIS = $kodeDivisi+$kodeAngkatan+$nomorUrut;
            // Gabungkan jadi format akhir: TI.01.0001
            return "{$kodeDivisi}.{$kodeAngkatan}.{$nomorUrut}";
        });
    }
}
