<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'periode_id',
        'transaksi_id',
        'biaya_id',
        'nominal',
        'keterangan',
        'kelas_id',
    ];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function biaya()
    {
        return $this->belongsTo(Biaya::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
