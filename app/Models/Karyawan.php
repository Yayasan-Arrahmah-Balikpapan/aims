<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawans';

    protected $fillable = [
        'nik',
        'nip',
        'email',
        'foto',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'jabatan',
        'status_bekerja',
        'user_id',
        'unit_id',
        'divisi_id',
    ];


    protected $casts = [
        'keterangan' => 'array',
        'awal_bekerja' => 'date',
    ];

    public function unit()
    {
        return $this->belongsTo(Modules\Unit::class);
    }

    public function divisi()
    {
        return $this->belongsTo(Modules\Divisi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
