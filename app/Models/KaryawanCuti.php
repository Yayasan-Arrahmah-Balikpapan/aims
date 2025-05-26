<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KaryawanCuti extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
        'status',
        'jenis_cuti',
        'keterangan',
    ];

    protected $casts = [
        'keterangan' => 'array',
    ];

    protected $dates = [
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
