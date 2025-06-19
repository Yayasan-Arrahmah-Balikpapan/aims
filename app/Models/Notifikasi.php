<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Modules\Unit;
use App\Models\Modules\Divisi;

class Notifikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'divisi_id',
        'unit_id',
        'slug',
        'nama',
        'pesan_whatsapp',
        'pesan_email',
    ];

    protected $casts = [
        'pesan_email' => 'array',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }


}
