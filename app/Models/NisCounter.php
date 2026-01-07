<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NisCounter extends Model
{
    protected $fillable = ['periode_id', 'last_number'];
}
