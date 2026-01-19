<?php

namespace App\Http\Controllers\AdminRamadhan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PesertaLombaRamadhanController extends Controller
{
    public function index()
    {
        return view('dashboard-ramadhan.admin.peserta-lomba.index');
    }
}
