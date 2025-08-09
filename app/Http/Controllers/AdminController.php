<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalLaporan = Laporan::get()->count();
        $totalBidang = Bidang::get()->count();
        $totalPegawai = User::where('role', 'pegawai')->get()->count();
        $totalWarga = User::where('role', 'warga')->get()->count();
        return view('admin.index', compact('totalLaporan', 'totalBidang', 'totalPegawai', 'totalWarga'));
    }

    public function laporan()
    {
        return view('admin.laporan');
    }

    public function bidang()
    {
        $bidangs = Bidang::all();
        return view('admin.bidang', compact('bidangs'));
    }

    public function users()
    {
        return view('admin.kelola-user');
    }
}
