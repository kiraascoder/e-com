<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        return view('warga.index');
    }

    public function profile()
    {
        return view('warga.edit-profile');
    }

    public function laporan()
    {
        return view('warga.tracking-laporan');
    }

    public function buatLaporan()
    {
        $bidangs = Bidang::all();
        return view('warga.buat-laporan', compact('bidangs'));
    }

    public function storeLaporan(Request $request)
    {
        $request->validate([
            'bidang_id' => 'required',
        ]);
    }
}
