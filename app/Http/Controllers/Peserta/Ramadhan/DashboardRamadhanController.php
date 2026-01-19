<?php

namespace App\Http\Controllers\Peserta\Ramadhan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardRamadhanController extends Controller
{
    public function index()
    {
        return view('dashboard.peserta.ramadhan.index');
    }
}
