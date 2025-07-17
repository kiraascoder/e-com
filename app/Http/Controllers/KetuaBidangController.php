<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KetuaBidangController extends Controller
{
    public function index()
    {
        return view('ketua-bidang.index');
    }

}
