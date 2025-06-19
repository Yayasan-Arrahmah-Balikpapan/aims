<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'nis_peserta',
        'peserta_id',
        'jadwal_id',
        'periode_id',
        'data_pembayaran',
        'data_absensi',
        'status_aktif',
        'status_penerimaan',
        'data_absensi',
        'data_nilai',
        'status_daftar',
        'status_pendaftaran',
        'status_ujian',
        'status_daftar_ulang',
        'status_domisili',
    ];

    protected $casts = [
        'data_pembayaran' => 'array',
        'data_absensi' => 'array',
        'status_aktif' => 'boolean',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'peserta_id');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Periode::class, 'peserta_id', 'id');
    }

    public function data()
    {
        return $this->belongsTo(Kelas::class, 'id');
    }

    public function data_a()
    {
        return $this->belongsTo(Kelas::class, 'id');
    }

    public function data_b()
    {
        return $this->belongsTo(Kelas::class, 'id');
    }

    public function data_ktp()
    {
        return $this->belongsTo(Kelas::class, 'id');
    }

    public function data_rekaman()
    {
        return $this->belongsTo(Kelas::class, 'id');
    }

    public function datapebambayaran1() {  return $this->belongsTo(Kelas::class, 'id'); }
    public function datapebambayaran2() {  return $this->belongsTo(Kelas::class, 'id'); }
    public function datapebambayaran3() {  return $this->belongsTo(Kelas::class, 'id'); }
    public function datapebambayaran4() {  return $this->belongsTo(Kelas::class, 'id'); }
    public function datapebambayaran5() {  return $this->belongsTo(Kelas::class, 'id'); }
    public function datapebambayaran6() {  return $this->belongsTo(Kelas::class, 'id'); }

    public function peserta_a()
    {
        return $this->belongsTo(Peserta::class, 'peserta_id');
    }

}

