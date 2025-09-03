<?php

namespace App\Domain\Website\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IbadahController extends Controller
{
    public function index()
    {
        return view('website.pages.ibadah.index');
    }
}
