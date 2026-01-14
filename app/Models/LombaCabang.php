<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LombaCabang extends Model
{
    // protected $table = 'lomba_cabangs';

    protected $fillable = ['event_id','nama','deskripsi','biaya_pendaftaran'];

    protected $casts = [
        'data' => 'array',
    ];

    public function event()
    {
        return $this->belongsTo(LombaEvent::class, 'event_id');
    }

    public function kriteria()
    {
        return $this->hasMany(LombaKriteria::class, 'cabang_id');
    }
}
