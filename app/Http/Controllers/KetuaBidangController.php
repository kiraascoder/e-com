<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KetuaBidangController extends Controller
{
    public function index()
    {
        return view('ketua-bidang.index');
    }

    public function tim()
    {
        return view('ketua-bidang.tim');
    }

    public function laporan()
    {
        return view('ketua-bidang.laporan-warga');
    }

    public function review()
    {
        return view('ketua-bidang.review');
    }
}
