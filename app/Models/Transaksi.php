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

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function payment_gateway()
    {
        return $this->hasOne(PaymentGateway::class, 'id', 'payment_gateway_id');
    }
}
