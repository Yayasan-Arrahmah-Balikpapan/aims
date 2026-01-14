<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LombaTransaksi extends Model
{
    // protected $table = 'lomba_transaksis';

    protected $fillable = [
            'uuid',
            'peserta_id',
            'user_id',
            'status',
            'nominal_total',
            'donasi',
            'nominal_total_pembayaran',
        ];
    protected $casts = [
        'data_pembayaran' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function peserta()
    {
        return $this->belongsTo(LombaPeserta::class, 'peserta_id');
    }
}
