<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LombaEvent extends Model
{
    // protected $table = 'lomba_events';

    protected $fillable = [
        'nama','deskripsi','tanggal_mulai',
        'tanggal_selesai','status'
    ];

    protected $casts = [
        'data' => 'array',
    ];



    public function cabang()
    {
        return $this->hasMany(LombaCabang::class, 'event_id');
    }
}
