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
        'waktu_absen'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
