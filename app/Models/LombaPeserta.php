<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LombaPeserta extends Model
{
    // protected $table = 'lomba_pesertas';

    protected $fillable = [
        'uuid','nama','jenis_kelamin','tanggal_lahir','alamat','user_id'
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function pendaftaran()
    {
        return $this->hasMany(LombaPendaftaran::class, 'peserta_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function transaksi()
    {
        return $this->hasOne(LombaTransaksi::class, 'peserta_id');
    }
}
