<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($unit) {
        return view('dashboard.pengajar.index', compact('unit'));
    }


}
