<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $laporans = Laporan::orderBy('created_at', 'desc')->paginate(10);
        $stats = [
            'pending' => $laporans->where('status_verifikasi', 'pending')->count(),
            'diterima' => $laporans->where('status_verifikasi', 'diterima')->count(),
            'selesai' => $laporans->where('status_verifikasi', 'selesai')->count(),
            'ditolak' => $laporans->where('status_verifikasi', 'ditolak')->count(),
        ];
        return view('admin.laporan', compact('laporans', 'stats'));
    }
    public function detailLaporan($id)
    {
        $laporan = Laporan::find($id);
        return view('admin.detail.laporan', compact('laporan'));
    }
    public function bidang()
    {
        $bidangs = Bidang::all();
        return view('admin.bidang', compact('bidangs'));
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.kelola-user', compact('users'));
    }
}
