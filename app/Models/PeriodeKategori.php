<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodeKategori extends Model
{
    protected $fillable = [
        'nama', 'slug', 'keterangan'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
