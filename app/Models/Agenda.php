<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'slug',
        'tanggal',
        'keterangan',
        'jenis',
        'data',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
