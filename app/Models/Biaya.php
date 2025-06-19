<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'periode_id',
        'nama',
        'keterangan',
        'nominal',
        'status_dicicil',
        'wajib_dibayar_awal',
        'slug',
        'wajib_dibayar_oleh',
    ];

    protected $casts = [
        'status_dicicil' => 'boolean',
        'wajib_dibayar_awal' => 'boolean',
    ];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'biaya_id', 'id');
    }
}
