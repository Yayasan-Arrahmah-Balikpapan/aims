<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiPeserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'absen_id',
        'kelas_id',
        'peserta_id',
        'absen',
        'keterangan_absen',
    ];

    public function data_absen()
    {
        return $this->hasOne(Absen::class, 'id', 'absen_id');
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

}
