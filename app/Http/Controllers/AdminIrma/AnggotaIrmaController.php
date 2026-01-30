<?php

namespace App\Http\Controllers\AdminIrma;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnggotaIrmaController extends Controller
{
    public function index()
    {
        return view('dashboard-irma.admin.anggota-irma.index');
    }
}
