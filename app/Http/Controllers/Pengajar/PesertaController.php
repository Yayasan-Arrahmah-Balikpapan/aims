<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index($unit) {
        return view('dashboard.pengajar.peserta.index', compact('unit'));
    }
}
