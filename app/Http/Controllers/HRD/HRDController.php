<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HRDController extends Controller
{
    public function index()
    {
        return view('dashboard.hrd.index',);
    }
}
