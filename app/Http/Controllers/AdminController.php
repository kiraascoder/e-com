<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function laporan()
    {
        return view('admin.laporan');
    }

    public function bidang()
    {
        return view('admin.bidang');
    }

    public function users()
    {
        return view('admin.kelola-user');
    }
}
