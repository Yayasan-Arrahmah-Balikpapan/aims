<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Peserta;
use App\Models\Periode;
use App\Models\PaymentGateway;
class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'periode_id',
        'kelas_id',
        'kode_unik',
        'peserta_id',
        'pembayaran_id',
        'user_id',
        'status',
        'nominal_total',
        'nominal_total_pembayaran',
        'data_pembayaran',
        'payment_gateway_id',
        'donasi',
    ];

    protected $casts = [
        'data_pembayaran' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function payment_gateway()
    {
        return $this->hasOne(PaymentGateway::class, 'id', 'payment_gateway_id');
    }


    public function scopeStatusKeterangan($query, $status = null)
    {
        if($status == 1) {
            return 'Menunggu Pembayaran';
        } elseif ($status == 2) {
            return 'Menunggu Konfirmasi';
        } elseif ($status == 3) {
            return 'Lunas';
        } elseif ($status == 4) {
            return 'Kadaluarsa';
        } else {
            return '-';
        }
    }
}
