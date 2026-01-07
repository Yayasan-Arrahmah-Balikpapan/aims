<?php

namespace App\Domain\Website\Controllers\Sosial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FundraisingController extends Controller
{
    public function index()
    {
        return view('website.pages.sosial.fundraising.index');
    }
}
