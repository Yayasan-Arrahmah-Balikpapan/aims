<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $fillable = [
        'jadwal_id',
        'pertemuan_ke',
        'tanggal_pertemuan',
        'tilawah',
        'keterangan',
    ];


    protected $casts = [
        'tanggal_pertemuan' => 'timestamp',
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function absensi_peserta()
    {
        return $this->hasMany(AbsensiPeserta::class);
    }
}
