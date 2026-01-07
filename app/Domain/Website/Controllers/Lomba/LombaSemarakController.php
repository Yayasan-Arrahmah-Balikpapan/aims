<?php

namespace App\Domain\Website\Controllers\Lomba;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LombaSemarakController extends Controller
{
    public function index()
    {
        return view('website.pages.lomba.lombasemarak');
    }
}
