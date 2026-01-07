<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'divisi_id',
        'nama',
        'slug',
        'keterangan',
        'kode_nis',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id_keterangan');
    }

    public function divisi()
    {
        return $this->hasOne(Divisi::class, 'id', 'divisi_id');
    }
}
