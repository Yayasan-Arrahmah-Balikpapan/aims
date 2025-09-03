<?php

namespace App\Domain\Website\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SosialController extends Controller
{
    public function index()
    {
        return view('website.pages.sosial.index');
    }
}
