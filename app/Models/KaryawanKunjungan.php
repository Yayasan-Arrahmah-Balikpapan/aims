<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KaryawanKunjungan extends Model
{
    protected $fillable = [
        'user_id',
        'tujuan',
        'lokasi',
        'waktu',
        'durasi',
        'keterangan',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
        'waktu' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
