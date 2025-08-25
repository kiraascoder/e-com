<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\TimNonRutin;
use App\Models\TimRutin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('pegawai.index');
    }

    public function tim()
    {
        $user = Auth::user();
        $timRutin = TimRutin::whereHas('anggota', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
            ->orWhere('penanggung_jawab_id', $user->id)
            ->with(['penanggungJawab', 'anggota'])
            ->get();

        $timNonRutin = TimNonRutin::whereHas('anggota', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
            ->orWhere('penanggung_jawab_id', $user->id)
            ->with(['penanggungJawab', 'anggota'])
            ->get();

        return view('pegawai.tim', compact('timRutin', 'timNonRutin'));
    }

    public function timRutinShow($id)
    {
        $timRutin = TimRutin::find($id);
        $query = User::where('bidang_id', Auth::user()->bidang_id);
        $query->where('id', '!=', $timRutin->penanggung_jawab_id);
        $anggotaNonRutin = DB::table('tim_non_rutin_user')->pluck('user_id');
        $anggotaRutin = DB::table('tim_rutin_user')->pluck('user_id');
        $users = $query->whereNotIn('id', $anggotaNonRutin)
            ->whereNotIn('id', $anggotaRutin)
            ->orderBy('name')
            ->get();
        $timRutinAnggota = TimRutin::with(['anggota', 'penanggungJawab'])->findOrFail($id);
        $anggotaTim = User::orderBy('name')->get();
        return view('pegawai.detail.tim-rutin', compact('timRutin', 'users', 'anggotaTim', 'timRutinAnggota'));
    }

    public function timNonRutinShow($id)
    {
        $timNonRutin = TimNonRutin::find($id);
        $query = User::where('bidang_id', Auth::user()->bidang_id);
        $query->where('id', '!=', $timNonRutin->penanggung_jawab_id);
        $anggotaNonRutin = DB::table('tim_non_rutin_user')->pluck('user_id');
        $anggotaRutin = DB::table('tim_rutin_user')->pluck('user_id');
        $users = $query->whereNotIn('id', $anggotaNonRutin)
            ->whereNotIn('id', $anggotaRutin)
            ->orderBy('name')
            ->get();
        $timNonRutinAnggota = TimNonRutin::with(['anggota', 'penanggungJawab'])->findOrFail($id);
        $anggotaTim = User::orderBy('name')->get();
        return view('pegawai.detail.tim-nonrutin', compact('timNonRutin', 'users', 'anggotaTim', 'timNonRutinAnggota'));
    }
    public function laporan()
    {
        $laporans = Laporan::where('bidang_id', Auth::user()->bidang_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $stats = [
            'pending' => $laporans->where('status_verifikasi', 'pending')->count(),
            'diterima' => $laporans->where('status_verifikasi', 'diterima')->count(),
            'selesai' => $laporans->where('status_verifikasi', 'selesai')->count(),
            'ditolak' => $laporans->where('status_verifikasi', 'ditolak')->count(),
        ];
        return view('pegawai.laporan', compact('laporans', 'stats'));
    }
    public function detailLaporan($id)
    {
        $laporan = Laporan::find($id);
        return view('pegawai.detail.laporan', compact('laporan'));
    }
}
