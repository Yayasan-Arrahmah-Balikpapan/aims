<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryawanAbsensi extends Model
{
    use HasFactory;

    protected $table = 'karyawan_absensis';


    protected $fillable = [
        'user_id',
        'status',
        'foto',
        'koordinat',
        'keterangan',
        'waktu_datang',
        'waktu_pulang',
    ];

    protected $casts = [
        'koordinat' => 'array',
        'foto' => 'array',
        'waktu_datang' => 'datetime',
        'waktu_pulang' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
