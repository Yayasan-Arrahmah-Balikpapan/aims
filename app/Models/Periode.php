<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Modules\Unit;

class Periode extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'nama',
        'slug',
        'waktu_start',
        'waktu_end',
        'tahun_ajaran',
        'angkatan',
        'form_biodata_daftar',
        'format_pembayaran',
        'format_absensi',
        'format_nilai',
        'format_rapot',
        'notifikasi',
        'aktifkan_pendaftaran',
        'tanggal_tagihan',
        'kategori',
    ];

    protected $casts = [
        'form_biodata_daftar' => 'array',
    ];

    public function biaya()
    {
        return $this->hasMany(Biaya::class);
    }


    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }

    public function pengajar()
    {
        return $this->belongsToMany(Pengajar::class, 'pivot_periode_pengajar');
    }

    public function status()
    {
        return $this->belongsTo(Periode::class, 'id');
    }


    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'periode_id', 'id');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'periode_id', 'id');
    }

    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'periode_id', 'id');
    }

}
