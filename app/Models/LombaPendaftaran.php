<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LombaPendaftaran extends Model
{
    // protected $table = 'lomba_pendaftarans';

    protected $fillable = [
        'uuid','peserta_id','cabang_id','nomor_peserta','status','biaya'
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function peserta()
    {
        return $this->belongsTo(LombaPeserta::class, 'peserta_id');
    }

    public function cabang()
    {
        return $this->belongsTo(LombaCabang::class, 'cabang_id');
    }

    public function transaksi()
    {
        return $this->hasOne(LombaTransaksi::class, 'pendaftaran_id');
    }

    public function penilaian()
    {
        return $this->hasMany(LombaPenilaian::class, 'pendaftaran_id');
    }
}
