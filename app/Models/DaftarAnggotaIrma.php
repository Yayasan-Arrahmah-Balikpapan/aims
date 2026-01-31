<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DaftarAnggotaIrma extends Model
{
    use HasFactory;

    protected $table = 'daftar_anggota_irmas';
    
    protected $fillable = [
        'nama',
        'gender',
        'umur',
        'telepon',
        'alamat',
        'instansi',
        'kelas_semester',
        'jurusan',
        'divisi',
        'keahlian',
        'status',
    ];

    protected $casts = [
        'umur' => 'integer',
    ];

    // Constants untuk status
    const STATUS_MENUNGGU = 'menunggu verifikasi';
    const STATUS_LOLOS = 'lolos';
    const STATUS_DITOLAK = 'ditolak';

    // Scope untuk filter status
    public function scopeMenungguVerifikasi($query)
    {
        return $query->where('status', 'menunggu verifikasi');
    }

    public function scopeLolos($query)
    {
        return $query->where('status', 'lolos');
    }

    public function scopeDitolak($query)
    {
        return $query->where('status', 'ditolak');
    }

    // Accessor untuk format telepon
    public function getTeleponFormattedAttribute()
    {
        return '08' . ltrim($this->telepon, '0');
    }

    // Mutator untuk clean nomor telepon
    public function setTeleponAttribute($value)
    {
        $this->attributes['telepon'] = preg_replace('/[^0-9]/', '', $value);
    }
}
