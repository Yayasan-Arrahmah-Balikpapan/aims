<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;


class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'kode_unik',
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
        'data_nilai' => 'array',
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
        return $this->hasMany(Transaksi::class, 'kelas_id');
    }

    public function level()
    {
        return $this->belongsTo(\App\Models\Modules\Level::class, 'level_id', 'id');
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

    public function scopeLevelTahsin($query, $level)
    {
        $data_level = Cache::get('level') ?? [];
        if (!Cache::has('level')) {
            $data_level = \App\Models\Modules\Level::get()->mapWithKeys(fn ($item) => [$item->id => $item->nama])->toArray();
            Cache::put('level', $level, now()->addMonth());
        }

        return $data_level[$level];
    }

    public function scopeCari($query, $cari)
    {
        return $query->when($cari, function($query, $cari) {
            $query->whereHas('peserta', function($query) use ($cari) {
                $query->where('nama', 'like', "%$cari%");
            })
            ->orWhere('nis_peserta', 'like', "%$cari%");
        });
    }

    public function scopeJenisPeserta($query, $jenis_peserta)
    {
        return $query->when($jenis_peserta, function($query, $jenis_peserta) {
            $query->whereHas('peserta', function($query) use ($jenis_peserta) {
                $query->where('jenis_peserta', $jenis_peserta);
            });
        });
    }

    public function scopeStatusPendaftaran($query, $status)
    {
        return $query->when($status, function($query, $status) {
            $query->where('status_pendaftaran', $status);
        });
    }

    public function scopeStatusDaftarPeserta($query, $statusdaftar)
    {
        return $query->when($statusdaftar, function($query, $statusdaftar) {
            $query->where('status_daftar', $statusdaftar);
        });
    }

    public function scopeCariLevel($query, $level)
    {
        return $query->when($level, function($query, $level) {
            $query->whereHas('jadwal', function($query) use ($level) {
                $query->whereHas('level', function($query) use ($level) {
                    $query->where('id', $level);
                });
            });
        });
    }

}

