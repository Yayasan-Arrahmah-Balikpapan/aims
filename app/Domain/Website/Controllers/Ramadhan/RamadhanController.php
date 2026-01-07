<?php

namespace App\Domain\Website\Controllers\Ramadhan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RamadhanController extends Controller
{
    public function index()
    {
        return view('website.pages.ramadhan.index');
    }
}
