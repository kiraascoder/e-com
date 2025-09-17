<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function bidang()
    {
        return view('home.bidang');
    }

    public function tentang()
    {
        return view('home.tentang');
    }
}
