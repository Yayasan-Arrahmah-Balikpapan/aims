<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'periode_id',
        'unit_id',
        'user_id',
        'uuid',
        'jadwal_id',
        'nis_peserta',
        'slug',
        'nama',
        'phone_number',
        'biodata',
        'data_pembayaran',
        'foto',
        'status_penerimaan',
        'status_aktif',
        'tanggal_lahir',
        'jenis_peserta'
    ];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'peserta_id', 'id');
    }


    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'peserta_id', 'id');
    }
}
